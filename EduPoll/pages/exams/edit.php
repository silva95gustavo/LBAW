<?
require_once ('../../config/init.php');
require_once ('../common/utils.php');
require_once ('../../database/exams.php');
include_once ('../common/sidebar.php');
require_once ('../../pages/exams/utils.php');

if (! isLoggedIn ()) {
	header ( 'Location: ' . $BASE_URL . 'pages/auth/login.php' );
	die ();
} else if (isAdmin()) {
  	header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  	die();
}

$examID = $_GET['id'];

if(!isset($_GET['id'])) {
	if (isLoggedIn ()) {
		if(isAcademic()) {
			header ( 'Location: ' . $BASE_URL . 'pages/users/main.php' );
			die ();
		} else {
  			header('Location: ' . $BASE_URL . 'pages/admin/main.php');
  			die();
		}
	} else {
		header('Location: ' . $BASE_URL . 'pages/auth/login.php');
  		die();
	}
}

$exam = getExam($examID);
if ($exam)
{
	$exam['id'] = $examID;
	$smarty->assign ( 'exam', $exam);
	$isOwner = $exam['ownerid'] === $userInfo['id'];
	$smarty->assign ( 'isOwner', $isOwner);
	if($isOwner) {
		$smarty->assign('managers', getExamManagers($examID));
	} else {
		$smarty->assign('managers', getOtherExamManagers($examID, $userInfo['id']));
		$smarty->assign('owner', getExamOwner($examID)[0]);
	}
	
	$categories = getExamCategories($examID);
	for ($i = 0; $i < sizeof($categories[$i]); $i++) {
		$questions = getCategoryQuestions($categories[$i]["id"]);
		$categories[$i]["type"] = "category";
		$categories[$i]["questions"] = $questions;
		for ($j = 0; $j < sizeof($questions); $j++) {
			$answers = getQuestionAnswers($questions[$j]["id"]);
			$categories[$i]["questions"][$j]["answers"] = $answers;
		}
	}
	$independentQuestions = getIndependentQuestions($examID);
	for ($i = 0; $i < sizeof($independentQuestions); $i++) {
		$independentQuestions[$i]["type"] = "question";
	}
	
	$examElements = array_merge($categories, $independentQuestions);
	sortExamElements($examElements);
	
	$smarty->assign('examElements', $examElements);
}

prepareDate($smarty);

$smarty->assign ( 'name', $userInfo['name'] );
$smarty->display ( 'exams/edit.tpl' );
?>