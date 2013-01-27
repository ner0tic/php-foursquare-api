<?php
namespace Foursquare\Api;

class Lists extends FoursquareApi
{
    public function get( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( $id, $params, $requestOpts );
    }
}