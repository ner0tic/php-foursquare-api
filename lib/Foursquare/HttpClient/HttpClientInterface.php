<?php

  namespace Foursquare\HttpClient;

  interface HttpClientInterface {
    /**
     * HttpClientInterface
     * @param string $path
     * @param array $parameters
     * @param array $options
     */
    public function get($path, array $parameters = array(), array $options = array());

    /**
     * Post
     * @param string $path
     * @param array $parameters
     * @param array $options
     */
    public function post($path, array $parameters = array(), array $options = array());

    /**
     * SetOption
     * @param string $name
     * @param string $value
     */
    public function setOption($name, $value);

    /**
     * SetHeaders
     * @param array $headers
     */
    public function setHeaders(array $headers);
}
