var exam_id;
var removable_manager_id;
var uninvite_group_id;
var uninvite_user_id;

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
	
	$("#inputUserGroupToInvite").autocomplete({
		source : BASE_URL + "api/exams/search_usergroup_autocomplete.php",
		minLength : 2,
		select : function(event, ui) {
			if (ui.item) {
				this.value = ui.item.label;
				if(ui.item.type === "group") {
					$('#inputUserGroupToInvite').data('id', ui.item.id);
					$('#yes_invite_group').data('id', ui.item.id);
					$('#confirmationModalInviteGroup').modal('show');
				} else if (ui.item.type === "user") {
					$('#inputUserGroupToInvite').data('id', ui.item.id);
					$('#yes_invite_user').data('id', ui.item.id);
					$('#confirmationModalInviteUser').modal('show');
				}
			}
		}
	});
	
	$(".inline-editable.exam-name").editable(BASE_URL + 'api/exams/edit_name.php', {
		name : 'name',
		tooltip   : 'Click to edit...',
		onblur : 'submit',
		submitdata : { 'id' : $(".inline-editable.exam-name").data("id"),
						'csrf_token' : CSRF_TOKEN
		},
		callback: function(value,settings) {
			$(this).text(value);
		},
		data: function(value,settings) {
			return $('<div/>').html(value).text();
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
			},
			callback: function(value,settings) {
				$(this).text(value);
			},
			data: function(value,settings) {
				return $('<div/>').html(value).text();
			}
		});
	});
	
	$(".inline-editable.answer-text").each(function() {
		makeAnswerTextEditable($(this));
	});
	
	$(".inline-editable.category-name").each(function() {
		$(this).editable(BASE_URL + 'api/exams/edit_category_name.php', {
			name : 'name',
			tooltip   : 'Click to edit...',
			onblur : 'submit',
			submitdata : { 'id' : $(this).data("id"),
						   'csrf_token' : CSRF_TOKEN
			},
			callback: function(value,settings) {
				$(this).text(value);
			},
			data: function(value,settings) {
				return $('<div/>').html(value).text();
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

	$('.removable_group').click(function (e) {
		uninvite_group_id = parseInt($(this).attr('groupid'));
		console.log("Uninviting group " + uninvite_group_id);
		$('#confirmationModalUninviteGroup').modal('show');
	})

	$('.removable_user').click(function (e) {
		uninvite_user_id = parseInt($(this).attr('userid'));
		console.log("Uninviting user " + uninvite_user_id);
		$('#confirmationModalUninviteUser').modal('show');
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

	$('#yes_uninvite_user').click(function (e) {
		console.log('check', exam_id, uninvite_user_id);
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/uninvite_user.php",
			data: { user: uninvite_user_id , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalUninviteUser').modal('hide');
				location.reload();
			},
			error: function () {
				location.reload();
			}
		});
	})

	$('#yes_uninvite_group').click(function (e) {
		console.log('check', exam_id, uninvite_group_id);
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/uninvite_group.php",
			data: { group: uninvite_group_id , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalUninviteGroup').modal('hide');
				location.reload();
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

	$('#yes_invite_user').click(function (e) {
		var userID = $(this).data('id');
		console.log('check', exam_id, userID);
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/invite_user.php",
			data: { user: userID , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalAddManager').modal('hide');
				location.reload();
			},
			error: function () {
				location.reload();
			}
		});
	})

	$('#yes_invite_group').click(function (e) {
		var groupID = $(this).data('id');
		console.log('check', exam_id, groupID);
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/invite_group.php",
			data: { group: groupID , exam: exam_id, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalAddManager').modal('hide');
				location.reload();
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
			},
			error: function (xhr) {
				console.error("Error deleting question: " + xhr.responseText);
			}
		});
	})
	
	$('#modalCreateQuestion').on('show.bs.modal', function (e) {
		var categoryID = $(e.relatedTarget).data("categoryid");
		console.log(categoryID);
		$(this).find('form input[name="categoryid"]').remove();
		if (categoryID)
			$(this).find('form').append('<input type="hidden" name="categoryid" value="' + categoryID + '" />');
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
				var el =
				$(	"<div class=\"radio answer\">" +
						"<span class=\"icon-clickable delete-answer\" data-answerid=\"" + data + "\">" +
						"<i class=\"fa fa-trash-o\"></i>" +
						"</span>" +
						"<div class=\"inline-editable no-full-width answer-score neutral\" type=\"number\" name=\"score\" data-id=\"" + data + "\">0</div> " +
						"<label class=\"answer\">" +
							"<input type=\"radio\" name=\"optradio1\" disabled>" +
							"<div class=\"inline-editable answer-text\" name=\"text\" data-id=\"" + data + "\" disabled>" + $("<div>").text(values["text"]).html() + "</div>" +
						"</label>" +
					"</div>");
				addAnswerForm.before(el);
				addAnswerForm.find(":input[name='text']").val("");
				makeAnswerTextEditable(el.find(".inline-editable.answer-text"));
				var elScore = el.find(".inline-editable.answer-score");
				makeAnswerScoreEditable(elScore);
				console.log(elScore);
				elScore.change(function() {
					answerScoreOnChange(elScore);
				});
				el.find(".delete-answer").click(function() {
					answerDeleteOnClick($(this));
				});
				elScore.trigger("change");
			},
			error: function (xhr, status, error) {
				console.error("Error creating answer: " + xhr.responseText);
			}
		});
		return false;
	});
	
	$(".inline-editable.answer-score").each(function() {
		makeAnswerScoreEditable($(this));
	});
	
	$('.answer-score').change(function (e) {
		answerScoreOnChange($(this));
	});
	
	$('.delete-answer').click(function (e) {
		return answerDeleteOnClick($(this));
	})
	
	$('.num-sel-questions').change(function(e) {
		var max = $(this).parents(".category").find(".question").length;
		var categoryId = $(this).data("categoryid");
		var n = $(this).val();
		if (n > max) {
			n = max;
			$(this).val(n);
			return false;
		} else if (n < 0) {
			n = 0;
			$(this).val(n);
			return false;
		}
		$.ajax({
			type: 'POST',
			url: "../../api/exams/edit_category_num_sel_questions.php",
			data: { category: categoryId, numselquestions: n, csrf_token: CSRF_TOKEN },
			success: function (data) {
				$('#confirmationModalDeleteQuestion').modal('hide');
				window.location.reload();
			},
			error: function (xhr) {
				console.error("Error deleting question: " + xhr.responseText);
			}
		});
		return true;
	})
});

