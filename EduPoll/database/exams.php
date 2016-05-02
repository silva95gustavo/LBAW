<?php 

function createExam($ownerID, $name, $description, $open, $maxTries) {
	global $conn;
    $stmt = $conn->prepare("INSERT INTO exam
    		(name, description, ownerID, openToPublic, maxTries)
            VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute(array($name, $description, $ownerID, $open, $maxTries));
}

function getExam($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT name, description, starttime, endtime, opentopublic, maxtries, maxscore
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
?>