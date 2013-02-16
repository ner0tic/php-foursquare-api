<?php
namespace Foursquare\Api;

class Users extends FoursquareApi
{  
    /**
     * Return array of recent checkins to foursquare
     * @param integer|null $id
     * @param integer $limit
     * @return type
     */
    public function getRecentCheckins( $id = null, $params = array(), $requestOpts = array() )
    {
        $params = array_merge( $params, array(
            'limit' =>  10
        ) );
        
        if( null === $id )
        {
            if( null === parent::getAuthClientId() )
            {
                new \Exception( 'You must supply a valid user id either via a config file or in the method call.' );
            }

            return $this->get( 'users/' . parent::getAuthClientId() . '/checkins', $params, $requestOpts );      
        }

        return $this->get( 'users/' . $id . '/checkins', params, $requestOpts );
    } 

    /**
     * Return most recent checkin to foursquare
     * @param integer $id the user id to get recent checkin from
     * @return type 
     */
    public function getRecentCheckin( $id = null )
    {
        return $this->getRecentCheckins( $id, array( 'limit' => 1 ) );
    }
}