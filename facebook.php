<?php
/**
 * Facebook class as a starter point
 *
 * @version  1.0
 * @package Stilero
 * @subpackage class-oauth-fb
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-20 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

class Facebook{
    
    protected $App;
    protected $AccessToken;
    protected $redirectUri;
    public $Api;
    
    public function __construct($appId, $appSecret, $redirectUri) {
        $this->App = new StileroFBOauthApp($appId, $appSecret);
        $this->redirectUri = $redirectUri;
    }
    
    protected function loginDialog(){
        $Dialog = new StileroFBLoginDialog($this->App, $this->redirectUri);
        $csfrState = StileroOauthEncryption::EncryptedCSFRState($this->App->id, $this->App->secret);
        $responseType = StileroFBLoginDialogResponseType::CODE;
        $scope = StileroFBPermisisonsPagesGroupsUsers::permissionList();
        $url = $Dialog->url($csfrState, $responseType, $scope);
        print "<script> top.location.href='".$url."'</script>";
    }
    
    public function start(){
        if(!isset($this->AccessToken) && (!StileroFBOauthCode::hasCodeInGetRequest())){
            $this->loginDialog();
        }else if(StileroFBOauthCode::hasCodeInGetRequest()){
            $Code = new StileroFBOauthCode();
            $Code->fetchCode();
            $AccessToken = new StileroFBOauthAccesstoken($this->App);
            $response = $AccessToken->getTokenFromCode($Code->code, $this->redirectUri);
            $AccessToken->tokenFromResponse($response);
            $this->setAccessToken($AccessToken->token);
        }
        $this->renewToken();
        $this->Api = new StileroFBApi($this->AccessToken);
    }
    
    /**
     * Checks if a token will expire and extends it if not permanent
     */
    public function renewToken(){
        if(!$this->AccessToken->willNeverExpire($this->AccessToken->token)){
            $this->AccessToken->extend();
        }
        
    }
    
//    public function debugToken($token){
//        $Token = new StileroFBOauthAccesstoken($this->App);
//        $Token->setToken($token);
//        return $Token->debug($token);
//        
//    }
    
    /**
     * Creates and sets an accesstoken based on the token provided
     * @param string $token token string
     */
    public function setAccessToken($token){
        $AccessToken = new StileroFBOauthAccesstoken($this->App);
        $AccessToken->setToken($token);
        $this->AccessToken = $AccessToken;
    }
    
    public function getAccessToken(){
        return $this->AccessToken->token;
    }
    
    
}
