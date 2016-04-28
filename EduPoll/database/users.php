<?php
  
  function createUser($name, $email, $gender, $password, $type) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO RegisteredUser(name, email, gender, passwordHash, type) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute(array($name, $email, $gender, password_hash($password), $type));
  }

  function isLoginCorrect($email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM RegisteredUser 
                            WHERE email = ?");
    $stmt->execute(array($email));
    $result = $stmt->fetch();
    if (!$result)
    	return false;
    if (password_verify($password, $result['passwordhash']))
    	return $result;
    else return false;
  }
  
  function getUserInfo($userID) {
  	global $conn;
  	$stmt = $conn->prepare("SELECT * FROM RegisteredUser WHERE id = ?");
  	$stmt->execute(array($userID));
  	return $stmt->fetch();
  }
?>
