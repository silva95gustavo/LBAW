$('input#inputOldPassword').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#inputNewPassword').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#inputConfirmPassword').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#inputNewEmail').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#inputConfirmNewEmail').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

/*
$(document).ready(function(){
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
});
*/