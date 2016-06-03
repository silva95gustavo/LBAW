<?php 

function creategroup($groupName) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroup(name) VALUES(?)");
	$stmt->execute(array($groupName));
}

function addUserToGroup($groupName,$email){
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroupAssoc(groupID,studentID) (SELECT groupID,studentID
		FROM RegisteredUser,StudentGroup
		WHERE (StudentGroup.id = groupID AND StudentGroup.name = ?) AND
		(RegisteredUser.id = studentID AND RegisteredUser.email = ?)
		)");
	$stmt->execute(array($groupName,$email));
}
?>