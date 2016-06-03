<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/exams.php');
require_once ('../../database/groups.php');

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
	$StudentsRegistered = 0;
	$StudentsError = 0;
	if($json_object['students'])
	{
		$studentN = -1;
		foreach ($json_object['students'] as $student) {
			$studentN += 1;
			if(sizeof($student) > 3){
				$StudentsError += 1;
				continue;
			}
			if(!($student["name"])){
				$StudentsError += 1;
				continue;
			}
			else if(!is_string($student["name"]))
			{
				$StudentsError += 1;
				continue;
			}
			if(!($student["email"])){
				$StudentsError += 1;
				continue;
			}
			else if(!filter_var($student["email"], FILTER_VALIDATE_EMAIL))
			{
				$StudentsError += 1;
				continue;
			}
			if(!isset($student["gender"])){
				$StudentsError += 1;
				continue;
			}
			else if(!is_numeric($student["gender"])){
				$StudentsError += 1;
				continue;
			}

			$password = generatePassword();
			try{
				registerUser($student["name"], $student["email"], $student["gender"], $password, 2 );
			}
			catch ( PDOException $e ) {
				if (strpos ( $e->getMessage (), 'users_pkey' ) !== false) {
					$StudentsError += 1;
				} else
				$StudentsError += 1;
				continue;
			}
			emailSender($student["name"],$password,$student["email"]);
			$StudentsRegistered += 1;
		}
		$_SESSION ['success_messages'] [] = $StudentsRegistered . " Students registered. " . $StudentsError . " Students failed to be registered.";
	}
	if($json_object['teachers'])
	{
		$TeachersRegistered = 0;
		$TeacherError = 0;
		$teacherN = -1;
		foreach ($json_object['teachers'] as $teacher){
			$teacherN += 1;
			if(!($teacher["name"])){
				$TeacherError += 1;
				continue;
			}
			else if(!is_string($teacher["name"]))
			{
				$TeacherError += 1;
				continue;
			}
			if(!($teacher["email"])){
				$TeacherError += 1;
				continue;
			}
			else if(!filter_var($teacher["email"], FILTER_VALIDATE_EMAIL))
			{
				$TeacherError += 1;
				continue;
			}
			if(!isset($teacher["gender"])){
				$TeacherError += 1;
				continue;
			}
			else if(!is_numeric($teacher["gender"])){
				$TeacherError += 1;
				continue;
			}$password = generatePassword();
			try{
				registerUser($teacher["name"], $teacher["email"], $teacher["gender"], $password, 1 );
			}
			catch ( PDOException $e ) {
				if (strpos ( $e->getMessage (), 'users_pkey' ) !== false) {
					$TeacherError += 1;
				} else
				$TeacherError += 1;
				continue;
			}
			emailSender($student["name"],$password,$student["email"]);
			$TeachersRegistered += 1;
		}
		$_SESSION ['success_messages'] [] = $TeachersRegistered . " Teachers registered. " . $TeacherError . " Teachers failed to be registered.";
	}
	if($json_object['categories'])
	{
		foreach ($json_object['categories'] as $category) {
			if($category['name'])
			{
				try{
					creategroup($category['name']);
				}
				catch (PDOException $e ) {
					if(strpos ( $e->getMessage (), 'duplicate key value violates unique constraint "studentgroup_name_key"' ) !== false){
						continue;
					}
				}
			}
			foreach ($category['users'] as $user) {
				if(filter_var($user, FILTER_VALIDATE_EMAIL)){
					try{
						addUserToGroup($category['name'],$user);
					}
					catch ( PDOException $e ){
						continue;		
					}
				}
			}
		}
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