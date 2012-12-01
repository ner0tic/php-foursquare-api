<?php
namespace Foursquare\Api;

use Core\Api\AbstractApi;
use Foursquare\Client;

class FoursquareApi extends AbstractApi
{
  public function __contruct(Client $client = null) {
    $this->client = $client instanceof Client ? $client : new Client();
    
    $this->client->setOption('url', 'https://api.foursquare.com/:path');
    $this->client->setOption('certificate', 'Resources/config/certificate.pem');
  }
}