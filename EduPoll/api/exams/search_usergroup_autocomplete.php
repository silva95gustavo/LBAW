<?
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/users.php');
require_once ('../../database/groups.php');

header('Content-Type: application/json');

if (! isAcademic ()) {
	http_response_code(403);
	echo 'You do not have permission to do this.';
	exit ();
}

try {	
	$groups = searchGroupFTS($_GET['term']);
	for ($i = 0; $i < sizeof($groups); $i++) {
		$id = $groups[$i]['id'];
		$name = $groups[$i]['name'];
		unset($groups[$i]);
		$groups[$i]['id'] = $id;
		$groups[$i]['label'] = $name;
		$groups[$i]['type'] = 'group';
	}
	
	$users = searchUserFTS($_GET['term']);
	for ($i = 0; $i < sizeof($users); $i++) {
		$id = $users[$i]['id'];
		$name = $users[$i]['name'];
		unset($users[$i]);
		$users[$i]['id'] = $id;
		$users[$i]['label'] = $name;
		$users[$i]['type'] = 'user';
	}
	
	$result = array_merge($groups, $users);
	
	http_response_code(200);
	echo json_encode($result);
} catch (PDOException $e) {
	http_response_code(400);
	echo 'Error fetching groups by name: ' . $e->getMessage();
}
?>