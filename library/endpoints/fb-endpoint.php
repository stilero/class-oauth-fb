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

class StileroFBEndpoint extends StileroFBOauthCommunicator{
    
    protected static $_graph_url = 'https://graph.facebook.com/';
    protected $_postVars;
    protected $_url;
    protected $AccessToken;

    /**
     * Class for removing repeated code
     * @param type $url
     * @param type $postVars
     * @param type $config
     */
    public function __construct(StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($url, $postVars, $config);
        $this->AccessToken = $AccessToken;
    }
    
    /**
     * Publishes the request
     * @param string $requestType Use constant from Communicator class
     * @return string JSON Response
     */
    protected function sendRequest($requestType=''){
        $requestUrl = $this->_url;
        if($requestType == self::REQUEST_METHOD_GET){
            $requestUrl = $this->_url ."?". http_build_query($this->_postVars);
            $this->setCustomRequest(self::REQUEST_METHOD_GET);
        }else{
            $this->setPostVars($this->_postVars);
        }
        $this->setUrl($requestUrl);
        $this->query();
        $response = $this->getResponse();
        return $response;
    }
}
