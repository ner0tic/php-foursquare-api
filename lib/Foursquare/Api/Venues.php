<?php
namespace Foursquare\Api;

class Venues extends FoursquareApi
{
    private $search_fields = array(
        'll',   # Required unless using near
        'near', 
        'llAcc',
        'alt',
        'altAcc',
        'query',
        'limit',
        'intent',
        'radius', 
        'sw',
        'ne',
        'categoryId',
        'url',
        'providerId',
        'linkedId'
    );
    
    private $intents = array(
        'checkin',
        'browse',
        'global',
        'match'
    );
    
    public function getCategories( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( 'venues/categories', $params, $requestOpts );
    }
    
    public function search( $params = array() )
    {
        $ll = false;
        
        foreach( $params as $key => $value )
        {
            if( !in_array( $key, $search_fields ) )
            {
                unset( $params[ $key ] );
            }
            
            if( $key == 'll' || ( !$ll && $key == 'near' ) )
            {
                $ll = true;
            }
            
            if( $key == 'intent' )
            {
                if( !in_array( $params[ 'intent' ], $intents ) )
                {
                    new \Exception( 'Invalid intent supplied.' );
                }
            }
            
            if( !$ll )
            {
                new \Exception( 'In order to search venues, you must supply either a latitiude longitude set delimited by a comma (ll) or a location via the \'near\' key' );
            }
        }
        
        return $this->get( 'venues/search', array(), $params );
    }
}