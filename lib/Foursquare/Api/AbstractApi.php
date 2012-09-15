<?php
  namespace Foursquare\Api;
  
  use Foursquare\Client;

  abstract class AbstractApi implements ApiInterface {
    /**
     *
     * @var Foursquare\Client 
     */
    protected $client;

    /**
     * 
     * @param \Foursquare\Client $client
     */
    public function __construct(Client $client) {
      $this->client = $client;
    }

    /**
     * 
     * @param srting $path
     * @param array $params
     * @param array $requstOpts
     * @return type
     */
    protected function get($path, $params = array(), $requstOpts = array()) {
      return $this->client->get($path, $params, $requestOpts);
    }

    /**
     * 
     * @param string $path
     * @param array $params
     * @param array $requestOpts
     * @return type
     */
    protected function post($path, $params = array(), $requestOpts = array()) {
      return $this->client->post($path, $params, $requestOpts);
    }
  }
