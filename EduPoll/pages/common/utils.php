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
	return isLoggedIn () && $userInfo['type'] == 1;
}
function isTeacher() {
	global $userInfo;
	return isLoggedIn () && $userInfo['type'] == 2;
}

function sendEmail($email, $message) {
  $message = wordwrap($message, 70, "\r\n");
  // Send
  $headers   = array();
  $headers[] = "MIME-Version: 1.0";
  $headers[] = "Content-type: text/plain; charset=iso-8859-1";
  $headers[] = "From: Sender Name <edupoll@fe.up.pt>";
  $headers[] = "Reply-To: Edupoll <edupoll@fe.up.pt>";
  $headers[] = "Subject: Edupoll Signup";
  $headers[] = "X-Mailer: PHP/".phpversion();

  mail($email, "Edupoll Signup", $message, implode("\r\n", $headers));

}

if (isLoggedIn())
	$userInfo = getUserInfo($_SESSION['userID']);



?>