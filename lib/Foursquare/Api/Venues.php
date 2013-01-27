<?php
namespace Foursquare\Api;

use \Core\AbstractApi;

class Venue extends AbstractApi
{
  public function get($id, $requestOpts = array())
  {
    return $this->get($id, $requestOpts);
  }
  
  public function getCategories($id, $requestOpts = array())
  {
    return $this->get('venues/categories');
  }
}