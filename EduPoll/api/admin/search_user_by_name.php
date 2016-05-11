<?
require_once ('../../config/init.php');
include_once ('../../pages/common/utils.php');
include_once ('../../database/users.php');

header('Content-Type: application/json');

if (! isAdmin ()) {
	http_response_code(403);
	echo 'You do not have permission to do this.';
	exit ();
}

try {
	$users = searchUserFTS($_GET['term']);
	http_response_code(200);
	echo json_encode($users);
} catch (PDOException $e) {
	http_response_code(400);
	echo 'Error fetching users by name: ' . $e->getMessage();
}
?>