<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/groups.php');  
  require_once($BASE_DIR . 'pages/common/utils.php');
  

  $data = isset($_POST['data']) ? (int)$_POST['data'] : exit;
  $userID =  $_SESSION['userID'];

  $result = null;
  
  try {
      $result = searchGroupFTS($userID,$data);
  } catch (PDOException $e) {
      echo json_encode("Error");
    exit;
  }
  
  echo json_encode($result);
?>
