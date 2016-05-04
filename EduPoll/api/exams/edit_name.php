<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/exams.php');

$data['name'] = $_POST['name'];
header('Content-Type: application/json');
echo json_encode($data);

?>