<?php
require_once(realpath(dirname(__FILE__) .'/google-api-php-client-2.2.2/vendor/autoload.php'));

session_start();

$client = new Google_Client();
$client->setAuthConfigFile('client_id.json');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/OAuth2-framework-with-google-API/callback.php');
$client->addScope(Google_Service_Drive::DRIVE_FILE);

if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/OAuth2-framework-with-google-API/upload_form.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}