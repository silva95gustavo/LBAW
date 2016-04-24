<?php
  include_once('../../config/init.php');
  
  if (isLoggedIn()) {
  	header('Location: ' . $BASE_URL . 'pages/users/main.php');
  	die();
  }
  
  $smarty->display('users/login.tpl');
?>
