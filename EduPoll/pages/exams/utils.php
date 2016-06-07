<?php

function examElementsCompare($e1, $e2) {
	if ($e1["orderindex"] == $e2["orderindex"]) {
		return 0;
	}
	return ($e1["orderindex"] < $e2["orderindex"]) ? -1 : 1;
}

function sortExamElements(&$examElements) {
	return usort($examElements, "examElementsCompare");
}

function selectAndRemoveQuestion(&$questions) {
	$index = rand(0, sizeof($questions)-1);
	$ret = $questions[$index];
	array_splice($questions, $index, 1);
	return $ret;
}

function generateQuestions($examid, $attemptid) {
	$elements = getExamlElements($examid);
	$current_index = 0;

	foreach($elements as $element) {
		$question = getQuestion($element['id']);
		if($question && $question['category'] == NULL) {
			// PROCESS INDEPENDANT QUESTION
			addQuestionToAttempt($attemptid, $question['id'], $current_index++);
			continue;
		}

		$category = getCategory($element['id']);
		if($category) {
			// PROCESS CATEGORY
			$categoryQuestions = getCategoryQuestions($element['id']);
			$numQuestions = $category['numselquestions'];

			for($i = 0; $i < $numQuestions; ++$i) {
				$q = selectAndRemoveQuestion($categoryQuestions);
				addQuestionToAttempt($attemptid, $q['id'], $current_index++);
			}
			continue;
		}
	}
}

function generateQuestionsAnonymous($examid) {
	$questions = [];
	
	$elements = getExamlElements($examid);

	foreach($elements as $element) {
		$question = getQuestion($element['id']);
		if($question && $question['category'] == NULL) {
			$question['answers'] = [];
			$answers = getQuestionAnswers($question['id']);
			if(isset($answers))
				$question['answers'] = $answers;
			
			array_push($questions, $question);
			continue;
		}

		$category = getCategory($element['id']);
		if($category) {
			$categoryQuestions = getCategoryQuestions($element['id']);
			$numQuestions = $category['numselquestions'];

			for($i = 0; $i < $numQuestions; ++$i) {
				$q = selectAndRemoveQuestion($categoryQuestions);
				
				$q['answers'] = [];
				$answers = getQuestionAnswers($q['id']);
				if(isset($answers))
					$q['answers'] = $answers;
					
				array_push($questions, $q);
			}
			continue;
		}
	}
	
	return $questions;
}

?>
