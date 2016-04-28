<?php
  require_once('../../config/init.php');
  require_once($BASE_DIR .'database/exams.php');  
  require_once($BASE_DIR . 'pages/common/utils.php');
  
  if (!isLoggedIn()) {
  	$_SESSION['error_messages'][] = 'You are not logged in.';
  	header("Location: $BASE_URL");
  	exit;
  }
  
  if (!isAcademic()) {
  	$_SESSION['error_messages'][] = 'You don\'t have permission to create an exam.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (!isset($_POST['examName']) || !isset($_POST['examDescription']) || !isset($_POST['examMaxTries'])) {
  	$_SESSION['error_messages'][] = 'Missing fields.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['examName']) == 0) {
  	$_SESSION['error_messages'][] = 'Exam name cannot be empty.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['examName']) > 100) {
  	$_SESSION['error_messages'][] = 'Exam name too big.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['examDescription']) > 10000) {
  	$_SESSION['error_messages'][] = 'Description too big.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (!ctype_digit($_POST['examMaxTries']) || (int)$_POST['examMaxTries'] < 0) {
  	$_SESSION['error_messages'][] = 'Invalid value for the maximum amount of tries, it must be a positive integer.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  try {
  	createExam($userInfo['id'], trim($_POST['examName']), $_POST['examDescription'], (isset($_POST['examType']) && !isStudent()) ? 0 : 1, $_POST['examMaxTries']);
  } catch (PDOException $e) {
  	$_SESSION['error_messages'][] = 'Error creating exam: ' . $e->getMessage();
  	$_SESSION['form_values'] = $_POST;
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  $_SESSION['success_messages'][] = 'Exam successfully created.';
  header("Location: " . $_SERVER['HTTP_REFERER']);
  ?>