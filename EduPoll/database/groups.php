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
function searchGroupFTS($data, $groupID = null) {
  global $conn;
  if(!$groupID){
    $stmt = $conn->prepare("SELECT id,name FROM StudentGroup WHERE to_tsvector('english', name) @@ plainto_tsquery('english', ?)");
    $stmt->execute(array($data));
  }
  else{  
    $stmt = $conn->prepare("SELECT id,name FROM StudentGroup WHERE NOT (id = ?)
       AND to_tsvector('english', name) @@ plainto_tsquery('english', ?)");
    $stmt->execute(array($groupID,$data));
  }
  return $stmt->fetchAll();
}

function getGroups($start,$perPage){
	global $conn;
	$stmt = $conn->prepare("SELECT StudentGroup.id, StudentGroup.name FROM StudentGroup LIMIT ? OFFSET ?");
	$stmt->execute(array($perPage,$start));
	return $stmt->fetchAll();
}
function getStudentsByGroup($groupID){
	global $conn;
	$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM StudentGroupAssoc WHERE StudentGroupAssoc.groupID = ?");
	$stmt->execute(array($groupID));
	return $stmt->fetch()['total'];
}
function getName($groupID){
	global $conn;
	$stmt = $conn->prepare("SELECT name AS groupname FROM StudentGroup WHERE id = ?");
	$stmt->execute(array($groupID));
	return $stmt->fetch()['groupname'];
}
function getGroupStudents($groupID, $start, $perPage)
{
	global $conn;
	$stmt = $conn->prepare("SELECT RegisteredUser.id AS studentid,RegisteredUser.name AS studentname, RegisteredUser.email AS studentemail
  	FROM StudentGroupAssoc,RegisteredUser WHERE StudentGroupAssoc.groupID = ?
  	AND StudentGroupAssoc.studentID = RegisteredUser.id
	LIMIT ? OFFSET ?");
	$stmt->execute(array($groupID, $perPage, $start));
	return $stmt->fetchAll();
}
function getNumberOfGroups(){
	global $conn;
	$stmt = $conn->prepare("SELECT COUNT(*) as total FROM StudentGroup");
	$stmt->execute();
	return $stmt->fetch()['total'];
}
function add($userToAdd, $groupOfUser)
{
	global $conn;
	$stmt = $conn->prepare("INSERT INTO StudentGroupAssoc VALUES(?,?)");
	$stmt->execute(array($groupOfUser,$userToAdd));
	return $stmt->fetchAll();
}
function removeUserFromGroup($userToRemove,$groupOfUser)
{
	global $conn;
	$stmt = $conn->prepare("DELETE FROM StudentGroupAssoc WHERE StudentGroupAssoc.studentID = ? AND StudentGroupAssoc.groupID = ?");
	$stmt->execute(array($userToRemove,$groupOfUser));
	return $stmt->fetchAll();
}
function removeGroup($groupID)
{
	global $conn;
	$stmt = $conn->prepare("DELETE FROM StudentGroup WHERE StudentGroup.id = ?");
	$stmt->execute(array($groupID));
	$stmt = $conn->prepare("DELETE FROM StudentGroupAssoc WHERE StudentGroupAssoc.groupID = ?");
	$stmt->execute(array($groupID));
	return $stmt->fetchAll();
}
?>