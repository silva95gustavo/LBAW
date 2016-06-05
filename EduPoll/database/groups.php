<?php 

function creategroup($groupName) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroup(name) VALUES(?)");
	$stmt->execute(array($groupName));
}

function getNumberOfGroups() {
	global $conn;
	$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM StudentGroup");
	$stmt->execute();
	return $stmt->fetch()['total'];
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

function getGroups($start, $perPage) {
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM StudentGroup LIMIT ? OFFSET ?");
	$stmt->execute(array($perPage, $start));
	return $stmt->fetchAll();
}

function getStudentsByGroup($groupId) {
	global $conn;
	$stmt = $conn->prepare("SELECT * FROM RegisteredUser INNER JOIN StudentGroupAssoc ON StudentGroupAssoc.studentID = RegisteredUser.id AND StudentGroupAssoc.groupID = ?");
	$stmt->execute(array($groupId));
	return $stmt->fetchAll();
}

function getName($groupId) {
	global $conn;
	$stmt = $conn->prepare("SELECT name FROM StudentGroup WHERE StudentGroup.id = ?");
	$stmt->execute(array($groupId));
	return $stmt->fetch()['name'];
}
?>