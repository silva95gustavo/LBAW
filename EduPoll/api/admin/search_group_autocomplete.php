<?
require_once ('../../config/init.php');
require_once ('../../pages/common/utils.php');
require_once ('../../database/groups.php');

header('Content-Type: application/json');

if (! isAdmin ()) {
	http_response_code(403);
	echo 'You do not have permission to do this.';
	exit ();
}

try {
	$groupID = 0;
	if(isset($_GET['groupID']))
		$groupID = $_GET['groupID'];
	$groups = searchGroupFTS($_GET['term'],$groupID);
	for ($i = 0; $i < sizeof($groups); $i++) {
		$id = $groups[$i]['id'];
		$name = $groups[$i]['name'];
		$groupID = $groups[$i]['name'];
		unset($groups[$i]);
		$groups[$i]['id'] = $id;
		$groups[$i]['label'] = $name;
	}
	http_response_code(200);
	echo json_encode($groups);
} catch (PDOException $e) {
		$_SESSION ['error_messages'] [] = "Group does not exist.";
	http_response_code(400);
	echo 'Error fetching groups by name: ' . $e->getMessage();
}
?>