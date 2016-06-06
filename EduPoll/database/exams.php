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
	$stmt = $conn->prepare("SELECT id, name, description, ownerid, starttime, endtime, opentopublic, publicgrades, maxtries, maxscore
   		FROM exam
   		WHERE id = ?");
	$stmt->execute(array($examID));
	return $stmt->fetch();
}

function getExamByDate($day,$month,$year,$userid){
	$firsttimestamp = '20'.$year.'-'.$month.'-'.$day.' 23:59:59';
	$secondtimestamp = '20'.$year.'-'.$month.'-'.$day.' 00:00:00';
	global $conn;
	$stmt = $conn->prepare("SELECT *,0 AS type FROM exam WHERE ? >= starttime AND ? <= endtime AND 	has_access_exam(?,id)
		UNION
	 	SELECT *,1 AS type FROM exam WHERE ? >= starttime AND ? <= endtime AND ? = ownerid 
	 	UNION
	 	SELECT *,2 AS type FROM exam WHERE ? >= starttime AND ? <= endtime AND ? IN (SELECT managerID FROM ManagesExam WHERE Exam.id = ManagesExam.examID)");
	$stmt->execute(array($firsttimestamp,$secondtimestamp,$userid,$firsttimestamp,$secondtimestamp,$userid,$firsttimestamp,$secondtimestamp,$userid));
	return $stmt->fetchAll();
}

function getExamStats($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT COUNT(id) AS attempts, AVG(finalscore) AS averagegrade
								FROM attempt
								WHERE examid = ?");
	$stmt->execute(array($examID));
	return $stmt->fetch();
}

function getExamApprovals($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT *
								FROM attempt
								WHERE examid = ? AND finalscore >= 9.5");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function getExamQuestions($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT id, statement
								FROM question
								WHERE (category IS NOT NULL AND category IN (SELECT id FROM examelement WHERE examid = ?))
									OR (id IN (SELECT id FROM examelement WHERE examid = ?))");
	$stmt->execute(array($examID, $examID));
	return $stmt->fetchAll();
}

function getExamStudentGrades($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT attempt.id AS attemptid, registereduser.id AS userid, registereduser.name AS username, finalscore
							FROM attempt INNER JOIN registereduser ON registereduser.id = attempt.userid
							WHERE attempt.examid = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function getQuestion($questionID) {
	global $conn;
	$stmt = $conn->prepare("SELECT *
								FROM question
								WHERE id = ?");
	$stmt->execute(array($questionID));
	return $stmt->fetch();
}

function getCategory($categoryID) {
	global $conn;
	$stmt = $conn->prepare("SELECT *
								FROM category
								WHERE id = ?");
	$stmt->execute(array($categoryID));
	return $stmt->fetch();
}

function getQuestionAverageScore($questionID) {
	global $conn;
	$stmt = $conn->prepare("SELECT question.id AS questionid, question.statement AS statement, AVG(answer.score) AS score, COUNT(answer.id) AS answers
								FROM questionattempt INNER JOIN question ON questionattempt.questionid = question.id
									INNER JOIN answer ON answerid = answer.id
								WHERE question.id = ?
								GROUP BY question.id, question.statement");
	$stmt->execute(array($questionID));
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
	$stmt = $conn->prepare("SELECT managerid FROM managesexam WHERE managerid = ? AND examid = ?");
	$stmt->execute(array($userID, $examID));
	if(count($stmt->fetchAll()) > 0)
		return true;
	else
		return false;
}

function isExamManagerOrOwner($userID, $examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT managerid FROM managesexam WHERE managerid = ? AND examid = ?
		UNION SELECT ownerid FROM exam WHERE id = ? AND ownerid = ?");
	$stmt->execute(array($userID, $examID,$examID,$userID));
	if(count($stmt->fetchAll()) > 0)
		return true;
	else
		return false;
}

function editExamName($examID, $newName) {
	global $conn;
	$stmt = $conn->prepare("UPDATE exam SET name = ? WHERE id = ? RETURNING name");
	$stmt->execute(array($newName, $examID));
	return $stmt->fetch();
}

function editExamDescription($examID, $newDescription) {
	global $conn;
	$stmt = $conn->prepare("UPDATE exam SET description = ? WHERE id = ? RETURNING description");
	$stmt->execute(array($newDescription, $examID));
	return $stmt->fetch();
}

function editCategoryName($categoryID, $newName) {
	global $conn;
	$stmt = $conn->prepare("UPDATE category SET name = ? WHERE id = ? RETURNING name");
	$stmt->execute(array($newName, $categoryID));
	return $stmt->fetch();
}

function editCategoryNumSelQuestions($categoryID, $newNumSelQuestions) {
	global $conn;
	$stmt = $conn->prepare("UPDATE category SET numselquestions = ? WHERE id = ? RETURNING numselquestions");
	$stmt->execute(array($newNumSelQuestions, $categoryID));
	return $stmt->fetch();
}

function editQuestionStatement($questionID, $newStatement) {
	global $conn;
	$stmt = $conn->prepare("UPDATE question SET statement = ? WHERE id = ? RETURNING statement");
	$stmt->execute(array($newStatement, $questionID));
	return $stmt->fetch();
}

function editAnswerText($answerID, $newText) {
	global $conn;
	$stmt = $conn->prepare("UPDATE answer SET text = ? WHERE id = ? RETURNING text");
	$stmt->execute(array($newText, $answerID));
	return $stmt->fetch();
}

function editAnswerScore($answerID, $newScore) {
	global $conn;
	$stmt = $conn->prepare("UPDATE answer SET score = ? WHERE id = ? RETURNING score");
	$stmt->execute(array($newScore, $answerID));
	return $stmt->fetch();
}

function createQuestion($examID, $categoryID, $statement) {
	global $conn;
	$stmt = $conn->prepare("SELECT create_question(:examID, :categoryID, :statement)");
	$stmt->execute(array($examID, $categoryID, $statement));
	return $stmt->fetch();
}

function createCategory($examID, $name) {
	global $conn;
	$stmt = $conn->prepare("SELECT create_category(:examID, :name)");
	$stmt->execute(array($examID, $name));
	return $stmt->fetch();
}

function createAnswer($questionID, $text, $score = 0) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO answer
   		(questionid, text, score)
   		VALUES (:questionid, :text, :score) RETURNING id");
	$stmt->execute(array($questionID, $text, $score));
	return $stmt->fetch();
}
function deleteAnswer($answerID) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM answer WHERE id = :answerid");
	return $stmt->execute(array($answerID));
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
	$stmt = $conn->prepare("SELECT id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
   								FROM exam 
								WHERE has_access_exam(?,id) AND current_timestamp > endtime");
	$stmt->execute(array($userID));
	return $stmt->fetchAll();
}

function addManager($exam, $user) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO managesexam
    		(managerid, examid)
            VALUES (?, ?) RETURNING examid");
	if($stmt->execute(array($user, $exam)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
}

function removeManager($exam, $user) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM managesexam
            WHERE managerid = ? AND examid = ?");
	if($stmt->execute(array($user, $exam)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
}


function examIsUserInvited($exam, $user) {
	global $conn;
	$stmt = $conn->prepare("SELECT userid
							FROM userexam
							WHERE examid = ? AND userid = ?");
	if($stmt->execute(array($exam, $user)))
    {
    	return $stmt->fetch()['userid'] == $user;
    }
    else return false;
}

function examIsGroupInvited($exam, $group) {
	global $conn;
	$stmt = $conn->prepare("SELECT groupid
							FROM groupexam
							WHERE examid = ? AND groupid = ?");
	if($stmt->execute(array($exam, $group)))
    {
    	return $stmt->fetch()['groupid'] == $group;
    }
    else return false;
}

function examInviteUser($exam, $user) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO userexam (examid, userid)
            				VALUES (?, ?) RETURNING examid");
	if($stmt->execute(array($exam, $user)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
}

function examInviteGroup($exam, $group) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO groupexam (examid, groupid)
            				VALUES (?, ?) RETURNING examid");
	if($stmt->execute(array($exam, $group)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
}

function examUninviteUser($exam, $user) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM userexam
            WHERE userid = ? AND examid = ?");
	if($stmt->execute(array($user, $exam)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
}

function examUninviteGroup($exam, $group) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM groupexam
            WHERE groupid = ? AND examid = ?");
	if($stmt->execute(array($group, $exam)))
    {
    	return $stmt->fetch(PDO::FETCH_ASSOC)['examid'];
    }
    else return -1;
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
		FROM exam) AS status WHERE id = :examID");
	$stmt->bindParam(':examID', $examID, PDO::PARAM_INT);
	$stmt->execute();
	return $stmt->fetch()['status'];
}

function getBestScore($userID, $examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT finalScore AS score FROM Attempt  
		WHERE get_best_score(?,?) = Attempt.id");
	$stmt->execute(array($userID, $examID));
	return $stmt->fetch()['score'];
}

function getAttempts($userID, $examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT id, starttime, endtime, finalscore 
		FROM attempt
		WHERE userid = ? AND examid = ?");
	$stmt->execute(array($userID, $examID));
	return $stmt->fetchAll();
}

function getExamElements($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT id, orderindex
		FROM examelement
		WHERE examid = ?
		ORDER BY orderindex ASC");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function resortExamElements($order) {
	global $conn;
	$conn->beginTransaction();
	$orderArrayString = pg_escape_string("ARRAY[" . implode(",", $order) . "]");
	$stmt = $conn->prepare("SELECT resort_exam_elements(" . $orderArrayString . ");");
	$result = $stmt->execute();
	echo $orderString;
	if ($result)
		$conn->commit();
	else
		$conn->rollback();
	return $result;
}

function addQuestionToAttempt($attemptid, $questionid, $orderindex) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO questionattempt (attemptid, questionid, questionorder)
		VALUES (?, ?, ?) RETURNING attemptid");
	if($stmt->execute(array($attemptid, $questionid, $orderindex)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC)['attemptid'];
	}
	else return -1;
}

function getPreviousAttempts($userID, $examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT id, starttime, endtime, finalscore 
		FROM attempt
		WHERE userid = ? AND examid = ? AND endtime IS NOT NULL
		ORDER BY finalscore DESC");
	$stmt->execute(array($userID, $examID));
	return $stmt->fetchAll();
}

function getOngoingAttempt($userID, $examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT id
		FROM attempt
		WHERE userid = ? AND examid = ? AND endtime IS NULL");
	$stmt->execute(array($userID, $examID));
	return $stmt->fetchAll();
}

function getExamCategories($examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT category.id, category.name, category.numselquestions, orderindex
   		FROM category INNER JOIN examelement ON (category.id = examelement.id)
   		WHERE examelement.examid = :examid");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function getCategoryQuestions($categoryID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT question.id, category, statement, maxscore
   		FROM question INNER JOIN examelement ON (question.id = examelement.id)
   		WHERE category = :categoryid");
	$stmt->execute(array($categoryID));
	return $stmt->fetchAll();
}
function getIndependentQuestions($examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT question.id, question.statement, question.maxscore, orderindex
   		FROM question INNER JOIN examelement ON (question.id = examelement.id)
   		WHERE examelement.examid = :examid
    	AND question.category IS NULL");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function getQuestionAnswers($questionID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT id, text, score
   		FROM answer
   		WHERE questionid = :questionid ORDER BY id");
	$stmt->execute(array($questionID));
	return $stmt->fetchAll();
}
function deleteCategory($categoryID)
{
	global $conn;
	$stmt = $conn->prepare("DELETE FROM category
		WHERE id = :categoryid");
	return $stmt->execute(array($categoryID));
}
function deleteQuestion($questionID)
{
	global $conn;
	$stmt = $conn->prepare("DELETE FROM question
		WHERE id = :questionid");
	return $stmt->execute(array($questionID));
}
function getExamFromExamElement($examElementID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT exam.id AS id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore
			FROM examelement INNER JOIN exam ON exam.id = examelement.examid
			WHERE examelement.id = ?");
	$stmt->execute(array($examElementID));
	return $stmt->fetch();
}
function getExamFromAnswer($answerID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT exam.id AS id, name, description, ownerid, starttime, endtime, opentopublic, maxtries, maxscore 
			FROM answer
			INNER JOIN examelement ON answer.questionid = examelement.id
			INNER JOIN exam ON exam.id = examelement.examid
			WHERE answer.id = ?");
	$stmt->execute(array($answerID));
	return $stmt->fetch();
}

function createAttempt($userID, $examID) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO attempt (starttime, userid, examid)
		VALUES (CURRENT_TIMESTAMP, ?, ?) RETURNING id");
	if($stmt->execute(array($userID, $examID)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
	}
	else return -1;
}

function getAttempt($attemptID) {
	global $conn;
	$stmt = $conn->prepare("SELECT * 
		FROM Attempt
		WHERE id = ?");
	$stmt->execute(array($attemptID));
	return $stmt->fetchAll()[0];
}

function getAnswer($answerID) {
	global $conn;
	$stmt = $conn->prepare("SELECT * 
		FROM answer
		WHERE id = ?");
	$stmt->execute(array($answerID));
	return $stmt->fetchAll()[0];
}

function editAttemptAnswer($attemptID, $questionID, $answerID) {
	global $conn;
	$stmt = $conn->prepare("UPDATE questionattempt SET answerid = ? WHERE questionid = ? AND attemptid = ? RETURNING answerid");
	$stmt->execute(array($answerID, $questionID, $attemptID));
	return $stmt->fetch();
}

function submitAttempt($attemptID) {
	global $conn;
	$stmt = $conn->prepare("UPDATE attempt SET endtime = CURRENT_TIMESTAMP WHERE id = ? RETURNING id");
	$stmt->execute(array($attemptID));
	return $stmt->fetch();
}

function submitAnonymousAttempt($exam, $starttime, $qa_pairs) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO attempt (starttime, endtime, examid)
		VALUES (?, CURRENT_TIMESTAMP, ?) RETURNING id");
	$id = -1;
	if($stmt->execute(array($starttime, $exam)))
	{
		$id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
	}
	
	if($id < 0)
		return $id;
	
	foreach($qa_pairs as $pair) {
		$stmt = $conn->prepare("INSERT INTO questionattempt (attemptid, questionid, answerid)
			VALUES (?, ?, ?)");
		$stmt->execute(array((int)$id, (int)$pair[0], (int)$pair[1]));
		$stmt->fetchAll();
	}
}

function submitOpenAttempt($exam, $starttime, $qa_pairs, $user) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO attempt (userid, starttime, endtime, examid)
		VALUES (?, ?, CURRENT_TIMESTAMP, ?) RETURNING id");
	$id = -1;
	if($stmt->execute(array($user, $starttime, $exam)))
	{
		$id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
	}
	
	if($id < 0)
		return $id;
	
	foreach($qa_pairs as $pair) {
		$stmt = $conn->prepare("INSERT INTO questionattempt (attemptid, questionid, answerid)
			VALUES (?, ?, ?)");
		$stmt->execute(array((int)$id, (int)$pair[0], (int)$pair[1]));
		$stmt->fetchAll();
	}
}

function getAttemptQuestions($attemptID) {
	global $conn;
	$stmt = $conn->prepare("SELECT question.id AS questionid, questionattempt.answerid AS answerid, questionattempt.questionorder AS order, question.statement AS statement, question.maxscore AS maxscore
								FROM questionattempt INNER JOIN question ON questionattempt.questionid = question.id
								WHERE attemptid = ?
								ORDER BY questionorder ASC");
	$stmt->execute(array($attemptID));
	return $stmt->fetchAll();
}
function getNotAssignedGroups($examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT *
		FROM StudentGroup stu
		WHERE (SELECT COUNT(*) FROM GroupExam
			WHERE GroupExam.groupID = stu.id AND GroupExam.examID = ?) = 0");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function getAssignedGroups($examID)
{
	global $conn;
	$stmt = $conn->prepare("SELECT StudentGroup.id, StudentGroup.name
		FROM StudentGroup, GroupExam
		WHERE GroupExam.groupID = StudentGroup.id AND GroupExam.examID = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function getNotAssignedStudents($examID){
	global $conn;
	$stmt = $conn->prepare("SELECT id, name, email, gender, type
		FROM RegisteredUser
		WHERE NOT(has_access_exam(id, ?))
		ORDER BY name ASC");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function getAssignedStudents($examID){
	global $conn;
	$stmt = $conn->prepare("SELECT id, name, email, gender, type
		FROM RegisteredUser
		WHERE has_access_exam(id, ?)
		ORDER BY name ASC");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}
function addUserToExam($userId, $examId) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO UserExam(userID, examID)
		VALUES (?, ?) RETURNING userID");
	if($stmt->execute(array($userId, $examId)))
	{
		return $stmt->fetch(PDO::FETCH_ASSOC)['userID'];
	}
	else return -1;
}
function removeUserFromExam($userId, $examId) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM UserExam
		WHERE userID = ? AND examID = ?");
	$stmt->execute(array($userId, $examId));
}
function addGroupToExam($groupId, $examId) {
	global $conn;
	$stmt = $conn->prepare("INSERT INTO GroupExam(groupID, examID)
		VALUES (?, ?)");
	$stmt->execute(array($groupId, $examId));
}
function removeGroupFromExam($groupId, $examId) {
	global $conn;
	$stmt = $conn->prepare("DELETE FROM GroupExam
		WHERE groupID = ? AND examID = ?");
	$stmt->execute(array($groupId, $examId));
}
function getExamInvitedGroups($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT studentgroup.id AS id, studentgroup.name AS name
								FROM studentgroup INNER JOIN groupexam ON studentgroup.id = groupexam.groupid
								WHERE groupexam.examid = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function getExamInvitedUsers($examID) {
	global $conn;
	$stmt = $conn->prepare("SELECT registereduser.id AS id, registereduser.name AS name, registereduser.email AS email
								FROM registereduser INNER JOIN userexam ON registereduser.id = userexam.userid
								WHERE userexam.examid = ?");
	$stmt->execute(array($examID));
	return $stmt->fetchAll();
}

function changeShareSetting($examID,$booleanShare)
{
	global $conn;
	$stmt = $conn->prepare("UPDATE exam SET publicgrades = ? WHERE id = ?");
	$stmt->execute(array($booleanShare ,$examID));
	return $stmt->fetchAll();
}
?>