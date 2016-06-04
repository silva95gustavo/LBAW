var ADD_STUDENT_URL = '../../api/exams/add_user_exam.php';
var REMOVE_STUDENT_URL = '../../api/exams/remove_user_exam.php';
var ADD_GROUP_URL = '../../api/exams/add_group_exam.php';
var REMOVE_GROUP_URL = '../../api/exams/remove_group_exam.php';

var targetId = null;
var url = REMOVE_GROUP_URL;
var examId = null;
$(document).ready(
	function() {
		examId = $('#yes').data("id");
		$('.tab').on("click", function(e){
			var data = $(this).data("id");
			if (data == "groups-assigned-tab")
				url = REMOVE_GROUP_URL;
			else if (data == "users-assigned-tab")
				url = REMOVE_STUDENT_URL;
			else if (data == "assign-group-tab")
				url = ADD_GROUP_URL;
			else if (data == "assign-user-tab")
				url = ADD_STUDENT_URL;
		});
		$(document).on('click', 'button.idSubmition', function(e) {
			targetId = $(this).data("id");
		});

		$('#yes').click(function(e) {
			$.ajax({
				type : 'POST',
				url : url,
				data : {
					id : targetId,
					examId : examId,
					csrf_token : CSRF_TOKEN
				},
				success : function() {
					executeSuccessChanges();
				},
				error : function(xhr, status, error) {
					location.reload();
				}
			});
		})
		$("#inputUserToAdd").autocomplete({
			source : BASE_URL + "api/admin/search_user_autocomplete.php",
			minLength : 3,
			select : function(event, ui) {
				if (ui.item) {
					targetId = ui.item.id;
					$('#confirmationModal').modal('show');
				}
			}
		});
		$("#inputUserToRemove").autocomplete({
			source : BASE_URL + "api/admin/search_user_autocomplete.php",
			minLength : 3,
			select : function(event, ui) {
				if (ui.item) {
					targetId = ui.item.id;
					$('#confirmationModal').modal('show');
				}
			}
		});
	});


function executeSuccessChanges() 
{
	var id = null;
	var color = null
	if (url == ADD_STUDENT_URL) {
		id = 'tr#addstudent' + targetId;
		color = '#C1FFC1';
		var name = $(id + ' td:nth-child(2)').html();
		var email = $(id + ' td:nth-child(3)').html();
		var button = '<button type="button" class="btn btn-danger idSubmition" data-id="' + targetId + '" data-toggle="modal" data-target="#confirmationModal">Remove'
		var tr = '<tr id="removestudent' + targetId + '"><td>' 
		+ targetId + '</td><td>' + name +'</td><td>'
		+ email + '</td><td>' + button +'</td></tr>';
		$(tr).insertBefore('table#users-assigned-table > tbody > tr:first');
	}
	else if (url == REMOVE_STUDENT_URL) {
		id = 'tr#removestudent' + targetId;
		color = '#FF6666';
		var name = $(id + ' td:nth-child(2)').html();
		var email = $(id + ' td:nth-child(3)').html();
		var button = '<button type="button" class="btn btn-success idSubmition" data-id="' + targetId + '" data-toggle="modal" data-target="#confirmationModal">Add'
		var tr = '<tr id="addstudent' + targetId + '"><td>' 
		+ targetId + '</td><td>' + name +'</td><td>'
		+ email + '</td><td>' + button +'</td></tr>';
		$(tr).insertBefore('table#assign-user-table > tbody > tr:first');
	}
	else if (url == ADD_GROUP_URL) {
		id = 'tr#addgroup' + targetId;
		color = '#C1FFC1';
		var name = $(id + ' td:nth-child(2)').html();
		var button = '<button type="button" class="btn btn-danger idSubmition" data-id="' + targetId + '" data-toggle="modal" data-target="#confirmationModal">Remove'
		var tr = '<tr id="removegroup' + targetId + '"><td>'
		+ targetId + '</td><td>' + name +'</td><td>' 
		+ button +'</td></tr>';
		$(tr).prependTo('table#groups-assigned-table > tbody');
		updateAssignedUsers();
		updateNotAssignedUsers();
	}
	else if (url == REMOVE_GROUP_URL) {
		id = 'tr#removegroup' + targetId;
		color = '#FF6666';
		var name = $(id + ' td:nth-child(2)').html();
		var button = '<button type="button" class="btn btn-success idSubmition" data-id="' + targetId + '" data-toggle="modal" data-target="#confirmationModal">Add'
		var tr = '<tr id="addgroup' + targetId + '"><td>'
		+ targetId + '</td><td>' + name +'</td><td>' 
		+ button +'</td></tr>';
		$(tr).prependTo('table#assign-group-table > tbody');
		updateAssignedUsers();
		updateNotAssignedUsers();
	}

	$('#confirmationModal').modal('hide');
	$(id).css('background-color', color);
	$(id).hide(1000, function(){
		$(id).remove();
	});
}

function updateAssignedUsers() {
	$.ajax({
		type : 'POST',
		url : '../../api/exams/get_assigned_users.php',
		data : {
			examId : examId,
			csrf_token : CSRF_TOKEN
		},
		success : function(data) {
			updateAssignedUsersTable(JSON.parse(data));
		},
		error : function(xhr, status, error) {
			location.reload();
		}
	});
}

function updateNotAssignedUsers(){
	$.ajax({
		type : 'POST',
		url : '../../api/exams/get_not_assigned_users.php',
		data : {
			examId : examId,
			csrf_token : CSRF_TOKEN
		},
		success : function(data) {
			updateNotAssignedUsersTable(JSON.parse(data));
		},
		error : function(xhr, status, error) {
			location.reload();
		}
	});
}

function updateAssignedUsersTable(data) {
	$('table#users-assigned-table > tbody > tr').remove();
	for(var i =  0; i < data.length; i++){
		var id = 'tr#removestudent' + data[i].id;
		var name = data[i].name;
		var email =data[i].email;
		var button = '<button type="button" class="btn btn-danger idSubmition" data-id="' + data[i].id + '" data-toggle="modal" data-target="#confirmationModal">Remove'
		var tr = '<tr id="removestudent' + data[i].id + '"><td>' 
		+ data[i].id + '</td><td>' + name +'</td><td>'
		+ email + '</td><td>' + button +'</td></tr>';
		$(tr).appendTo('table#users-assigned-table > tbody');
	}	
		
}

function updateNotAssignedUsersTable(data) {
	$('table#assign-user-table > tbody > tr').remove();
	for(var i =  0; i < data.length; i++){
		var id = 'tr#addstudent' + data[i].id;
		var name = data[i].name;
		var email =data[i].email;
		var button = '<button type="button" class="btn btn-success idSubmition" data-id="' + data[i].id + '" data-toggle="modal" data-target="#confirmationModal">Add'
		var tr = '<tr id="addstudent' + data[i].id + '"><td>' 
		+ data[i].id + '</td><td>' + name +'</td><td>'
		+ email + '</td><td>' + button +'</td></tr>';
		$(tr).appendTo('table#assign-user-table > tbody');
	}	
		
}