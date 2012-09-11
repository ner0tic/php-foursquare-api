<?php

  namespace Foursquare\HttpClient;

  interface HttpClientInterface {
    public function get($path, array $parameters = array(), array $options = array());

    public function post($path, array $parameters = array(), array $options = array());

    public function setOption($name, $value);

    public function setHeaders(array $headers);
}
