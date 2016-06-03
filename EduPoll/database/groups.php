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
?>