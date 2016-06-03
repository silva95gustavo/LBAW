<?php
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/users.php');

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 14; $i++) {
        $n = rand(0, $alphaLength);
        $pass[$i] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

$email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$_SESSION['error_messages'][] = 'Email is invalid.';
	http_response_code ( 400 );
	die;
}

$user = getUserByEmail($email)[0];
if(!isset($user)) {
	$_SESSION['error_messages'][] = 'No user was found with that email.';
	http_response_code ( 400 );
	die;
}

$newPassword = randomPassword();
updateUserPassword($user['id'], $newPassword);

resetPasswordEmailSender($user['name'],$newPassword,$email);

$_SESSION['success_messages'][] = 'Password reset e-mail has been sent.';
http_response_code ( 200 );
?>

