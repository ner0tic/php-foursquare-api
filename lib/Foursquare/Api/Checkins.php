<?php
namespace Foursquare\Api;

class Checkins extends FoursquareApi 
{
    public function recent( $params = array(), $requestOpts() = array() )
    {
        $keys = array( 'll', 'limit', 'afterTimestamp' );
        $path = 'checkins/recent/' . http_build_query( array_intersect_key( $params, $keys ) );

      return $this->get( $path, null, $requestOpts );
    }
}