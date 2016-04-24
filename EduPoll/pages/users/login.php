<?php
  include_once('../../config/init.php');
  include_once('../common/utils.php');
  
  if (isLoggedIn()) {
  	header('Location: ' . $BASE_URL . 'pages/users/main.php');
  	die();
  }
  
  $smarty->display('users/login.tpl');
?>
