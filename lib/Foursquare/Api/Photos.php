<?php
namespace Foursquare\Api;

class Photos extends FoursquareApi
{
    public function get( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( $id, $params, $requestOpts );
    }
}