<?php
require_once(realpath(dirname(__FILE__) .'/google-api-php-client-2.2.2/vendor/autoload.php'));

session_start();

$client = new Google_Client();
$client->setAuthConfig('client_id.json');
$client->addScope(Google_Service_Drive::DRIVE_FILE);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {

	if (is_uploaded_file($_FILES['uploadfile']['tmp_name'])) {

		$client->setAccessToken($_SESSION['access_token']);
  		$drive = new Google_Service_Drive($client);

  		
  		$file_name = $_FILES['uploadfile']['name'];
  		
  		
  		

  		$fileMetadata = new Google_Service_Drive_DriveFile(array(
    					'name' => $file_name));

		$content = file_get_contents(realpath($_FILES['uploadfile']['tmp_name']));
		try {

			$file = $drive->files->create($fileMetadata, array(
		    'data' => $content,
		    'uploadType' => 'multipart',
		    'fields' => 'id'));
  			
  			header('Location:success.php');

		}catch (Exception $e) {
        throw new Exception("Error: " . $e->getMessage());
    	}
		
	}
	else {
		header('Location:upload_form.php');
	}
  
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/OAuth2-framework-with-google-API/callback.php';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}

?>