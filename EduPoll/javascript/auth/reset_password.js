$(document).ready(function(){
	$("#resetEmailSubmit").click(function(event) {
		var user_email = $("#resetEmailValue").val();
		// redirecionar
		$.ajax({
			type: 'POST',
			url: "../../actions/auth/reset_password.php",
			data: { email: user_email },
			success: function (data) {
				location.reload();
			},
			error: function () {
				location.reload();
			}
		});
	})
});