function updateField(field, name, inputElement, inputSelector) {
	var data = {
			'id' : field.closest('.exam').attr('id').substr("exam".length, 99999)
	}
	data[field.attr('name')] = inputElement.val();
	$.ajax({
		url : "../../pages/api/exams/edit_name.php",
		type: "POST",
		data : data,
		success: function(data, textStatus, jqXHR)
		{
			var obj = JSON.parse(jqXHR.responseText);
			editFieldFinish(field, nl2br(htmlspecialchars(obj[name])), inputElement, inputSelector);
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			console.error("Error: " + jqXHR.responseText);
		}
	});
};