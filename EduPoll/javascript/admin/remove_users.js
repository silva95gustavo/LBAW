var userId = null;
$(document).ready(
		function() {
			$('#confirmationModal').on('show.bs.modal', function(e) {
				var data = $(e.relatedTarget).data() || $('#inputUserToRemove').data();
				$('#yes').data('id', data.id);
			});

			$('#yes').click(function(e) {
				userId = $(this).data('id');
				$.ajax({
					type : 'POST',
					url : "../../actions/users/delete.php",
					data : {
						id : userId,
						csrf_token : CSRF_TOKEN
					},
					success : function() {
						$('#confirmationModal').modal('hide');
						$('tr#' + userId).css('background-color','#FF9C9C');
						$('tr#' + userId).hide(1000, function(){
							$('tr#' + userId).remove();
						});
					},
					error : function(xhr, status, error) {
						console.log("Could not remove user: " + xhr.responseText);
						location.reload();
					}
				});
			})
			$("#inputUserToRemove").autocomplete({
				source : BASE_URL + "api/admin/search_user_autocomplete.php",
				minLength : 3,
				autoFocus: true,
				select : function(event, ui) {
					if (ui.item) {
						this.value = ui.item.label;
						$('#inputUserToRemove').data('id', ui.item.id);
						$('#confirmationModal').modal('show');
					}
				}
			});
		});