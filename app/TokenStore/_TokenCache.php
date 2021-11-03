<?php

namespace App\TokenStore;

use App\Providers\_AzureProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

// Since this is a sample app, for simplicity's sake, you'll store them in the session. A real-world app would use a more reliable secure storage solution
class _TokenCache {

    private $azureProvider;

    public function __construct(_AzureProvider $provider) {
        $this->azureProvider = $provider;
    }

    public function storeTokens($accessToken, $user = null) {
        session([
            'accessToken' => $accessToken->getToken(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'tokenExpires' => $accessToken->getExpires(),
        ]);
        if(isset($user)) {
            session([
                'userName' => $user->getDisplayName(),
                'userEmail' => null !== $user->getMail() ? $user->getMail() : $user->getUserPrincipalName(),
                'userTimeZone' => $user->getMailboxSettings()->getTimeZone()
            ]);
        }
    }

    public function clearTokens() {
        session()->forget([
            'accessToken',
            'refreshToken',
            'tokenExpires',
            'userName',
            'userEmail',
            'userTimeZone'
        ]);
    }

    public function getAccessToken() {
        // Check if tokens exist
        if (empty(session('accessToken')) ||
            empty(session('refreshToken')) ||
            empty(session('tokenExpires'))) {
            return '';
        }

        // If token will expire soon ask for a new one
        if (session('tokenExpires') <= time() + 300) {
            $oauthClient = $this->azureProvider;
            try {
                $newToken = $oauthClient->getAccessToken('refresh_token', [
                    'refresh_token' => session('refreshToken')
                ]);
                $this->storeTokens($newToken);

                return $newToken->getToken();
            }
            catch (IdentityProviderException $e) {
                return '';
            }
        }
        // Token is still valid, just return it
        return session('accessToken');
    }
}
