<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/users.php');  
  require_once($BASE_DIR . 'pages/common/utils.php');
  

  $userToDelete = isset($_POST['id']) ? (int)$_POST['id'] : exit;
  $result = null;
  try {
    $result = deleteUser($userToDelete);
  } catch (PDOException $e) {
    //$_SESSION['error_messages'][] = 'Error on user deletion.';
    $_SESSION['error_messages'][] = $result;
    $_SESSION['form_values'] = $_POST;
    http_response_code(400);
    exit;
  }
  http_response_code(200);
  

?>
