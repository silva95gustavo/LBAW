<?
require_once ('../../config/init.php');
require_once ($BASE_DIR . 'pages/common/utils.php');
require_once ('../../database/exams.php');

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	http_response_code ( 400 );
	exit ();
}

$userToAdd = isset ( $_POST ['id'] ) ? ( int ) $_POST ['id'] : exit ();
$examId = isset ( $_POST ['examId'] ) ? ( int ) $_POST ['examId'] : exit();

try {
	if( addUserToExam ( $userToAdd, $examId ) == -1) {
		$_SESSION ['error_messages'] [] = 'Error on user assignement.';
		$_SESSION ['form_values'] = $_POST;
		http_response_code ( 400 );
		exit ();
	}
} catch ( PDOException $e ) {
	$_SESSION ['error_messages'] [] = 'Error on user assignement.';
	$_SESSION ['form_values'] = $_POST;
	http_response_code ( 400 );
	exit ();
}
http_response_code ( 200 );
?>