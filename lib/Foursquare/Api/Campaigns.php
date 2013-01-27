<?php
namespace Foursquare\Api;

class Campaigns extends FoursquareApi
{
    public function get( $id, $params = array(), $requestOpts = array() )
    {
        return $this->get( $id, $params, $requestOpts );
    }
}