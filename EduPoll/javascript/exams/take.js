var attempt_id;

$(document).ready(function() {
	$(".checkbox_input").click(checkbox_click);
	attempt_id = parseInt($("#attempt_id_elem").text());
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
			console.log(data);
			//location.reload();
		}
	});
}