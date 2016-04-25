<?php 

function createExam($ownerID, $name, $description, $open) {
	global $conn;
    $stmt = $conn->prepare("INSERT INTO exam
    		(name, description, ownerID, openToPublic)
            VALUES (?, ?, ?, ?)");
    $stmt->execute(array($name, $description, $ownerID, $open));
}

?>