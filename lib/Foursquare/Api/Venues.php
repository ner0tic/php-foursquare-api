<?php
namespace Foursquare\Api;

class Venue extends FoursquareApi
{
    public function get( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( $id, $params, $requestOpts );
    }
  
    public function getCategories( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( 'venues/categories', $params, $requestOpts );
    }
}