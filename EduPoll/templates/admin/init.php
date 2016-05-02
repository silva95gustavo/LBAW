<?php
  //session_set_cookie_params(3600, '/~lbaw1565/proto'); // FIXME
  session_set_cookie_params(3600, '/~up201305803/EduPoll'); // FIXME
  session_start();

  error_reporting(E_ERROR | E_WARNING); // E_NOTICE by default

  //$BASE_DIR = '/opt/lbaw/lbaw1565/public_html/proto/';
  $BASE_DIR = '/usr/users2/mieic2013/up201304143/public_html/EduPoll/';
  //$BASE_URL = '/~lbaw1565/proto/';
  $BASE_URL = '/~up201305803/EduPoll';

  $conn = new PDO('pgsql:host=dbm;dbname=lbaw1565', 'lbaw1565', 'BN80V7U5');
  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $conn->exec('SET SCHEMA \'public\'');

  include_once($BASE_DIR . 'lib/smarty/Smarty.class.php');
  include_once($BASE_DIR . 'lib/phpPasswordHashingLib/passwordLib.php');
  
  $smarty = new Smarty;
  $smarty->template_dir = $BASE_DIR . 'templates/';
  $smarty->compile_dir = $BASE_DIR . 'templates_c/';
  $smarty->assign('BASE_URL', $BASE_URL);
  
  $smarty->assign('ERROR_MESSAGES', $_SESSION['error_messages']);  
  $smarty->assign('FIELD_ERRORS', $_SESSION['field_errors']);
  $smarty->assign('SUCCESS_MESSAGES', $_SESSION['success_messages']);
  $smarty->assign('FORM_VALUES', $_SESSION['form_values']);
  
  unset($_SESSION['success_messages']);
  unset($_SESSION['error_messages']);  
  unset($_SESSION['field_errors']);
  unset($_SESSION['form_values']);
?>
