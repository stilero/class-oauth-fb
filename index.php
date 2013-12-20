<?php
define('_JEXEC', 1);

define(ROOT_DIR, dirname(__FILE__));

/*Directories that contain classes*/
define(FB_LIBRARY, ROOT_DIR.'/library/');
define(OAUTH_LIBRARY, ROOT_DIR.'/library/oauth/');
define(FBOAUTH_LIBRARY, ROOT_DIR.'/library/fboauth/');
define(FB_ENDPOINTS, ROOT_DIR.'/library/endpoints/');

require_once 'jerror.php';
require_once 'facebook.php';
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
require_once FB_ENDPOINTS.'api.php';
require_once FB_ENDPOINTS.'feed.php';
require_once FB_ENDPOINTS.'photos.php';
require_once FB_ENDPOINTS.'comments.php';
require_once FB_ENDPOINTS.'likes.php';

$appID = '516367068420553';
$appSecret = 'd3e4174996c353dba7ecad165ca516be';
$accessToken = 'CAAHVohOv2ckBAPFnRfnFX9goc4sAOlVOejUAWs86XGbWBJjVIxJ9EN2w6sxgDGabD0uZB2nsGQAzeXvE2ZC4pTdwMD3wubzbfOX3yPnhM0C3AO8dGcmvMbgX4aCNKCI4ExFUSvuA4UM33zKv1n3hrFw2obtwWqzkI4YKG291uMXrcei76llZCxO0bNK3ecZD';
$redirectURI = 'http://localhost/classes/class-oauth-fb/index.php';
$pageID = '223802977656746';
$pageToken = 'CAAHVohOv2ckBAPi4KQP4GWpzhpO47BctEKzkle52110moGcvRCPrQLnvny4ZBXYDOWX4tpAdjMZBuNP2Xf8d5YJGDIWmcWR9ZAtZBkjieaHhH4GatR52AmsdA9Hu1xcikaiRG65JsUTF4q0apoUxZBK3I5zhcjkhwG9Cvo6CRHffZByUFgJult';

$Facebook = new Facebook($appID, $appSecret, $redirectURI);
$Facebook->setAccessToken($accessToken);
$Facebook->start();
$pageToken = $Facebook->Api->User->getTokenForPageWithId($pageID);
$response = $Facebook->Api->Feed->setToken($pageToken);
//$response = $Facebook->Api->Feed->postLink('http://www.streetpeople.se');
$response = $Facebook->Api->Photos->publishFromUrl('http://ilovephoto.se/images/portfolio/bestphotos/portfolio-photography-corporate-12-13120909.jpg', '', '', '', $pageID);

//$response = $Facebook->getAccessToken();
//$pageToken = $Facebook->Api->User->getTokenForPageWithId($pageID);
//$response = $Facebook->debugToken($response);
$debug = StileroFBResponse::handle($response);
var_dump($debug);
?>