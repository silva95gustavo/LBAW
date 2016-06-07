

$(document).ready( function() {

	$("#inputGroupToManage").autocomplete({
		'search':function(event,ui){
			var newUrl= BASE_URL + "api/admin/search_group_autocomplete.php?groupID=" + $("#groupID").val();
			$(this).autocomplete("option","source",newUrl)
		},		
		minLength : 3,
		autoFocus: true,
		select : function(event, ui) {
			if (ui.item) {
				this.value = ui.item.label;
				$('#inputGroupToManage').data('id', ui.item.id);
				window.location.href = BASE_URL + "pages/admin/groups.php?groupID=" + ui.item.id;
			}
		}			
	});
	$('#confirmationModal').on('show.bs.modal', function(e) {
		var data;
		if($(this).data('bool')){
			data = $('#userToRemoveFromGroup').data();
		}
		else if($(e.relatedTarget).data('bool')) {
			data = $(e.relatedTarget).data();
		}
		else data = $('#userToAddToGroup').data();

		$('#yes').data('userid', data.userid);
		$('#yes').data('groupid', data.groupid);
		$('#yes').data('bool', data.bool);

	});

	$('#confirmationModalGroup').on('show.bs.modal', function(e) {
		var data;
		data =  $(e.relatedTarget).data();
		$('#yesGroup').data('groupid', data.groupid);
	});
	$('#yesGroup').click(function(e) {
		var groupid = $(this).data('groupid');
		$.ajax({
			url: "../../actions/admin/remove_group.php", 
			type : 'POST',
			data : {
				groupid:groupid,
				csrf_token : CSRF_TOKEN
			},
			success: function(result){
				$('tr#' + groupid).css('background-color','#FFF37F');
				$('#confirmationModalGroup').modal('hide');
				console.log(groupid);
				$('tr#' + groupid).hide(1000, function(){
					$('tr#' + groupid).remove();
				});
			},
			error : function(xhr, status, error) {
				console.log("Could not remove group: " + xhr.responseText);
				location.reload();
			}
		})
	});
	$('#yes').click(function(e) {
		var userid = $(this).data('userid');
		var groupid = $(this).data('groupid');
		var bool = $(this).data('bool');
		var params= {
			type : 'POST',
			data : {
				userid : userid,
				groupid : groupid,
				bool : bool,
				csrf_token : CSRF_TOKEN
			},
			success : function() {
				if(bool){
					$('tr#' + userid).css('background-color','#FFF37F');
					$('#confirmationModal').modal('hide');
					$('tr#' + userid).hide(1000, function(){
						$('tr#' + userid).remove();
					});
					console.log("wut1/" + userid);
				}
				else{
					console.log("wut2/" + userid);

					location.reload();
				};
			},
			error : function(xhr, status, error) {
				console.log("Could not remove user: " + xhr.responseText);
				location.reload();
			}
		};
		if($(this).data('bool'))
			params.url = "../../actions/admin/remove_from_group.php";
		else
			params.url = "../../actions/admin/add_to_group.php";
		$.ajax(params);
	});
	$("#userToRemoveFromGroup").autocomplete({
		'search':function(event,ui){
			var newUrl= BASE_URL + "api/admin/search_user_autocomplete.php?groupID=" + $("#groupID").val()+"&bool=1";
			$(this).autocomplete("option","source",newUrl)
		},
		source :[],
		minLength : 3,
		autoFocus: true,
		select : function(event, ui) {
			if (ui.item) {
				this.value = ui.item.label;
				$('#userToRemoveFromGroup').data('userid', ui.item.id);
				$('#userToRemoveFromGroup').data('groupid', ui.item.groupid);
				$('#userToRemoveFromGroup').data('bool', 1);
				$('#confirmationModal').data('bool', 1);
				$('#confirmationModal').modal('show');
			}
		}
	});
	$("#userToAddToGroup").autocomplete({
		'search':function(event,ui){
			var newUrl= BASE_URL + "api/admin/search_user_autocomplete.php?groupID=" + $("#groupID").val()+"&bool=0";
			$(this).autocomplete("option","source",newUrl)
		},
		source :[],
		minLength : 3,
		autoFocus: true,
		select : function(event, ui) {
			if (ui.item) {
				this.value = ui.item.label;
				$('#userToAddToGroup').data('userid', ui.item.id);
				$('#userToAddToGroup').data('groupid', ui.item.groupid);
				$('#userToAddToGroup').data('bool', 0);
				$('#confirmationModal').data('bool', 0);
				$('#confirmationModal').modal('show');
			}
		}
	});
});

$('input#inputGroupToManage').tooltip({ /*or use any other selector, class, ID*/
    placement: "left",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#groupname').tooltip({ /*or use any other selector, class, ID*/
    placement: "left",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#userToAddToGroup').tooltip({ /*or use any other selector, class, ID*/
    placement: "left",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#userToRemoveFromGroup').tooltip({ /*or use any other selector, class, ID*/
    placement: "left",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});