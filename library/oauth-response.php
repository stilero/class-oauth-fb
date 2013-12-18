<?php
/**
 * Class for handling FB Responses
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

class StileroFBOauthResponse{
    
    public $json;
    public $category;
    public $type;
    public $code;
    public $message;
    public $isError;
   
    /**
     * Extracts information from FB responses
     * @param string $json
     */
    public function __construct($json) {
        $this->json = $json;
        $response = json_decode($json);
        if(isset($response->error)){
            $this->error($response->error);
        }
    }
    
    /**
     * Handles error responses
     * @param stdClass $errorResponse
     */
    protected function error($errorResponse){
        $this->category = 'error';
        $this->isError = true;
        if (isset($errorResponse->message)){
            $this->message = $errorResponse->message;
        }
        if (isset($errorResponse->type)){
            $this->type = $errorResponse->type;
        }
        if (isset($errorResponse->code)){
            $this->code = $errorResponse->code;
        }
    }
    
        
}
