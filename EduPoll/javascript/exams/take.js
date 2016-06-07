var attempt_id;
var exam_id;
var exam_open;
var taken_answers = [];
var date_str;

$(document).ready(function() {
	date_str = new Date();
	date_str = date_str.getUTCFullYear() + '-' +
    	('00' + (date_str.getMonth()+1)).slice(-2) + '-' +
    	('00' + date_str.getDate()).slice(-2) + ' ' + 
    	('00' + date_str.getHours()).slice(-2) + ':' + 
    	('00' + date_str.getMinutes()).slice(-2) + ':' + 
    	('00' + date_str.getSeconds()).slice(-2);

	exam_open = ($("#exam_open_elem").text() === "0");
	attempt_id = parseInt($("#attempt_id_elem").text());
	exam_id = parseInt($("#exam_id_elem").text());
	
	if(exam_open) {
		$(".checkbox_input").click(checkbox_click_open);
		$(".submit-attempt").click(submit);
		$('#yes_submit').click(actualSubmit_open);
	} else {
		$(".checkbox_input").click(checkbox_click);
		$(".submit-attempt").click(submit);
		$('#yes_submit').click(actualSubmit);
	}
});

function checkbox_click_open(event) {
	var element_id = event.toElement.id;
	var split = element_id.indexOf("_");
	var question = parseInt(element_id.substring(0, split));
	var answer = parseInt(element_id.substring(split + 1));
	
	var found = false;
	for(var i = 0; i < taken_answers.length; ++i) {
		if(taken_answers[i][0] == question) {
			taken_answers[i][1] = answer;
			found = true;
			break;
		}
	}
	if(!found) {
		taken_answers.push([question, answer]);
	}
}

function actualSubmit_open() {
	$.ajax({
		type: 'POST',
		url: "../../actions/exams/attempt_open_submit.php",
		data: { exam: exam_id, answers: taken_answers, date: date_str },
		success: function (data) {
			window.location.replace(BASE_URL);
		},
		error: function (data) {
			location.reload();
		}
	});
}

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
	$('#confirmationModalSubmit').modal('show');
}

function actualSubmit() {
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