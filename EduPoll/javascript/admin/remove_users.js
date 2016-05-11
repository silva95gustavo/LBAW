var userId = null;

$(document).ready(
		function() {
			$('#confirmationModal').on('show.bs.modal', function(e) {
				var data = $(e.relatedTarget).data();
				console.log(data);
				$('#yes').data('id', data.id);
			})

			$('#yes').click(
					function(e) {
						userId = $(this).data('id');
						console.log('check', $(this).data('id'), userId,
								$(this).data());
						$.ajax({
							type : 'POST',
							url : "../../actions/users/delete.php",
							data : {
								id : userId
							},
							success : function() {
								$('tr#' + userId).remove();
								$('#confirmationModal').modal('hide');
							},
							error : function() {
								location.reload();
							}
						});
					})
					$("#inputUserToRemove").autocomplete({
						source : BASE_URL + "api/admin/search_user_autocomplete.php",
						minLength : 3,
						select : function(event, ui) {
							console.log(ui.item ? "Selected: " + ui.item.value
									+ " aka " + ui.item.id
									: "Nothing selected, input was "
										+ this.value);
						}
					});
		});