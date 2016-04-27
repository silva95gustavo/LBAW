<?php 

function createExam($ownerID, $name, $description, $open, $maxTries) {
	global $conn;
    $stmt = $conn->prepare("INSERT INTO exam
    		(name, description, ownerID, openToPublic, maxTries)
            VALUES (?, ?, ?, ?, ?)");
    return $stmt->execute(array($name, $description, $ownerID, $open, $maxTries));
}

?>