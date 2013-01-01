<?php
namespace Foursquare\Api;

use Core\AbstractApi;

class Checkins extends AbstractApi 
{
    public function get($id, $requestOpts = array())
    {
      return $this->get('checkins/', array($id), $requestOpts);
    }

    public function recent($params = array(), $requestOpts() = array() )
    {
      $keys = array( 'll', 'limit', 'afterTimestamp' );
      $path = 'checkins/recent/' . http_build_query(array_intersect_key($params, $keys));

      return $this->get($path, null, $requestOpts);
    }
}