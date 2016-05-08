$(document).ready(function() {
	$(".inline-editable-button.exam-name").click(function() {
		editTextField(
				$(this).parent().find(".inline-editable-text"),
				"name",
				function(inputElement) {
					return inputElement.val().length > 0;
				},
				examNameEditCallback
				);
		return false;
	});
	$(".inline-editable-button.exam-description").click(function() {
		editTextareaField(
				$(this).parent().find(".inline-editable-text"),
				"name",
				function(inputElement) {
					return inputElement.val().length > 0;
				},
				examDescriptionEditCallback
				);
		return false;
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

function examNameEditCallback(field, name, inputElement, inputSelector) {
	var data = {
			'id' : field.closest('.exam').attr('id').substr("exam".length, 99999)
	}
	data[inputElement.attr('name')] = inputElement.val();
	$.ajax({
		url : BASE_URL + "api/exams/edit_name.php",
		type: "POST",
		data : data,
		success: function(data, textStatus, jqXHR)
		{
			console.log(jqXHR.responseText);
			var obj = JSON.parse(jqXHR.responseText);
			editFieldFinish(field, nl2br(htmlspecialchars(obj[name])), inputElement, inputSelector);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.error("Error: " + jqXHR.responseText);
		}
	});
};

function examDescriptionEditCallback(field, name, inputElement, inputSelector) {
	var data = {
			'id' : field.closest('.exam').attr('id').substr("exam".length, 99999)
	}
	data[inputElement.attr('name')] = inputElement.val();
	$.ajax({
		url : BASE_URL + "api/exams/edit_description.php",
		type: "POST",
		data : data,
		success: function(data, textStatus, jqXHR)
		{
			console.log(jqXHR.responseText);
			var obj = JSON.parse(jqXHR.responseText);
			editFieldFinish(field, nl2br(htmlspecialchars(obj[name])), inputElement, inputSelector);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.error("Error: " + jqXHR.responseText);
		}
	});
};