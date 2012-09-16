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
    /**
     * Categories
     * @return \Foursquare\Api\Venues\Categories
     */
    public function categories() {
      return new Categories($this->client);
    }

    /**
     * Hours
     * @return \Foursquare\Api\Hours
     */
    public function hours() {
      return new Hours($this->client);
    }

    /**
     * Likes
     * @return \Foursquare\Api\Venues\Likes
     */
    public function likes() {
      return new Likes($this->client);
    }

    /**
     * Listed
     * @return \Foursquare\Api\Venues\Listed
     */
    public function listed() {
      return new Listed($this->client);
    }

    /**
     * Menu
     * @return \Foursquare\Api\Venues\Menu|null
     */
    public function menu() {
      if($this->hasMenu())
        return new Menu($this->client);
      else
        return null;
    }
    
    /**
     * HasMenu
     * @todo This method needs to be created.
     * @return boolean
     */
    public function hasMenu() {
      return false; // TODO!
    }

    /**
     * Photos
     * @return \Foursquare\Api\Venues\Photos
     */
    public function photos() {
      return new Photos($this->client);
    }

    /**
     * Similar
     * @return \Foursquare\Api\Venues\Similar
     */
    public function similar() {
      return new Similar($this->client);
    }

    /**
     * Stats
     * @return \Foursquare\Api\Venues\Stats
     */
    public function stats() {
      return new Stats($this->client);
    }

    /**
     * Tips
     * @return \Foursquare\Api\Venues\Tips
     */
    public function tips() {
      return new Tips($this->client);
    }

    /**
     * Search
     * @param string $keyword
     * @param array $params
     * @return type
     */
    public function search($keyword, array $params){
      return $this->get('/venues/search/'.urlencode($keyword), $params);
    }

  }
