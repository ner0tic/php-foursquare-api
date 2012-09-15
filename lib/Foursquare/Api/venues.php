<?php

  namespace Foursquare\Api;

  use Foursquare\Api\Venues\Categories;
  use Foursquare\Api\Venues\Links;
  use Foursquare\Api\Venues\Menu;
  use Foursquare\Api\Venues\Photos;
  use Foursquare\Api\Venues\Stats;
  use Foursquare\Api\Venues\Tips;
  use Foursquare\Api\Venues\Similar;
  use Foursquare\Api\Venues\Likes;
  use Foursquare\Api\Venues\Listed;

  class Venues extends AbstractApi {
    public function categories() {
      return new Categories($this->client);
    }

    public function hours() {
      return new Hours($this->client);
    }

    public function likes() {
      return new Likes($this->client);
    }

    public function listed() {
      return new Listed($this->client);
    }

    public function menu() {
      if($this->hasMenu())
        return new Menu($this->client);
      else
        return null;
    }
    public function hasMenu() {
      return false; // TODO!
    }

    public function photos() {
      return new Photos($this->client);
    }

    public function similar() {
      return new Similar($this->client);
    }

    public function stats() {
      return new Stats($this->client);
    }

    public function tips() {
      return new Tips($this->client);
    }

    public function search($keyword, array $params){
      return $this->get('/venues/search/'.urlencode($keyword), $params);
    }

  }
