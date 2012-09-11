<?php
  namespace Foursquare\HttpClient;

  use Buzz\Browser;
  use Buzz\Client\Curl;
  use Buzz\Messge\MessageInterface;

  use Foursquare\Exception\ApiLimitExceedException;
  use Foursquare\HttpClient\Listener\AuthListener;

  class HttpClient implements HttpClientInterface {
    public $remainingCalls;

    protected $options = array(
      'url'         =>  'https://api.foursquare.com/:path',
      'user_agent'  =>  'php-foursquare-api (https://github.com/ner0tic/php-foursquare-api)',
      'http_port'   =>  443,
      'auth_method' =>  null,
      'timeout'     =>  10,
      'api_limit'   =>  5000,
      'token'       =>  null);

    protected $history = array();

    protected $browser;

    protected $headers = array();

    protected $lastResponse;

    public function __consgruct(array $options = array(), Browser $browser = null) {
      $this->options = array_merge($this->options, $options);
      $this->browser = $browser ?: new Browser(new Curl());
      
      $this->browser->getClient()->setTimeout($this->options['timeout']);
      $this->browser->getClient()->setVerifyPeer(false);
    }

    public function setHeaders($headers) {
      $this->headers = $headers;
    }

    public function setOption($name, $value) {
      $this->option[$name]= $value;
      
      return $this;
    }

    public function get($path, array $params = array(), $options = array()) {
      if(0 < count($params))
        $path .= (false === strpos($path, '?')? '?':'&').http_build_query($params,'', '&');
      return $this->request($path, $params, 'GET', $options);
    }

    public function post($path, array $params = array(), $options = array()) {
      return $this->request($path, $params, 'POST', $options);
    }

    private function request($path, array $params = array(), $httpMethod= 'GET', $options = array()) {
      $options = array_merge($this->options, $options);
      $url = strtr($options['url'], array(':path' => trim($path, '/')));
      $this->lastResponse = $this->doRequest($url, $params, $httpMethod, $options);

      return $this->decodeResponse($this->lastResponse['response']);
    }

    private function doRequest($path, array $params = array(), $httpMethod = 'GET', $options = array()) {
      $response = $this->browser->call($path, $httpMethod, $this->headers,json_encode($params));
      $this->checkApiLimit($response);

      return array(
        'response'      =>  $response->getContent(),
        'headers'       =>  $response->getHeaders(),
        'errorNumber'   =>  '',
        'errorMessage'  =>  '');
    }

    private function decodeResponse($response) {
      $content = json_decode($response, true);
      if(JSON_ERROR_NONE !==json_last_error())
        return $reponse;
      return $content;
    }

    protected function checkApiLimit(MessageInterface $response) {
      $this->remainingCalls = $response->getHeader('X-RateLimit-Remaining');
      if (null !== $this->remainingCalls && 1 > $this->remainingCalls) 
            throw new ApiLimitExceedException($this->options['api_limit']);        
    }
  }
