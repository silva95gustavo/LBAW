<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/users.php');  
require_once($BASE_DIR . 'pages/common/utils.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	die();
}

if(isset($_POST['inputNewEmail']))
  editEmail();
else
  editPasssword();


function editPasssword() {

  $userID = $_SESSION['userID'];
  $oldPassword = $_POST['inputOldPassword'];
  $newPassword = $_POST['inputNewPassword'];
  $newPasswordVerify = $_POST['inputConfirmPassword'];

  if(isPasswordCorrect($userID, $oldPassword)) {
    if($newPassword == $newPasswordVerify) {
      	try {
        	updateUserPassword($userID, $newPassword);
      	} catch (PDOException $e) {
        	$_SESSION['error_messages'][] = "Error changing the password.";
        	$_SESSION['form_values'] = $_POST;
        	header("Location: " . $_SERVER['HTTP_REFERER']);
        	exit;
      	}
      	$_SESSION['success_messages'][] = 'Password changed successfully';
    } else {
    	$_SESSION['error_messages'][] = "Passwords introduced don't match.";
     	$_SESSION['form_values'] = $_POST;
  	}
  } else {
 	$_SESSION['error_messages'][] = "Password inserted is incorrect.";
    $_SESSION['form_values'] = $_POST;
  }
  
  header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
  die ();
}

function editEmail() {
  if($_POST['inputNewEmail'] != $_POST['inputConfirmNewEmail']) {
    $_SESSION['error_messages'][] = "Introduced Emails don't match.";
    $_SESSION['form_values'] = $_POST;
    header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
    die ();
  }

	try {
		updateUserEmail($_SESSION['userID'], $_POST['inputNewEmail']);
	} catch (PDOException $e) {
		$_SESSION['error_messages'][] = "Unable to edit user password.";
    $_SESSION['form_values'] = $_POST;
		header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
		die ();
	}
	
	$_SESSION['success_messages'][] = "Email changed successfully.";
  $_SESSION['form_values'] = $_POST;
	
	header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
	die ();

}

$_SESSION['error_messages'][] = "No values were edited. Missing parameters.";
$_SESSION['form_values'] = $_POST;
header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );

?>
