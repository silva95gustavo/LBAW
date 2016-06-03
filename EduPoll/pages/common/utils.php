<?php
require_once ('../../config/init.php');
require_once ('../../database/users.php');

$passwordLength = 8;

function isLoggedIn() {
	return isset ( $_SESSION ['userID'] );
}
function isAdmin() {
	global $userInfo;
	return isLoggedIn () && $userInfo['type'] == 0;
}
function isAcademic() {
	return isStudent () || isTeacher ();
}
function isStudent() {
	global $userInfo;
	return isLoggedIn () && $userInfo['type'] == 2;
}
function isTeacher() {
	global $userInfo;
	return isLoggedIn () && $userInfo['type'] == 1;
}

function sendEmail($email, $message) {
  $message = wordwrap($message, 70, "\r\n");
  // Send
  $headers   = array();
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/plain; charset=iso-8859-1";
  $headers[] = "From: Edupoll <edupoll@fe.up.pt>";
  $headers[] = "Reply-To: Edupoll <edupoll@fe.up.pt>";
  $headers[] = "Subject: Edupoll Signup";
  $headers[] = "X-Mailer: PHP/".phpversion();

  mail($email, "Edupoll Signup", $message, implode("\r\n", $headers));
}

function validateCSRFToken($token) {
	return $_SESSION['csrf_token'] == $token;
}

function generatePassword(){
	// password generation
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$count = mb_strlen ( $chars );
	for($i = 0, $password = ''; $i < $passwordLength; $i ++) {
		$index = rand ( 0, $count - 1 );
		$password .= mb_substr ( $chars, $index, 1 );
	}
	return $password;
}

function emailSender($name,$password,$email){
	// The message
	$message = "Edupoll Sign Up" . "\r\nHello, " . $name . "!" . "\r\nYou have been registered on Edupoll's platform." . "\r\nYour Password is: " . $password . "\r\nGood Luck with your exams!";
	sendEmail ( $email, $message );
}

function registerUser($name, $email, $gender, $password, $type ){
	createUser( $name, $email, $gender, $password, $type );
}

if (isLoggedIn())
	$userInfo = getUserInfo($_SESSION['userID']);
?>