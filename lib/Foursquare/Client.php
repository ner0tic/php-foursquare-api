<?php

  namespace Foursquare;

  use Foursquareb\Api\ApiInterface;
  use Foursquare\HttpClient\HttpClientInterface;
  use Foursquare\HttpClient\HttpClient;

  class Client {
    /**
     * @global string AUTH_URL_TOKEN
     */
    const AUTH_URL_TOKEN = 'url_token';
    
    /**
     * @global string  AUTH_URL_CLIENT_ID
     */
    const AUTH_URL_CLIENT_ID = 'url_client_id';
    
    /**
     * @global string AUTH_HTTP_PASSWORD
     */
    const AUTH_HTTP_PASSWORD = 'http_password';
    
    /**
     * @global string AUTH_HTTP_TOKEN
     */
    const AUTH_HTTP_TOKEN = 'http_token';

    /**
     *
     * @var Foursquare\HttpClient $httpClient 
     */
    private $httpClient = null;

    /**
     *
     * @var array apis
     * An array of the available endpoint apis to load.  Think of it like a smarter lazy loader but not that smart...
     */
    private $apis = array();

    /**
     *
     * @var array $headers 
     */
    private $headers = array();

    /**
     * 
     * @param \Foursquare\HttpClient\HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient = null) {
      $this->httpClient = $httpClient ?: new HttpClient();
    }
      
    /**
     * Authenticate
     * @param string $login
     * @param string $secret
     * @param string $method
     */
    public function authenticate($login, $secret = null, $method = null) {
      $this->getHttpClient()->setOption('auth_method', $method);

      if($method === self::AUTH_HTTP_PASSWORD || $method === self::AUTH_URL_CLIENT_ID) {
        $this->getHttpClient()
             ->setOption('login', $login)
             ->setOption('password', $secret);
      } 
      else 
        $this->getHttpClient()->setOption('token', $secret);

      $this->getHttpClient()->authenticate();
    }

    /**
     * Get
     * @param string $path
     * @param array $parameters
     * @param array $requestOptions
     * @return type
     */
      public function get($path, array $parameters = array(), $requestOptions = array()) {
        return $this->getHttpClient()->get($path, $parameters, $requestOptions);
      }
  
      /**
       * Post
       * @param string $path
       * @param array $parameters
       * @param array $requestOptions
       * @return type
       */
      public function post($path, array $parameters = array(), $requestOptions = array()) {
        return $this->getHttpClient()->post($path, $parameters, $requestOptions);
      }

      /**
       * GetHttpClient
       * @return Foursquare\HttpClient\HttpClient
       */
      public function getHttpClient() {
        $this->httpClient->setHeaders($this->headers);

        return $this->httpClient;
      }

      /**
       * SetHttpClient
       * @param \Foursquare\HttpClient\HttpClientInterface $httpClient
       */
      public function setHttpClient(HttpClientInterface $httpClient) {
        $this->httpClient = $httpClient;
      }

      /**
       * Api
       * @param string $name
       * @return api type
       * @throws \InvalidArgumentException
       */
      public function api($name) {
        if (!isset($this->apis[$name])) {
          switch ($name) {
            case 'users':
              $api = new Api\Users($this);
              break;
            case 'venues':
              $api = new Api\Venues($this);
              break;
            case 'venuegroups':
              $api = new Api\VenueGroups($this);
              break;
            case 'checkins':
              $api = new Api\Checkins($this);
              break;
            case 'tips':
              $api = new Api\Tips($this);
              break;
            case 'lists':
              $api = new Api\Lists($this);
              break;
            case 'updates':
              $api = new Api\Updates($this);
              break;
            case 'photos':
              $api = newApi\Photos($this);
              break;
            case 'settings':
              $api = new Api\Settings($this);
              break;
            case 'specials':
              $api = new Api\Specials($this);
              break;
            case 'campaigns':
              $api = new Api\Campaigns($this);
              break;
            case 'events':
              $api = new Api\Events($this);
              break;
            case 'pages':
              $api = new Api\Pages($this);
              break;
            case 'pageUpdates':
              $api = new Api\PageUpdatea($this);
              break;
            case 'multi':
              $api = new Api\Multi($this);
              break;
            default:
              throw new \InvalidArgumentException();
          }
          $this->apis[$name] = $api;
        }
        return $this->apis[$name];
      }

      /**
       * GetRateLimit
       * @return type
       */
      public function getRateLimit() {
        return $this->get('rate_limit');
      }

      /**
       * ClearHeaders
       */
      public function clearHeaders() {
        $this->setHeaders(array());
      }

      /**
       * 
       * @param type $headerSetHeader
       */
      public function setHeaders($header) {
        $this->headers = $headers;
      }
  }
