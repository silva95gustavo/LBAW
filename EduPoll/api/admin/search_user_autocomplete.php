<?
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/users.php');

header('Content-Type: application/json');

if (! isAdmin ()) {
	http_response_code(403);
	echo 'You do not have permission to do this.';
	exit ();
}
if(!isset($_GET['groupID'])){
	try {
		$users = searchUserFTS($_GET['term']);
		for ($i = 0; $i < sizeof($users); $i++) {
			$id = $users[$i]['id'];
			$name = $users[$i]['name'];
			unset($users[$i]);
			$users[$i]['id'] = $id;
			$users[$i]['label'] = $name;
		}
		http_response_code(200);
		echo json_encode($users);
	} catch (PDOException $e) {
		http_response_code(400);
		echo 'Error fetching users by name: ' . $e->getMessage();
	}
}
else{
	try {
		$users = searchUserFTSByGroup($_GET['term'],$_GET['groupID'],$_GET['bool']);
		for ($i = 0; $i < sizeof($users); $i++) {
			$id = $users[$i]['id'];
			$name = $users[$i]['name'];
			unset($users[$i]);
			$users[$i]['id'] = $id;
			$users[$i]['label'] = $name;
			$users[$i]['groupid'] = $_GET['groupID'];
		}
		http_response_code(200);
		echo json_encode($users);
	} catch (PDOException $e) {

		$_SESSION ['error_messages'] [] = $e->getMessage();
		http_response_code(400);
		echo 'Error fetching users by name: ' . $e->getMessage();
	}

}
?>