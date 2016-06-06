<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');


header('Content-Type: application/json');

if (! isLoggedIn ()) {
	http_response_code(401);
	echo 'You are not logged in.';
	exit ();
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	die ();
}

try{
	if (!isExamManagerOrOwner($userInfo ['id']),$_POST ['examid']) {
			http_response_code(403);
			echo 'Only the owner/manager of an exam may add a question answer.';
			exit;
	}
}catch(PDOException $e){
			http_response_code(400);
			echo 'Invalid Inputs.';
			exit;
}

try{
	changeShareSetting($_POST ['examid'],$_POST ['state']);
}
catch(PDOException $e){
			http_response_code(400);
			echo 'Could not change share setting.';
			exit;
}

http_response_code(200);

?>