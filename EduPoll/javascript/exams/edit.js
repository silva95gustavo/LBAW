var exam_id;
var removable_manager_id;

$(document).ready(function() {
	exam_id = $(".exam-id").attr("examid");
	$("#inputUserToAdd").autocomplete({
		source : BASE_URL + "api/exams/search_user_autocomplete.php",
		minLength : 3,
		select : function(event, ui) {
			if (ui.item) {
				this.value = ui.item.label;
				$('#inputUserToAdd').data('id', ui.item.id);
				$('#yes_manager').data('id', ui.item.id);
				$('#confirmationModalAddManager').modal('show');
			}
		}
	});
	
	$(".inline-editable.exam-name").editable(BASE_URL + 'api/exams/edit_name.php', {
		name : 'name',
		tooltip   : 'Click to edit...',
		onblur : 'submit',
		submitdata : { 'id' : $(".inline-editable.exam-name").data("id"),
						'csrf_token' : CSRF_TOKEN
			}
	});
	$(".inline-editable.exam-description").editable(BASE_URL + 'api/exams/edit_description.php', {
		type : 'textarea',
		name : 'description',
		tooltip   : 'Click to edit...',
		onblur : 'submit',
		submit : 'OK',
		cancel : 'Cancel',
		submitdata : { 'id' : $(".inline-editable.exam-description").data("id"),
						'csrf_token' : CSRF_TOKEN
			},
		callback: function(value,settings) {
			var retval = nl2br(value);
			$(this).html(retval);
		},
		data: function(value,settings) {
			value = value.replace(/\r/gi, "");
			value = value.replace(/\n/gi, "");
			var retval = value.replace(/<br>/gi, "\n");
			return retval;
		}
	});
	
	$(".inline-editable.question-statement").each(function() {
		$(this).editable(BASE_URL + 'api/exams/edit_question_statement.php', {
			name : 'statement',
			tooltip   : 'Click to edit...',
			onblur : 'submit',
			submitdata : { 'id' : $(this).data("id"),
						   'csrf_token' : CSRF_TOKEN
			}
		});
	});
	
	$(".inline-editable.answer-text").each(function() {
		$(this).editable(BASE_URL + 'api/exams/edit_answer_text.php', {
			name : 'text',
			tooltip   : 'Click to edit...',
			onblur : 'submit',
			submitdata : { 'id' : $(this).data("id"),
						   'csrf_token' : CSRF_TOKEN
			}
		});
	});

	$('#confirmationModal').on('show.bs.modal', function (e) {
		var data = $(e.relatedTarget).data();
		$('#yes').data('id', data.id);
	})

	$('#yes').click(function (e) {
		userId = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/delete.php",
			data: { id: userId , csrf_token: CSRF_TOKEN },
			success: function () {
				$('tr#' + userId).remove();
				$('#confirmationModal').modal('hide');
				window.location.replace(BASE_URL + 'pages/exams/my_exams.php');
			},
			error: function () {
				location.reload();
			}
		});
	})

	$('.removable_manager').click(function (e) {
		removable_manager_id = $(this).attr('managerid');
		$('#confirmationModalRemoveManager').modal('show');
	})

	$('#yes_rem_manager').click(function (e) {
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/remove_manager.php",
			data: { user: removable_manager_id , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalRemoveManager').modal('hide');
				window.location.replace(BASE_URL + 'pages/exams/edit.php?id=' + exam_id);
			},
			error: function () {
				location.reload();
			}
		});
	})

	$('#yes_manager').click(function (e) {
		userId = $(this).data('id');
		console.log('check', exam_id, userId, $(this).data());
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/add_manager.php",
			data: { user: userId , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalAddManager').modal('hide');
				window.location.replace(BASE_URL + 'pages/exams/edit.php?id=' + exam_id);
			},
			error: function () {
				location.reload();
			}
		});
	})
	
	$('#confirmationModalDeleteCategory').on('show.bs.modal', function (e) {
		var data = $(e.relatedTarget).data();
		$('#yes_delete_category').data('categoryid', data.categoryid);
	})
	
	$('#yes_delete_category').click(function (e) {
		categoryId = $(this).data('categoryid');
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/delete_category.php",
			data: { category: categoryId, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalDeleteCategory').modal('hide');
				window.location.replace(BASE_URL + 'pages/exams/edit.php?id=' + exam_id);
			},
			error: function () {
				location.reload();
			}
		});
	})
	
	$('#confirmationModalDeleteQuestion').on('show.bs.modal', function (e) {
		var data = $(e.relatedTarget).data();
		$('#yes_delete_question').data('questionid', data.questionid);
	})
	
	$('#yes_delete_question').click(function (e) {
		questionId = $(this).data('questionid');
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/delete_question.php",
			data: { question: questionId, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalDeleteQuestion').modal('hide');
				window.location.replace(BASE_URL + 'pages/exams/edit.php?id=' + exam_id);
			},
			error: function () {
				location.reload();
			}
		});
	})
	
	$('form.add-answer').submit(function (e) {
		var addAnswerForm = $(this);
	    var $inputs = $(this).find(":input");
	    var values = {};
	    $inputs.each(function() {
	        values[this.name] = $(this).val();
	    });
	    if (values["text"].length <= 0) return false;
		$.ajax({
			type: 'POST',
			url: "../../api/exams/create_answer.php",
			data: {
				id: values["questionid"],
				text: values["text"],
				csrf_token: CSRF_TOKEN
			},
			success: function (data) {
				var html =
				"<div class=\"radio disabled answer\">" +
					"<label class=\"answer\">" +
						"<input type=\"radio\" name=\"optradio1\" checked=\"checked\">" +
						"<div class=\"inline-editable answer-text\" name=\"text\" data-id=\"" + data + "\">" + values["text"] + "</div>" +
					"</label>" +
				"</div>";
				addAnswerForm.before(html);
			},
			error: function (data) {
				console.error("Error creating answer: " + data);
			}
		});
		return false;
	});
});