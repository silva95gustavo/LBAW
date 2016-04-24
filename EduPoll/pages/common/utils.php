<?php
include_once ('../../config/init.php');
function isLoggedIn() {
	return isset ( $_SESSION ['userID'] );
}
function isAdmin() {
	return isLoggedIn () && $_SESSION ['type'] == 0;
}
function isAcademic() {
	return isStudent () || isTeacher ();
}
function isStudent() {
	return isLoggedIn () && $_SESSION ['type'] == 1;
}
function isTeacher() {
	return isLoggedIn () && $_SESSION ['type'] == 2;
}
?>