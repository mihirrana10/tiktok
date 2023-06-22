<?php

session_start(); // Important! Required for STATE Variable check and prevent CSRF attacks
require __DIR__ . '/../vendor/autoload.php';
use gimucco\TikTokLoginKit;


// Example passing the Configuration parameters Inline

$client_id = 'awp537rhwl4xu3o9'; // Your API Key, as obtained from TikTok Developers portal
$client_secret = '79966e1528bf08fb8db31ceff7558d0f'; // Your API Secret, as obtained from TikTok Developers portal
$redirect_uri = 'https://www.youtube.com/watch?v=JA9cCPe_hKg'; // Where to return after authorization. Must be approved in the TikTok Developers portal

$_TK = new TikTokLoginKit\Connector($client_id, $client_secret, $redirect_uri);
if (TikTokLoginKit\Connector::receivingResponse()) { 
	try {
		$token = $_TK->verifyCode($_GET[TikTokLoginKit\Connector::CODE_PARAM]);
		// Your logic to store the access token
		$user = $_TK->getUser();
		// Your logic to manage the User info
		$videos = $_TK->getUserVideoPages();
		// Your logic to manage the Video info
	} catch (Exception $e) {
		echo "Error: ".$e->getMessage();
		echo '<br /><a href="?">Retry</a>';
	}
} else {
	echo '<a href="'.$_TK->getRedirect().'">Log in with TikTok</a>';
}