<?php

namespace App\Http\Controllers;

use App\Providers\_AzureProvider;
use App\TokenStore\_TokenCache;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use Illuminate\Http\Request;

class AuthController extends Controller {

    private $azureProvider;
    private $tokenCache;

    public function __construct(_AzureProvider $provider, _TokenCache $tokenCache) {
        $this->azureProvider = $provider;
        $this->tokenCache = $tokenCache;
    }

    public function signin()
    {
        // Initialize the OAuth client
        $oauthClient = $this->azureProvider;

        $authUrl = $oauthClient->getAuthorizationUrl();

        // Save client state so we can validate in callback
        session(['oauthState' => $oauthClient->getState()]);

        // Redirect to AAD signin page
        return redirect()->away($authUrl);
    }

    public function signout()
    {
        $this->tokenCache->clearTokens();
        return redirect('/');
    }

    public function callback(Request $request)
    {
        // Validate state
        $expectedState = session('oauthState');
        $request->session()->forget('oauthState');
        $providedState = $request->query('state');

        if (!isset($expectedState)) {
            // If there is no expected state in the session,
            // do nothing and redirect to the home page.
            return redirect('/');
        }

        if (!isset($providedState) || $expectedState != $providedState) {
            return redirect('/')
                ->with('error', 'Invalid auth state')
                ->with('errorDetail', 'The provided auth state did not match the expected value');
        }

        // Authorization code should be in the "code" query param
        $authCode = $request->query('code');
        if (isset($authCode)) {
            // Initialize the OAuth client
            $oauthClient = $this->azureProvider;

            try {
                // Make the token request
                $accessToken = $oauthClient->getAccessToken('authorization_code', [
                    'code' => $authCode
                ]);

                $graph = new Graph();
                $graph->setAccessToken($accessToken->getToken());

                $user = $graph->createRequest('GET', '/me?$select=displayName,mail,mailboxSettings,userPrincipalName')
                    ->setReturnType(Model\User::class)
                    ->execute();

                $this->tokenCache->storeTokens($accessToken, $user);

                return redirect('/');
            }
            catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                return redirect('/')
                    ->with('error', 'Error requesting access token')
                    ->with('errorDetail', json_encode($e->getResponseBody()));
            }
        }

        return redirect('/')
            ->with('error', $request->query('error'))
            ->with('errorDetail', $request->query('error_description'));
    }
}
