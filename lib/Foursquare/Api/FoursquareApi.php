<?php
namespace Foursquare\Api;

use Core\Api\AbstractApi;
use Foursquare\Client;

class FoursquareApi extends AbstractApi
{
    protected $client = null;
    
    public function __construct( Client $client = null ) 
    {
        $this->client = $client instanceof Client ? $client : new Client();

        $this->client->setUrl( 'https://api.foursquare.com/v2/:path' );
        $this->client->getHttpClient()->setOption( 'certificate', false ); // 'Resources/config/certificate.pem' );
    }
    
    public function getAuthClientId()
    {
        return $this->client->getAuthClientId();
    }
    
    public function setAuthClientId( $id = null )
    {
        $this->client->setAuthClientId( $id );
    }
    
    public function api( $api )
    {
        return $this->client->api( $api );
    }
    
    public function authenticate( $login, $secret = null, $method = null )
    {
        return $this->client->authenticate( $login, $secret, $method );
    }
}