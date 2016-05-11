formData = null;


$('#form-change-password').submit(function() {
	var oldPassword = $('#inputOldPassword').val();
	var newPassword = $('#inputNewPassword').val();
	var newPasswordVerify = $('#inputConfirmPassword').val();

	formData = {type: 'password', oldPassword: oldPassword, newPassword: newPassword, newPasswordVerify: newPasswordVerify};
	console.log(formData);
	sendEditProfileData();
});

$('#form-change-email').submit(function(){
	var newEmail = $('#inputNewEmail').val();

	formData = {type: 'email', newEmail: newEmail};
});

function sendEditProfileData() {
	$.ajax({
		type: 'POST',
		url: "../../actions/users/edit.php",
		data: formData,
		success: function (data) {
			formData = null;
        },
        error: function (data) {
        }
	});
};