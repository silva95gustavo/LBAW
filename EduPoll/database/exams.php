<?php 

function createExam($ownerID, $name, $description, $startTime, $endTime, $open, $maxTries) {
	global $conn;
	if($startTime != null) {
		$stmt = $conn->prepare("INSERT INTO exam
    		(name, description, ownerID, startTime, endTime, openToPublic, maxTries)
            VALUES (?, ?, ?, ?, ?, ?, ?) RETURNING id");
		if($stmt->execute(array($name, $description, $ownerID, $startTime, $endTime, $open, $maxTries)))
	    {
	    	return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
	    }
	    else return -1;
	}
	
	$stmt = $conn->prepare("INSERT INTO exam
    		(name, description, ownerID, openToPublic, maxTries)
            VALUES (?, ?, ?, ?, ?) RETURNING id");
	if($stmt->execute(array($name, $description, $ownerID, $open, $maxTries)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
    }
    else return -1;
}

function getExam($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
   		FROM exam
   		WHERE id = ?");
	$stmt->execute(array($examID));
	return $stmt->fetch();
}

function getOwnedAndManagedExams($userID) {
	global $conn;
	$stmt = $conn->prepare("(SELECT id, name, description, startTime, endTime, openToPublic, ownerID FROM Exam WHERE ownerID = ? OR id IN
		(SELECT examID FROM ManagesExam WHERE managerID = ?)
		ORDER BY startTime DESC)");
	$stmt->execute(array($userID, $userID));
	return $stmt->fetchAll();
}

function getExamOwner($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT registereduser.id, registereduser.name
								FROM registereduser INNER JOIN exam ON exam.ownerid = registereduser.id
								WHERE exam.id = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function getExamManagers($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT registereduser.id, registereduser.name
								FROM registereduser INNER JOIN managesexam ON managesexam.managerid = registereduser.id
								WHERE managesexam.examid = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function getOtherExamManagers($examID, $userID) {
	global $conn;
	$stmt = $conn->prepare("SELECT registereduser.id, registereduser.name
								FROM registereduser INNER JOIN managesexam ON managesexam.managerid = registereduser.id
								WHERE managesexam.examid = ? AND registereduser.id != ?");
	$stmt->execute(array($examID, $userID));
	return $stmt->fetchAll();
}

function isExamManager($userID, $examID) {
	global $conn;
	$stmt = $conn->prepare("(SELECT managerid FROM managesexam WHERE manager = ? AND examid = ?");
	$stmt->execute(array($userID, $examID));
	if(count($stmt->fetchAll()) > 0)
		return true;
	else
		return false;
}

function editExamName($examID, $newName) {
	global $conn;
	$stmt = $conn->prepare("UPDATE exam SET name = ? WHERE id = ? RETURNING name");
	$stmt->execute(array($newName, $examID));
	return $stmt->fetchAll();
}

function editExamDescription($examID, $newDescription) {
	global $conn;
	$stmt = $conn->prepare("UPDATE exam SET description = ? WHERE id = ? RETURNING description");
	$stmt->execute(array($newDescription, $examID));
	return $stmt->fetchAll();
}

function deleteExam($examID) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM exam WHERE id = ?");
	return $stmt->execute(array($examID));
}

function getNumberOfExams(){
	global $conn;
	$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM exam");
	$stmt->execute();
	return $stmt->fetch()['total'];
}

function getUserPreviousExams($userID) {
	global $conn;
	$stmt = $conn->prepare("SELECT attempt.id, attempt.starttime, attempt.endtime, attempt.finalscore, attempt.examid, exam.name, exam.maxscore 
								FROM attempt INNER JOIN exam ON attempt.examid = exam.id 
								WHERE attempt.userid = ? AND attempt.endtime IS NOT NULL
								ORDER BY attempt.starttime ASC");
	$stmt->execute(array($userID));
	return $stmt->fetchAll();
}

?>
