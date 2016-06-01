<?php

function examElementsCompare($e1, $e2) {
	if ($e1["orderindex"] == $e2["orderindex"]) {
		return 0;
	}
	return ($e1["orderindex"] < $e2["orderindex"]) ? -1 : 1;
}

function sortExamElements($examElements) {
	usort($examElements, "examElementsCompare");
	return $examElements;
}

?>