<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

$data['name'] = $_POST['name'];
header('Content-Type: application/json');
$reply = editExamName($_POST['id'], $_POST['name']);
echo json_encode($reply);

?>