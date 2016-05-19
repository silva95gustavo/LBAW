$(document).ready(function() {
	$(".inline-editable.exam-name").editable(BASE_URL + 'api/exams/edit_name.php', {
		name : 'name',
		tooltip   : 'Click to edit...',
		submitdata : {
			'id' : $(".inline-editable.exam-name").data("id"),
			'csrf_token' : CSRF_TOKEN
		}
	});
	$(".inline-editable.exam-description").editable(BASE_URL + 'api/exams/edit_description.php', {
		type : 'textarea',
		name : 'description',
		tooltip   : 'Click to edit...',
		submit : 'OK',
		cancel : 'Cancel',
		submitdata : {
			'id' : $(".inline-editable.exam-description").data("id"),
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

	$('#confirmationModal').on('show.bs.modal', function (e) {
		var data = $(e.relatedTarget).data();
		console.log(data);
		$('#yes').data('id', data.id);
	})

	$('#yes').click(function (e) {
		userId = $(this).data('id');
		console.log('check', $(this).data('id'), userId, $(this).data());
		$.ajax({
			type: 'POST',
			url: "../../actions/exams/delete.php",
			data: { id: userId },
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
});