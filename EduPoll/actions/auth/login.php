<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/users.php');  

  if (!$_POST['email'] || !$_POST['password']) {
    $_SESSION['error_messages'][] = 'Invalid login';
    $_SESSION['form_values'] = $_POST;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];
  
  if ($result = isLoginCorrect($email, $password)) {
  	$_SESSION['userID'] = $result['id'];
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $result['name'];
    $_SESSION['gender'] = $result['gender'];
    //$_SESSION['success_messages'][] = 'Login successful';  
  } else {
    $_SESSION['error_messages'][] = 'Login failed';  
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
  }
  header('Location: ' . $BASE_URL . 'pages/users/main.php');
?>
