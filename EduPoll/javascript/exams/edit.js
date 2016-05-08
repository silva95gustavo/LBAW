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