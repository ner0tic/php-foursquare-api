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
        
/** @TODO read in vars and set then from a yaml file **/        
//        $this->client->setOption( 'login', '');
//        $this->client->setOption( 'secret', '');
        
    }
    
    public function authenticate( $login, $secret = null, $method = null )
    {
        return $this->client->authenticate( $login, $secret, $method );
    }
}