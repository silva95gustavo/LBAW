<?php 

function creategroup($groupName) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroup(name) VALUES(?)");
	$stmt->execute(array($groupName));
}

function addUserToGroup($groupName,$email){
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroupAssoc(groupID,studentID) 
		(SELECT StudentGroup.id,RegisteredUser.id
      FROM RegisteredUser, StudentGroup
      WHERE (StudentGroup.name = ?) AND
      (RegisteredUser.email = ?)
      )");
	$stmt->execute(array($groupName,$email));
}
function searchGroupFTS($data) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, name FROM studentgroup WHERE to_tsvector('english', name) @@ plainto_tsquery('english', ?)");
    $stmt->execute(array($data));
	return $stmt->fetchAll();
}
?>