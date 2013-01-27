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