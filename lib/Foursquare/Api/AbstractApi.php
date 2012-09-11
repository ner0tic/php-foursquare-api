<?php
  namespace Foursquare\Api;
  
  use Foursquare\Client;

  abstract class AbstractApi implements ApiInterface {
    protected $client;

    public function __construct(Client $client) {
      $this->client = $client;
    }

    protected function get($path, $params = array(), $requstOpts = array()) {
      return $this->client->get($path, $params, $requestOpts);
    }

    proteted function post($path, $params = array(), $requestOpts = array()) {
      return $this->client->post($path, $params, $requestOpts);
    }
  }
