<?php
namespace Foursquare\Api;

use Foursquare\Client;

class FoursquareApi extends Client
{
    /**
     *
     * @var GeoPoint\Client $client 
     */
    protected $client;
    
    /**
     * 
     * @param \GeoPoint\Client $client
     */
    public function __construct( Client $client = null ) 
    {
        $this->client = $client instanceof Client ? $client : new Client();

        $this->setUrl( 'https://api.foursquare.com/v2/:path' );
                              
    }    
    
    public function getClient()
    {
        return $this->client;
    }
    
    public function setUrl( $url ) 
    {
        return $this->client->setUrl( $url );
    }
    
    public function setOption( $k, $v )
    {
        return $this->client->setOption( $k, $v );
    }
    
    public function get($path, $parameters = array(), $requestOpts = array()) {
        return $this->client->get( $path, $parameters, $requestOpts);
    }
    
    public function api( $api )
    {
        return $this->client->api( $api );
    }
    
    public function authenticate( $login, $secret = null, $method = null )
    {
        $this->client->setOption( 'auth_method', $method );

        if( $method === 'http_password' || 
            $method === 'url_client_id' ) 
        {
            $this->client
                 ->setOption( 'login', $login )
                 ->setOption( 'secret', $secret );
        } 
        else 
            $this->client->setOption( 'token', $secret );
    }
    
    public function deauthenticate()
    {
        $this->authenticate( null, null, null );
    }
    