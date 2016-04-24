<?php
  require_once('../../config/init.php');
  
  if (!isLoggedIn()) {
  	header('Location: ' . $BASE_URL . 'pages/users/login.php');
  	die();
  }
  
  $smarty->assign('name', $_SESSION['name']);
  $smarty->display('users/main.tpl');
?>
