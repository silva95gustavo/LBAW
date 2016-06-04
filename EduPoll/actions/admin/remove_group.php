<?php
include_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/groups.php');


if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	http_response_code ( 400 );
	exit ();
}

$groupid = isset ( $_POST ['groupid'] ) ? ( int ) $_POST ['groupid'] : exit ();

try {
	removeGroup ( $groupid );	
} catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = 'Error on removing group.';
	$_SESSION ['form_values'] = $_POST;
	http_response_code ( 400 );
	exit ();
}
http_response_code ( 200 );
?>