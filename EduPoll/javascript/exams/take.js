var attempt_id;
var exam_id;

$(document).ready(function() {
	$(".checkbox_input").click(checkbox_click);
	$(".submit-attempt").click(submit);
	attempt_id = parseInt($("#attempt_id_elem").text());
	exam_id = parseInt($("#exam_id_elem").text());
});

function checkbox_click(event) {
	var element_id = event.toElement.id;
	var start = element_id.indexOf("_");
	var answer_id = parseInt(element_id.substring(start+1));
	
	$.ajax({
		type: 'POST',
		url: "../../actions/exams/attempt_closed_update_answer.php",
		data: { answer: answer_id , attempt: attempt_id, csrf_token: CSRF_TOKEN },
		success: function (data) {
			console.log(data);
		},
		error: function (data) {
			location.reload();
		}
	});
}

function submit(event) {
	$.ajax({
		type: 'POST',
		url: "../../actions/exams/attempt_closed_submit.php",
		data: { attempt: attempt_id, csrf_token: CSRF_TOKEN },
		success: function (data) {
			window.location.replace(BASE_URL + 'pages/exams/welcome.php?id=' + exam_id);
		},
		error: function (data) {
			location.reload();
		}
	});
}