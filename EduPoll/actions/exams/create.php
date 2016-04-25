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
  
  if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_POST['examType'])) {
  	$_SESSION['error_messages'][] = 'Missing fields.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['name'] == 0)) {
  	$_SESSION['error_messages'][] = 'Exam name cannot be empty.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['name']) > 100) {
  	$_SESSION['error_messages'][] = 'Exam name too big.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  if (strlen($_POST['description']) > 10000) {
  	$_SESSION['error_messages'][] = 'Description too big.';
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  
  try {
  	createExam($userInfo['id'], trim($_POST['name']), $_POST['description'], !$_POST['examType']);
  } catch (PDOException $e) {
  	$_SESSION['error_messages'][] = 'Error creating exam: ' . $e->getMessage();
  	$_SESSION['form_values'] = $_POST;
  	header("Location: " . $_SERVER['HTTP_REFERER']);
  	exit;
  }
  $_SESSION['success_messages'][] = 'Exam successfully created.';
  header("Location: " . $_SERVER['HTTP_REFERER']);
  ?>