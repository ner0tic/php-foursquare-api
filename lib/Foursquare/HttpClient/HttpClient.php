<?php
  namespace Foursquare\HttpClient;

  use Buzz\Browser;
  use Buzz\Client\Curl;
  use Buzz\Messge\MessageInterface;

  use Foursquare\Exception\ApiLimitExceedException;
  use Foursquare\HttpClient\Listener\AuthListener;

  class HttpClient implements HttpClientInterface {
    /**
     *
     * @var $remainingCalls 
     */
    public $remainingCalls;

    /**
     * @var Array $options 
     * An array of options for feed the client instance
     */
    protected $options = array(
      'url'         =>  'https://api.foursquare.com/:path',
      'user_agent'  =>  'php-foursquare-api (https://github.com/ner0tic/php-foursquare-api)',
      'http_port'   =>  443,
      'auth_method' =>  null,
      'timeout'     =>  10,
      'api_limit'   =>  5000,
      'token'       =>  null);

    /**
     *
     * @var Array $history
     * Roads? Where we're going we won't need roads.
     */
    protected $history = array();

    /**
     *
     * @var Browser $browser
     * Browser instance
     */
    protected $browser;

    /**
     *
     * @var Array $headers
     * Headers for the Browser instance
     */
    protected $headers = array();

    /**
     *
     * @var Array $lastResponse
     * Store the last response
     */
    protected $lastResponse;

    /**
     * 
     * @param array $options
     * @param \Buzz\Browser $browser
     */
    public function __construct(array $options = array(), Browser $browser = null) {
      $this->options = array_merge($this->options, $options);
      $this->browser = $browser ?: new Browser(new Curl());
      
      $this->browser->getClient()->setTimeout($this->options['timeout']);
      $this->browser->getClient()->setVerifyPeer(true); 
      $this->browser->getClient()->setOption('CURLOPT_SSL_VERIFYHOST', 2);
      /**
       * File: CAfile.pem contains a mashed certificate of googleapis.com and foursquare.com
       */
      $this->browser->getClient()->setOption('CURLOPT_CAINFO', __DIR__.'/Certificates/CAfile.pem');
    }

    /**
     * SetHeaders
     * @param String $headers
     */
    public function setHeaders($headers) {
      $this->headers = $headers;
    }

    /**
     * SetOption
     * @param type $name
     * @param type $value
     * @return \Foursquare\HttpClient\HttpClient
     */
    public function setOption($name, $value) {
      $this->option[$name]= $value;
      
      return $this;
    }

    /**
     * Get
     * @param string $path
     * @param array $params
     * @param array $options
     * @return array 
     */
    public function get($path, array $params = array(), $options = array()) {
      if(0 < count($params))
        $path .= (false === strpos($path, '?')? '?':'&').http_build_query($params,'', '&');
      return $this->request($path, $params, 'GET', $options);
    }

    /**
     * Post
     * @param type $path
     * @param array $params
     * @param array $options
     * @return array 
     */
    public function post($path, array $params = array(), $options = array()) {
      return $this->request($path, $params, 'POST', $options);
    }

    /**
     * Request
     * @param type $path
     * @param array $params
     * @param string $httpMethod
     * @param array $options
     * @return array
     */
    private function request($path, array $params = array(), $httpMethod= 'GET', $options = array()) {
      $options = array_merge($this->options, $options);
      $url = strtr($options['url'], array(':path' => trim($path, '/')));
      $this->lastResponse = $this->doRequest($url, $params, $httpMethod, $options);

      return $this->decodeResponse($this->lastResponse['response']);
    }

    /**
     * DoRequest
     * @param string $path
     * @param array $params
     * @param string $httpMethod
     * @param array $options
     * @return array
     */
    private function doRequest($path, array $params = array(), $httpMethod = 'GET', $options = array()) {
      $response = $this->browser->call($path, $httpMethod, $this->headers,json_encode($params));
      $this->checkApiLimit($response);

      return array(
        'response'      =>  $response->getContent(),
        'headers'       =>  $response->getHeaders(),
        'errorNumber'   =>  '',
        'errorMessage'  =>  '');
    }

    /**
     * DecodeResponse
     * @param string $response
     * @return string
     */
    private function decodeResponse($response) {
      $content = json_decode($response, true);
      if(JSON_ERROR_NONE !==json_last_error())
        return $reponse;
      return $content;
    }

    /**
     * CheckApiLimit
     * @param \Buzz\Messge\MessageInterface $response
     * @throws ApiLimitExceedException
     */
    protected function checkApiLimit(MessageInterface $response) {
      $this->remainingCalls = $response->getHeader('X-RateLimit-Remaining');
      if (null !== $this->remainingCalls && 1 > $this->remainingCalls) 
        throw new ApiLimitExceedException($this->options['api_limit']);        
    }
  }
