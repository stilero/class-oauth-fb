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

class StileroFBFacebook{
    
    protected $App;
    protected $AccessToken;
    protected $redirectUri;
    public $Api;
    
    /**
     * The Controller/Wrapper for the entire Facebook class
     * @param string $appId The Facebook App ID received from developers.facebook.com
     * @param string $appSecret The Facebook App Secret received from developers.facebook.com
     * @param string $redirectUri The redirect url is typically the absolute url to the page where this script is run (http://www.mypage.com/index.php)
     */
    public function __construct($appId, $appSecret, $redirectUri) {
        $this->App = new StileroFBOauthApp($appId, $appSecret);
        $this->redirectUri = $redirectUri;
    }
    
    /**
     * Redirects the user to the FB LoginDialog by printing out a JScript.
     */
    protected function loginDialog(){
        $Dialog = new StileroFBLoginDialog($this->App, $this->redirectUri);
        $csfrState = StileroOauthEncryption::EncryptedCSFRState($this->App->id, $this->App->secret);
        $responseType = StileroFBLoginDialogResponseType::CODE;
        $scope = StileroFBPermisisonsPagesGroupsUsers::permissionList();
        $url = $Dialog->url($csfrState, $responseType, $scope);
        print "<script> top.location.href='".$url."'</script>";
    }
    
    /**
     * The starting point for this api. In no AccessToken is set the user is redirected
     * to the Login Dialog. This method will also catch any access codes returned, 
     * and sets it to the AccessToken.
     * Don't forget to call the getAccessToken and save the token for future calls
     * to avoid the need of reauthorisation.
     */
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
    
    /**
     * Takes a token and creates an AccessToken object for this class.
     * @param string $token token string
     */
    public function setAccessToken($token){
        $AccessToken = new StileroFBOauthAccesstoken($this->App);
        $AccessToken->setToken($token);
        $this->AccessToken = $AccessToken;
    }
    
    /**
     * Returns the token of the AccessToken object
     * @return string token
     */
    public function getAccessToken(){
        return $this->AccessToken->token;
    }
    
    
}
