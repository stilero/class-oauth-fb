<?php
/**
 * API Class
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

class StileroFBApi{
    
    public $Comments;
    public $Feed;
    public $Likes;
    public $Photos;
    public $User;
    public $AccessToken;
    
    /**
     * An API class to wrap up the endpoints
     * @param StileroFBOauthAccesstoken $AccessToken AccessToken object
     * @param string $userId a user/page/group id to use the api-calls on (123456789)
     * @param string $postId A status post id to use api-calls (likes and comments on). 
     * A wall post will for example result in a post id after successful posting.
     */
    public function __construct(StileroFBOauthAccesstoken $AccessToken,$userId='me', $postId='') {
        $this->Feed = new StileroFBEndpointFeed($AccessToken, $userId);
        $this->User = new StileroFBEndpointUser($AccessToken, $userId);
        $this->Photos = new StileroFBEndpointPhotos($AccessToken, $userId);
    }
   
}
