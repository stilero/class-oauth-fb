<?php

define('_JEXEC', 1);

define(ROOT_DIR, dirname(__FILE__));

/*Directories that contain classes*/
define(FB_LIBRARY, ROOT_DIR.'/library/');
define(FB_ENDPOINTS, ROOT_DIR.'/library/endpoints/');

require_once FB_LIBRARY.'oauth-client.php';
require_once FB_LIBRARY.'fb-login-dialog.php';
require_once FB_LIBRARY.'oauth-communicator.php';
require_once FB_LIBRARY.'fb-oauth-accesstoken.php';
require_once FB_LIBRARY.'oauth-response.php';
require_once FB_LIBRARY.'fb-user.php';
require_once FB_ENDPOINTS.'fb-endpoint.php';
require_once FB_ENDPOINTS.'fb-endpoint-feed.php';
require_once FB_ENDPOINTS.'fb-endpoint-accounts.php';
require_once FB_ENDPOINTS.'fb-endpoint-picture.php';
require_once FB_ENDPOINTS.'fb-endpoint-photos.php';

$appID = '516367068420553';
$appSecret = 'd3e4174996c353dba7ecad165ca516be';

$Client = new StileroFBOauthClient($appID, $appSecret);
$redirectURI = 'http://localhost/classes/class-oauth-fb/test.php';
$LoginDialog = new StileroFBLoginDialog($Client, $redirectURI);
$loginUrl = $LoginDialog->LoginDialog();
//print $loginUrl;
//print "<br />";
$code = 'AQCSRTAg1dhuq0RBmPHeT182ckPKEnxFCBYRxhAGFQIlHfVfrhL988PASxG1Jjo_kvHNPBgMAbb1yD2avHv0dWvWL6q8LIGZxSmAjQe3QV6qzDfIUnNZt2L-MSuhTHVh3Q6-amTbimcOMpQgZyS_J7wuWhjuAcN5QE0kHdLJmDazXxfNxrmTHDha3U_1mv5x27tU3oCbkHvB9slF8Yvzfmz0vvxfzQZuW8B2hW3E0Z7uq4p-HI1ABP81_auEmwSkNk5JqK3HS_HXSroOsf8SB4t0fEbs2oom3khBRfjLY4lYo0AX5WR78E0Tar3Zfw0a4Vg';
$token = 'CAAHVohOv2ckBAOtPZC3PhOLQZBLkWX5dMM79Yg8w8ABKTTuXCZAhzprgZAhykZCqR73lACXD0DyfCgZC1M4ZAGXi9AqsWUpuxF1m3YLBQeFZBz9QWVvEkZBZA7V07G9bLS9SfUR9pIgC3aeKDeKwJEE0UdMJrIde3ifR5CWdFb1gK815GGNf2W0khmyzFZAiGq0iq4ZD';
$pageToken = 'CAAHVohOv2ckBAEUaTCICVXlCtkwrGzf8GYeeDQRiIohmgj7IR5dF89ieZC05t9acBYlI55763VVENYqASgL8yIljvR3TfuouYdMftATmAOZCXlxr2ux3ukxlLTdYJxrZALpCwj3vsAKbLBwlWTxLHJJso3Sk1eoEwbIUCx47aXmD2PtBmss1LWXNZBfVUigZD';
$AccessToken = new StileroFBOauthAccesstoken($Client);
$AccessToken->setToken($token); 
//$FBUser = new StileroFBUser($AccessToken);
$FBMessage = new StileroFBEndpointPhotos($AccessToken);
$debug = $FBMessage->retrieve();
//print $debug = $FBMessage->publishFromUrl('me', 'http://ilovephoto.se/cache/widgetkit/gallery/35/portfolio-photography-corporate-12-13120909-80e454ffce.jpg', 'Den slutgiltiga versionen av bilden.');
//$debug = $FBMessage->postLink('http://www.ilovephoto.se', 'me', 'Daniel Eliasson Photography', 'Min andra hemsida med mer kommersiellt foto', 'Här hittar du allt från företagsfoto till reportagefoto', 'http://www.ilovephoto.se/images/logo_black.png');
//$me = json_decode($FBUser->me());
//$accounts = $FBUser->accounts($me->id);
//$account = json_decode($accounts);
//$tokenDebug = json_decode($AccessToken->extend());
var_dump(json_decode($debug));
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
