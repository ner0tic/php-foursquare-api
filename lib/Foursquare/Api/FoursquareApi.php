<?php
namespace Foursquare\Api;

use Core\Api\AbstractApi;
use Foursquare\Client;

class FoursquareApi extends AbstractApi
{
    public function __construct( Client $client = null ) 
    {
        $this->client = $client instanceof Client ? $client : new Client();

        $this->setOption( 'url', 'https://api.foursquare.com/:path' );
        $this->setOption( 'certificate', false ); // 'Resources/config/certificate.pem' );
    }
    
    public function getAuthClientId()
    {
        return $this->client->getAuthClientId();
    }
}