<?php
  
  function createUser($realname, $username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users VALUES (?, ?, ?)");
    $stmt->execute(array($username, $realname, password_hash($password)));
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
