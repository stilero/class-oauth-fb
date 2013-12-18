<?php
/**
 * Photo Class
 *
 * @version  1.0
 * @package Stilero
 * @subpackage class-oauth-fb
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-18 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class StileroFBEndpointPhotos extends StileroFBEndpoint{
    
    public function __construct(\StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($AccessToken, $url, $postVars, $config);
    }
    
    /**
     * Publishes a photo to Facebook from an URL
     * @param int $userId ID of the person / page to post to
     * @param string $url The URL where the foto is found
     * @param string $message The description of the photo, used as the accompanying status message in any feed story. 
     * @param string $place Page ID of a place associated with the Photo
     * @param bool $noStory If set to true, this will suppress the feed story 
     * that is automatically generated on a person's profile when they upload a photo using your app.
     * @return string ID of the newly created photo
     */
    public function publishFromUrl($userId = 'me', $url='', $message='', $place='', $noStory=''){
        $this->_url = self::$_graph_url.$userId.'/photos';
        $this->_postVars = array(
            'access_token' =>  $this->AccessToken->token
        );
        if($url != ''){
            $this->_postVars['url'] = $url;
        }
        if($message != ''){
            $this->_postVars['message'] = $message;
        }
        if($place != ''){
            $this->_postVars['place'] = $place;
        }
        if($noStory != ''){
            $this->_postVars['no_story'] = $noStory;
        }
        return $this->sendRequest();
    }
    
    /**
     * Retrieve the photos from a user
     * @param int $userId the User / Page ID to retrieve from
     * @return string JSON Response
     */
    public function retrieve($userId = 'me'){
        $this->_url = self::$_graph_url.$userId.'/photos';
        $this->_postVars = array(
            'access_token' =>  $this->AccessToken->token
        );
        return $this->sendRequest(self::REQUEST_METHOD_GET);
    }
}
