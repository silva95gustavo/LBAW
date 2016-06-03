<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');

if (! isAdmin ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
	die ();
}

if (! validateCSRFToken ( $_POST ['csrf_token'] )) {
	$_SESSION ['error_messages'] [] = 'CSRF token missing.';
	header ( "Location: " . $_SERVER ['HTTP_REFERER'] );
	die ();
}

function validateJSON($json_object)
{
	$UsersRegistered = 0;
	if($json_object['students'])
	{
		$studentN = -1;
		foreach ($json_object['students'] as $student) {
			$studentN += 1;
			if(sizeof($student) > 3){
				$_SESSION ['error_messages'] [] = "Too many parameters for Student " . $studentN . ".";
				continue;
			}
			if(!($student["name"])){
				$_SESSION ['error_messages'] [] = "Name of Student " . $studentN . " does not exist.";
				continue;
			}
			else if(!is_string($student["name"]))
			{
				$_SESSION ['error_messages'] [] = "Name of Student " . $studentN . " not a string.";
				continue;
			}
			if(!($student["email"])){
				$_SESSION ['error_messages'] [] = "Email of Student " . $studentN . " does not exist.";
				continue;
			}
			else if(!filter_var($student["email"], FILTER_VALIDATE_EMAIL))
			{
				$_SESSION ['error_messages'] [] = "Email of Student " . $studentN . " is invalid.";
				continue;
			}
			if(!isset($student["gender"])){
				$_SESSION ['error_messages'] [] = "Gender of Student " . $studentN . " does not exist.";
				continue;
			}
			else if(!is_numeric($student["gender"])){
				$_SESSION ['error_messages'] [] = "Gender of Student " . $studentN . " not a number.";
				continue;
			}

			$password = generatePassword();
			try{
				registerUser($student["name"], $student["email"], $student["gender"], $password, 0 );
			}
			catch ( PDOException $e ) {
				if (strpos ( $e->getMessage (), 'users_pkey' ) !== false) {
					$_SESSION ['error_messages'] [] = 'Duplicate username of Student ' . $studentN . ".";
				} else
				$_SESSION ['error_messages'] [] = 'Error on user registration of Student ' . $studentN . ".". $e->getMessage ();
				continue;
			}
			emailSender($student["name"],$password,$student["email"]);
			$UsersRegistered += 1;
		}
	$_SESSION ['success_messages'] [] = $UsersRegistered . " Students registered.";
	}
	if($json_object['teachers'])
	{
		$TeachersRegistered = 0;
		$teacherN = -1;
		foreach ($json_object['teachers'] as $teacher){
			$teacherN += 1;
			if(sizeof($teacher) > 3){
				$_SESSION ['error_messages'] [] = "Too many parameters for Teacher " . $teacherN . ".";
				continue;
			}
			if(!($teacher["name"])){
				$_SESSION ['error_messages'] [] = "Name of Teacher " . $teacherN . " does not exist.";
				continue;
			}
			else if(!is_string($teacher["name"]))
			{
				$_SESSION ['error_messages'] [] = "Name of Teacher " . $teacherN . " not a string.";
				continue;
			}
			if(!($teacher["email"])){
				$_SESSION ['error_messages'] [] = "Email of Teacher " . $teacherN . " does not exist.";
				continue;
			}
			else if(!filter_var($teacher["email"], FILTER_VALIDATE_EMAIL))
			{
				$_SESSION ['error_messages'] [] = "Email of Teacher " . $teacherN . " is invalid.";
				continue;
			}
			if(!isset($teacher["gender"])){
				$_SESSION ['error_messages'] [] = "Gender of Teacher " . $teacherN . " does not exist.";
				continue;
			}
			else if(!is_numeric($teacher["gender"])){
				$_SESSION ['error_messages'] [] = "Gender of Student " . $teacherN . " not a number.";
				continue;
			}$password = generatePassword();
			try{
				registerUser($teacher["name"], $teacher["email"], $teacher["gender"], $password, 1 );
			}
			catch ( PDOException $e ) {
				if (strpos ( $e->getMessage (), 'users_pkey' ) !== false) {
					$_SESSION ['error_messages'] [] = 'Duplicate username of Teacher ' . $teacherN . ".";
				} else
				$_SESSION ['error_messages'] [] = 'Error on user registration of Teacher ' . $teacherN . ".";
				continue;
			}
			emailSender($student["name"],$password,$student["email"]);
			$TeachersRegistered += 1;
		}
	$_SESSION ['success_messages'] [] = $TeachersRegistered . " Teachers registered.";
	}
}

if(isset($_POST["json_file"])){
	$json_object = json_decode(file_get_contents($_FILES["json_file"]["tmp_name"]),true);
	if($json_object){
		validateJSON($json_object);
	}
	else $_SESSION ['error_messages'] [] = "Syntax Error in JSON File";
	header ( 'Location: ' . $BASE_URL . 'pages/admin/main.php' );
	die ();
}
else
{
	$_SESSION ['error_messages'] [] = "File Upload Failed";
	header ( 'Location: '  . $_SERVER ['HTTP_REFERER']);
	die ();
}


?>