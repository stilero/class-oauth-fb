<?php
/**
 * Status Class
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

class StileroFBEndpointFeed extends StileroFBEndpoint{
    public function __construct(\StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($AccessToken, $url, $postVars, $config);
    }
    
    /**
     * Posts a status message to a wall
     * @param string $message The message to post as status
     * @param int $userId The wall/person/page ID to post to
     * @return string JSON Response
     */
    public function postMessage($message, $userId = 'me'){
        $this->requestUrl = self::$_graph_url.$userId.'/feed';
        $this->params = array(
            'access_token' =>  $this->AccessToken->token,
            'message' => $message
        );
        return $this->sendRequest();
    }
    
    /**
     * Posts a link to a wall
     * @param string $link the url of the link
     * @param int $userId userid that owns the wall
     * @param string $name Overwrites the title of the link preview.
     * @param string $caption Overwrites the caption under the title in the link preview.
     * @param string $description Overwrites the description in the link preview
     * @param string $picture Determines the preview image associated with the link.
     * @return string JSON Response
     */
    public function postLink($link, $userId = 'me', $name='', $caption = '', $description = '', $picture=''){
       $this->requestUrl = self::$_graph_url.$userId.'/feed';
        $this->params = array(
            'access_token' =>  $this->AccessToken->token,
            'link' => $link
        );
        if($name != ''){
            $this->params['name'] = $name;
        }
        if($caption != ''){
            $this->params['caption'] = $caption;
        }
        if($description != ''){
            $this->params['description'] = $description;
        }
        if($picture != ''){
            $this->params['picture'] = $picture;
        }
        return $this->sendRequest();
    }
    
    /**
     * Retrieves info about a status message
     * @param insteger $statusMessageId The Status Message ID
     * @return string JSON Response
     */
    public function messageInfo($statusMessageId){
        $this->requestUrl = self::$_graph_url.$statusMessageId;
        $this->params = array(
            'access_token' =>  $this->AccessToken->token
        );
        return $this->sendRequest(self::REQUEST_METHOD_GET);
    }
}
