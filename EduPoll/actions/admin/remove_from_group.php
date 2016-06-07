<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/groups.php');


if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	http_response_code ( 400 );
	exit ();
}

$userToRemove = isset ( $_POST ['userid'] ) ? ( int ) $_POST ['userid'] : exit ();

$groupOfUser = isset ( $_POST ['groupid'] ) ? ( int ) $_POST ['groupid'] : exit ();

try {
	removeUserFromGroup ( $userToRemove, $groupOfUser );	
} catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = 'Error on removing user from group.';
	$_SESSION ['form_values'] = $_POST;
	http_response_code ( 400 );
	exit ();
}
http_response_code ( 200 );
?>