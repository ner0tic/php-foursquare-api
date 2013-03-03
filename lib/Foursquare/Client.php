<?php
namespace Foursquare;

use Core\Client as BaseClient;
  
class Client extends BaseClient 
{
    /**
       * Api
       * @param string $name
       * @return api type
       * @throws \InvalidArgumentException
       */
    public function api( $name ) 
    {
        if( !isset( $this->apis[ $name ] ) ) 
        {
            switch( $name ) 
            {
                case 'users':
                    $api = new Api\Users( $this );
                    break;
                case 'venues':
                    $api = new Api\Venues( $this );
                    break;
                case 'venuegroups':
                    $api = new Api\VenueGroups( $this );
                    break;
                case 'checkins':
                    $api = new Api\Checkins( $this );
                    break;
                case 'tips':
                    $api = new Api\Tips( $this );
                    break;
                case 'lists':
                    $api = new Api\Lists( $this );
                    break;
                case 'updates':
                    $api = new Api\Updates( $this );
                    break;
                case 'photos':
                    $api = new Api\Photos( $this );
                    break;
                case 'settings':
                    $api = new Api\Settings( $this );
                    break;
                case 'specials':
                    $api = new Api\Specials( $this );
                    break;
                case 'campaigns':
                    $api = new Api\Campaigns( $this );
                    break;
                case 'events':
                    $api = new Api\Events( $this );
                    break;
                case 'pages':
                    $api = new Api\Pages( $this );
                    break;
                case 'pageUpdates':
                    $api = new Api\PageUpdates( $this );
                    break;
                case 'multi':
                    $api = new Api\Multi( $this );
                    break;
                default:
                    throw new \InvalidArgumentException();
                    break;
          }
          $this->apis[ $name ] = $api;
        }
        
        return $this->apis[ $name ];
      }
  }
