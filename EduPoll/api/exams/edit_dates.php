<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');


if (! isLoggedIn ()) {
	$_SESSION ['error_messages'] [] = 'You are not logged in.';
	header ( "Location: $BASE_URL" );
	http_response_code(400);
	exit ();
}

if (! isAcademic ()) {
	$_SESSION ['error_messages'] [] = 'You don\'t have permission to create an exam.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	http_response_code(400);
	exit ();
}

$examID = $_POST['examID'];

if(isset($_POST['startTime'])){
	try{
		if($_POST['startTime'] != null)
			setStartDate($examID, $_POST['startTime']);
	} catch(PDOException $e) {
		$_SESSION ['error_messages'] [] = 'Error trying to modify Start date.';
		header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
		http_response_code(400);
		exit ();
	}

}

if(isset($_POST['endTime'])){
	try{
		if($_POST['endTime'] != null)
			setEndDate($examID, $_POST['endTime']);
	} catch(PDOException $e) {
		$_SESSION ['error_messages'] [] = 'Error trying to modify End date.';
		header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
		http_response_code(400);
		exit ();
	}
}

$_SESSION ['success_messages'] [] = 'Dates changed successfully.';
header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
http_response_code(200);
exit ();

?>