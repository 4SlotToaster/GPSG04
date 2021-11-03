<?php

namespace App\Providers;

use League\OAuth2\Client\Provider\GenericProvider;

class _AzureProvider extends GenericProvider
{
    public function __construct()
    {
        parent::__construct([
            'clientId'                => config('services.azure.appId'),
            'clientSecret'            => config('services.azure.appSecret'),
            'redirectUri'             => config('services.azure.redirectUri'),
            'urlAuthorize'            => config('services.azure.authority').config('services.azure.authorizeEndpoint'),
            'urlAccessToken'          => config('services.azure.authority').config('services.azure.tokenEndpoint'),
            'urlResourceOwnerDetails' => '',
            'scopes'                  => config('services.azure.scopes')
        ]);
    }

    // Static factory method
//    public static function create()
//    {
//        return new GenericProvider([
//            'clientId'                => config('services.azure.appId'),
//            'clientSecret'            => config('services.azure.appSecret'),
//            'redirectUri'             => config('services.azure.redirectUri'),
//            'urlAuthorize'            => config('services.azure.authority').config('services.azure.authorizeEndpoint'),
//            'urlAccessToken'          => config('services.azure.authority').config('services.azure.tokenEndpoint'),
//            'urlResourceOwnerDetails' => '',
//            'scopes'                  => config('services.azure.scopes')
//        ]);
//    }
}
