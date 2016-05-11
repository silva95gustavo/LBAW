<?php
include_once('../../config/init.php');
include_once($BASE_DIR .'database/users.php');  
require_once($BASE_DIR . 'pages/common/utils.php');


if(isset($_POST['inputNewEmail']))
  updateUserEmail();
else
  updateUserPasssword();


function updateUserPasssword() {

  $userID = $_SESSION['userID'];
  $oldPassword = $_POST['inputOldPassword'];
  $newPassword = $_POST['inputNewPassword'];
  $newPasswordVerify = $_POST['inputConfirmPassword'];

  if(isPasswordCorrect($userID, $oldPassword)) {
    if($newPassword == $newPasswordVerify) {

      try {
        updateUserPassword($userID, $newPassword);
      } catch (PDOException $e) {
        $_SESSION['error_messages'][] = "Error changing the password.";
        $_SESSION['form_values'] = $_POST;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
      }
      $_SESSION['success_messages'][] = 'Password changedSuccessfully';
      header("Location: " . $_SERVER['HTTP_REFERER']);

    }
    else
    {
     $_SESSION['error_messages'][] = "Passwords introduced don't check.";
     $_SESSION['form_values'] = $_POST;
     header("Location: " . $_SERVER['HTTP_REFERER']);
     exit;
   }
 }
}

function updateUserEmail($userID, $newEmail) {

}
?>
