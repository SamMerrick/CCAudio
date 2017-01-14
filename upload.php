<?php
	require_once("assets/config/db.php");
	require_once("assets/php/LoginScript.php");
	
	// checking for minimum PHP version
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
	    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
	    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
	    require_once("assets/classes/password_compatibility_library.php");
	}
	
	
	$login = new Login();
	
	if (isset($login)) {
		if ($login->errors) {
			foreach ($login->errors as $error) {
				echo $error;
			}
		}
		if ($login->messages) {
			foreach ($login->messages as $message) {
				echo $message;
				}
			}
		}
	if (isset($registration)) {
		if ($registration->errors) {
			foreach ($registration->errors as $error) {
				echo $error;
			}
		}
		if ($registration->messages) {
			foreach ($registration->messages as $message) {
				echo $message;
			}
		}
	}
	

	if ($login->isUserLoggedIn() == true) {
		include("views/upload.php");
	} 
	else {
		include("views/not_logged_in.php");
	}
?>





