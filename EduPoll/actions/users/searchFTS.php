<?php
  include_once('../../config/init.php');
  include_once($BASE_DIR .'database/users.php');  
  require_once($BASE_DIR . 'pages/common/utils.php');
  

  $data = isset($_POST['data']) ? (int)$_POST['data'] : exit;
  $result = null;
  
  try {
      $result = searchUserFTS($data);
  } catch (PDOException $e) {
      echo json_encode("Error");
    exit;
  }
  
  echo json_encode($result);
?>
