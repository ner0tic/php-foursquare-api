<?php
namespace Foursquare\Api;

class Venue extends FoursquareApi
{
    public function getCategories( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( 'venues/categories', $params, $requestOpts );
    }
}