function answerDeleteOnClick(jThis) {
	var answerID = jThis.data("answerid");
	$.ajax({
		type: 'POST',
		url: "../../api/exams/delete_answer.php",
		data: { answer: answerID, csrf_token: CSRF_TOKEN },
		success: function (data) {
			jThis.parent().remove();
		},
		error: function (xhr) {
			console.error("Error deleting answer: " + xhr.responseText);
		}
	});
}

function makeAnswerTextEditable(jThis) {
	jThis.editable(BASE_URL + 'api/exams/edit_answer_text.php', {
		name : 'text',
		tooltip   : 'Click to edit...',
		onblur : 'submit',
		submitdata : { 'id' : jThis.data("id"),
					   'csrf_token' : CSRF_TOKEN
		},
		callback: function(value,settings) {
			jThis.text(value);
		},
		data: function(value,settings) {
			return $('<div/>').html(value).text();
		}
	});
}

function makeAnswerScoreEditable(jThis) {
	jThis.editable(BASE_URL + 'api/exams/edit_answer_score.php', {
		name : 'score',
		tooltip   : 'Click to edit...',
		onblur : 'submit',
		submitdata : { 'id' : jThis.data("id"),
					   'csrf_token' : CSRF_TOKEN
		},
		callback: function(value,settings) {
			jThis.text(value);
			jThis.trigger("change");
		},
		data: function(value,settings) {
			return $('<div/>').html(value).text();
		}
	});
}

function answerScoreOnChange(jThis) {
	var val = parseFloat(jThis.text());
	jThis.removeClass("positive neutral negative");
	if (val > 0)
		jThis.addClass("positive");
	else if (val < 0)
		jThis.addClass("negative");
	else
		jThis.addClass("neutral");
}