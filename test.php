<?php

define('_JEXEC', 1);

define(ROOT_DIR, dirname(__FILE__));

/*Directories that contain classes*/
define(FB_LIBRARY, ROOT_DIR.'/library/');
define(OAUTH_LIBRARY, ROOT_DIR.'/library/oauth/');
define(FBOAUTH_LIBRARY, ROOT_DIR.'/library/fboauth/');
define(FB_ENDPOINTS, ROOT_DIR.'/library/endpoints/');

require_once 'jerror.php';
require_once OAUTH_LIBRARY.'client.php';
require_once OAUTH_LIBRARY.'communicator.php';
require_once FBOAUTH_LIBRARY.'app.php';
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

$App = new StileroFBOauthApp($appID, $appSecret);
//$redirectURI = 'http://localhost/classes/class-oauth-fb/test.php';
//$LoginDialog = new StileroFBLoginDialog($App, $redirectURI);
//$loginUrl = $LoginDialog->LoginDialog();
//print $loginUrl;
//print "<br />";
$code = 'AQCSRTAg1dhuq0RBmPHeT182ckPKEnxFCBYRxhAGFQIlHfVfrhL988PASxG1Jjo_kvHNPBgMAbb1yD2avHv0dWvWL6q8LIGZxSmAjQe3QV6qzDfIUnNZt2L-MSuhTHVh3Q6-amTbimcOMpQgZyS_J7wuWhjuAcN5QE0kHdLJmDazXxfNxrmTHDha3U_1mv5x27tU3oCbkHvB9slF8Yvzfmz0vvxfzQZuW8B2hW3E0Z7uq4p-HI1ABP81_auEmwSkNk5JqK3HS_HXSroOsf8SB4t0fEbs2oom3khBRfjLY4lYo0AX5WR78E0Tar3Zfw0a4Vg';
$token = 'CAAHVohOv2ckBAOtPZC3PhOLQZBLkWX5dMM79Yg8w8ABKTTuXCZAhzprgZAhykZCqR73lACXD0DyfCgZC1M4ZAGXi9AqsWUpuxF1m3YLBQeFZBz9QWVvEkZBZA7V07G9bLS9SfUR9pIgC3aeKDeKwJEE0UdMJrIde3ifR5CWdFb1gK815GGNf2W0khmyzFZAiGq0iq4ZD';
$token = 'CAACEdEose0cBABan7rqCYv36dQ63unDtWSVMVagyt5b7H6NZAa7f0uH4Q67PfEPPIDwzR6eZB1ZBKXN2iHee6wNJVgg7Tu5ZCsnfmDkS1uL86qfGLHuI5FHGigh0QLC4cO06GMxTZAlAiJa1PbqHFswUsm6PKf2U8xULXC9Xdgvt544hZAF2fZC09WLFdmXJwdmo0uvnTcnZBAZDZD';
$pageToken = 'CAAHVohOv2ckBAEUaTCICVXlCtkwrGzf8GYeeDQRiIohmgj7IR5dF89ieZC05t9acBYlI55763VVENYqASgL8yIljvR3TfuouYdMftATmAOZCXlxr2ux3ukxlLTdYJxrZALpCwj3vsAKbLBwlWTxLHJJso3Sk1eoEwbIUCx47aXmD2PtBmss1LWXNZBfVUigZD';
$lfkgroupid = '112305446663';
//$token .= 'e'.$token;
$AccessToken = new StileroFBOauthAccesstoken($App);
$AccessToken->setToken($token); 
$Endpoint = new StileroFBEndpointUser($AccessToken);
$response = $Endpoint->picture();
$debug = StileroFBResponse::handle($response);
//$Photo = new StileroFBEndpointPhotos($AccessToken);
//$debug = $Photo->publishFromUrl('me', 'http://ilovephoto.se/cache/widgetkit/gallery/35/portfolio-photography-corporate-12-13120909-80e454ffce.jpg', 'Den slutgiltiga versionen av bilden.');
//$FBUser = new StileroFBUser($AccessToken);
//$FBMessage = new StileroFBEndpointPicture($AccessToken);
//$debug = $FBMessage->retrieve('me', true);
//print $debug = $FBMessage->publishFromUrl('me', 'http://ilovephoto.se/cache/widgetkit/gallery/35/portfolio-photography-corporate-12-13120909-80e454ffce.jpg', 'Den slutgiltiga versionen av bilden.');
//$debug = $FBMessage->postLink('http://www.ilovephoto.se', 'me', 'Daniel Eliasson Photography', 'Min andra hemsida med mer kommersiellt foto', 'Här hittar du allt från företagsfoto till reportagefoto', 'http://www.ilovephoto.se/images/logo_black.png');
//$me = json_decode($FBUser->me());
//$accounts = $FBUser->accounts($me->id);
//$account = json_decode($accounts);
//$tokenDebug = json_decode($AccessToken->extend());
var_dump($debug);
/*
$QueryResponse = $AccessToken->getTokenFromCode($code, $redirectURI);
$Response = new StileroFBOauthResponse($QueryResponse);
var_dump($Response);
if($Response->isError){
    print $Response->json;
}else{
    print $AccessToken->handleResponse($Response->json);
}
 * 
 */
?>
