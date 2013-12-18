<?php
/**
 * Accounts Class
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

class StileroFBEndpointAccounts extends StileroFBEndpoint{
    public function __construct(\StileroFBOauthAccesstoken $AccessToken, $url = "", $postVars = "", $config = "") {
        parent::__construct($AccessToken, $url, $postVars, $config);
    }
    
    /**
     * Retrives a list of all accounts the user administrates
     * @param int $userId user id
     * @return string JSON
     */
    public function info($userId = 'me'){
        $this->_url = self::$_graph_url.$userId.'/accounts';
        $this->_postVars = array(
            'access_token' =>  $this->AccessToken->token
        );
        return $this->sendRequest(self::REQUEST_METHOD_GET);
    }
}
