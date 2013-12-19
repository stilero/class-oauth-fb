<?php
/**
 * Picture Class
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

class StileroFBEndpointPicture extends StileroFBEndpoint{
    
    public function __construct(\StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($AccessToken, $url, $postVars, $config);
    }
    
    /**
     * Retrieves the Profile picture of a user
     * @param int $userId
     * @param bool $redirect if true, the image itself is retrieved, otherwise a JSON response is retrieved
     * @param string $type You use this to get a pre-specified size of picture. enum{square,small,normal,large}
     * @param int $height Restrict the picture height to this size in pixels.
     * @param int $width Restrict the picture width to this size in pixels. 
     * When height and width are both used, the image will be scaled as close to 
     * the dimensions as possible and then cropped down.
     * @return string JSON Response
     */
    public function retrieve($userId = 'me', $redirect='', $type='', $height='', $width=''){
        $this->requestUrl = self::$_graph_url.$userId.'/picture';
        $this->params = array(
            'access_token' =>  $this->AccessToken->token
        );
        if($redirect != ''){
            $this->params['redirect'] = $redirect;
        }
        if($type != ''){
            $this->params['type'] = $type;
        }
        if($height != ''){
            $this->params['height'] = $height;
        }
        if($width != ''){
            $this->params['width'] = $width;
        }
        return $this->sendRequest(self::REQUEST_METHOD_GET);
    }
}
