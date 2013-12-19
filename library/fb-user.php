<?php
/**
 * class-oauth-fb
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

class StileroFBUser extends StileroOauthCommunicator{
    
    private static $_url = 'https://graph.facebook.com/';
    private $userId;
    protected $AccessToken;
    
    public function __construct(StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($url, $postVars, $config);
        $this->AccessToken = $AccessToken;
    }
    
    /**
     * Retrieves info about the logged in person
     * @return string JSON string
     */
    public function me(){
        $url = self::$_url.'me';
        $postVars = array(
            'access_token' =>  $this->AccessToken->token
        );
        $requestUrl = $url ."?". http_build_query($postVars);
        $this->setUrl($requestUrl);
        $this->setCustomRequest('GET');
        $this->query();
        $response = $this->getResponse();
        return $response;
    }
    
     
    
    /**
     * Get info about the accounts the logged in user manages
     * @param int $userId
     * @return string JSON response
     */
    public function accounts($userId=''){
        if($userId != ''){
            $user = $userId;
        }else{
            $user = $this->userId;
        }
        $url = self::$_url.$user.'/accounts';
        $postVars = array(
            'access_token' =>  $this->AccessToken->token
        );
        $requestUrl = $url ."?". http_build_query($postVars);
        $this->setUrl($requestUrl);
        $this->setCustomRequest('GET');
        $this->query();
        $response = $this->getResponse();
        return $response;
    }
}
