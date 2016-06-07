<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/groups.php');


if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	http_response_code ( 400 );
	exit ();
}


$groupname = isset ( $_POST ['groupname'] ) ?  $_POST ['groupname'] : exit();

try {
	creategroup ( $groupname );	
} catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = 'Error on creating '.$groupname. '.' . $e->getMessage();
	$_SESSION ['form_values'] = $_POST;
	http_response_code ( 400 );
	header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
	die();
}
http_response_code ( 200 );
header ( 'Location: ' . $_SERVER['HTTP_REFERER'] );
die();
?>