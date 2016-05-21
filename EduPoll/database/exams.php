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

function getOngoingExams($userID){
	global $conn;
	$stmt = $conn->prepare("SELECT id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
   								FROM exam 
								WHERE has_access_exam(?,id) AND (starttime - interval '1 hour') < current_timestamp AND (endtime IS NULL OR current_timestamp < endtime)
								ORDER BY starttime ASC");
	$stmt->execute(array($userID));
	return $stmt->fetchAll();	
}	

function getUpcomingExams($userID){
	global $conn;
	$stmt = $conn->prepare("SELECT id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
   								FROM exam 
								WHERE has_access_exam(?,id) AND (starttime - interval '7 days') < current_timestamp AND current_timestamp < (starttime - interval '1 hour')
								ORDER BY starttime ASC");
	$stmt->execute(array($userID));
	return $stmt->fetchAll();
}

function getFutureExams($userID){
	global $conn;
	$stmt = $conn->prepare("SELECT id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
   								FROM exam 
								WHERE has_access_exam(?,id) AND (starttime >= (current_timestamp + interval '7 day'))
								ORDER BY starttime ASC");
	$stmt->execute(array($userID));
	return $stmt->fetchAll();
}

function wasInvited($userID, $examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT has_access_exam(?,?) AS value");
	$stmt->execute(array($userID,$examID));
	return $stmt->fetch()['value'];
}

//If 1 then the exam is over
//If 2 then the exam is active
//if 0 then the exam is not yet available
function examStatus($examID)
{
	global $conn;
	$stmt = $conn->prepare
	("SELECT status AS status FROM 
		(SELECT exam.id AS id, CASE 
			WHEN (exam.id = :examID AND exam.endtime < current_timestamp) THEN 1
            WHEN (exam.id = :examID AND (exam.starttime) < current_timestamp AND (exam.endtime IS NULL OR current_timestamp < exam.endtime)) THEN 2
            ELSE 0
       	END AS status
		FROM exam) AS cenas WHERE id = :examID");
	$stmt->bindParam(':examID', $examID, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch()['status'];
}
?> 