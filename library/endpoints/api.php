<?php
/**
 * class-oauth-fb
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
    
    public function __construct(StileroFBOauthAccesstoken $AccessToken,$userId='me', $postId='') {
        $this->Feed = new StileroFBEndpointFeed($AccessToken, $userId);
        $this->User = new StileroFBEndpointUser($AccessToken, $userId);
        $this->Photos = new StileroFBEndpointPhotos($AccessToken, $userId);
    }
   
}
