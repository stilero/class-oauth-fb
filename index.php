<?php
define('_JEXEC', 1);

define(ROOT_DIR, dirname(__FILE__));

/*Directories that contain classes*/
define(FB_LIBRARY, ROOT_DIR.'/library/');
define(OAUTH_LIBRARY, ROOT_DIR.'/library/oauth/');
define(FBOAUTH_LIBRARY, ROOT_DIR.'/library/fboauth/');
define(FB_ENDPOINTS, ROOT_DIR.'/library/endpoints/');

require_once 'jerror.php';
require_once FB_LIBRARY.'facebook.php';
require_once FB_LIBRARY.'permissions/permissions.php';
require_once FB_LIBRARY.'permissions/pagesgroupsusers.php';
require_once FB_LIBRARY.'logindialog/logindialog.php';
require_once FB_LIBRARY.'logindialog/logindialogresponsetype.php';
require_once OAUTH_LIBRARY.'encryption.php';
require_once OAUTH_LIBRARY.'client.php';
require_once OAUTH_LIBRARY.'communicator.php';
require_once FBOAUTH_LIBRARY.'app.php';
require_once FBOAUTH_LIBRARY.'code.php';
require_once FBOAUTH_LIBRARY.'accesstoken.php';
require_once FBOAUTH_LIBRARY.'response.php';
require_once FB_ENDPOINTS.'endpoint.php';
require_once FB_ENDPOINTS.'user.php';
require_once FB_ENDPOINTS.'feed.php';
require_once FB_ENDPOINTS.'photos.php';
require_once FB_ENDPOINTS.'comments.php';
require_once FB_ENDPOINTS.'likes.php';

$appID = '516367068420553';
$appSecret = 'd3e4174996c353dba7ecad165ca516be';
$token = 'CAAHVohOv2ckBACCsR6UUM9XeOj9nwxQnPlMrz50kRdEsZC0m4B4S3gSvXHSF9zCE8A2j1aHIrthwJeT8aQsW7Jk9L3wtWVthQ5WivkwbjBQmZAEYSR80FdIo7ZCTxS6Bmnt6l4NHc6ZAxsrvRo1DOpQEYREKLC9ycTIgLSD5ZC2NghAmZAQQZAuR5uAENCZCpn4ZD';
$redirectURI = 'http://localhost/classes/class-oauth-fb/index.php';
$pageID = '223802977656746';
$pageToken = 'CAAHVohOv2ckBAEPZCcuzgK9Uu6N9hpHrGNBluTCS8xyxvsvPqc14fwbJYkzNCK10ALBNFC1RmV0OtimVUOfJon7qE3KI0UxGe9ZB7weacajaeIeLHHbrZADmz6he2mWcDTr3ZCwhcLR79k4bZBj1iYHo3cGz1ZCsCJ0mhd271vXGeku94UN70s';

$Facebook = new StileroFBFacebook($appID, $appSecret, $redirectURI, $token);
$response = $Facebook->Comments('609024129134627')->read();
//$pageToken = $Facebook->User()->getTokenForPageWithId($pageID);
//$Facebook->Feed()->setToken($pageToken);
//$response = $Facebook->Photos()->publishFromUrl('http://ilovephoto.se/images/portfolio/bestphotos/portfolio-photography-corporate-12-13120909.jpg');
//$response = $Facebook->Feed()->postMessage('Testing');
//$response = $Facebook->getToken();
//$pageToken = $Facebook->User->getTokenForPageWithId($pageID);
//$Facebook->Feed->setToken($pageToken);
//$response = $Facebook->Api->Feed->postLink('http://www.streetpeople.se');
//$response = $Facebook->Photos->publishFromUrl('http://ilovephoto.se/images/portfolio/bestphotos/portfolio-photography-corporate-12-13120909.jpg', '', '', '');
$debug = StileroFBResponse::handle($response);
var_dump($debug);
?>