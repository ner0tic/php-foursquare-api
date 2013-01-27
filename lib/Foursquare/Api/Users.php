<?php
namespace Foursquare\Api;

class Users extends FoursquareApi
{
  /**
   * Return array of either the given user id, the currently logged in user
   * or false
   * @param integer|null $id
   * @param array $requestOpts http query parameters
   * @return type
   */
  public function get( $id = null, $params = array(), $requestOpts = array() )
  {
    if( null === $id )
    {
      if( null === $this->getAuthClientId() )
      {
        return $this->get( 'users/self', $params, $requestOpts );
      }
      
      return $this->get( 'users/'.$this->getAuthClientId(), $params, $requestOpts );      
    }
            
    return $this->get( 'users/'.$id, $params, $requestOpts );
  }
  
  /**
   * Return array of recent checkins to foursquare
   * @param integer|null $id
   * @param integer $limit
   * @return type
   */
  public function getRecentCheckins( $id = null, $limit = 10 )
  {
    $requestOpts = array( 'limit' => $limit );
    if( null === $id )
    {
      if( null === $this->getAuthClientId() )
      {
        return $this->get( 'users/self/checkins', $requestOpts );
      }
      
      return $this->get( 'users/'.$this->getAuthClientId().'/checkins', array(), $requestOpts );      
    }
            
    return $this->get( 'users/'.$id.'/checkins', array(), $requestOpts );
  }
  
  /**
   * Return most recent checkin to foursquare
   * @param integer $id the user id to get recent checkin from
   * @return type 
   */
  public function getRecentCheckin($id = null)
  {
    return $this->getRecentCheckins($id, 1);
  }
}