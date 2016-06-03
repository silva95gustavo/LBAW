

$(document).ready( function() {


	$("#inputGroupToManage").autocomplete({
				source : BASE_URL + "api/admin/search_group_autocomplete.php",
				minLength : 3,
				autoFocus: true,
				select : function(event, ui) {
					if (ui.item) {
						this.value = ui.item.label;
						$('#inputGroupToManage').data('id', ui.item.id);
						window.location.href = BASE_URL + "pages/admin/groups.php?page=" + ui.item.id	;
					}
				}			
			});
	});