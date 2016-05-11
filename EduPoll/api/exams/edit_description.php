<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

header('Content-Type: application/json');
$reply = editExamDescription($_POST['id'], $_POST['description']);
echo json_encode($reply);

?>