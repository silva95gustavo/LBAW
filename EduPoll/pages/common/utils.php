<?php
require_once ('../../config/init.php');
require_once ('../../database/users.php');

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

if (isLoggedIn())
	$userInfo = getUserInfo($_SESSION['userID']);
?>