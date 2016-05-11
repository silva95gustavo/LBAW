
var userId = null;

$('#confirmationModal').on('show.bs.modal', function (e) {
    var data = $(e.relatedTarget).data();
    console.log(data);
    $('#yes').data('id', data.id);
})

$('#yes').click(function (e) {
    userId = $(this).data('id');
    console.log('check', $(this).data('id'), userId, $(this).data());
    $.ajax({
        type: 'POST',
        url: "../../actions/users/delete.php",
        data: { id: userId },
        success: function () {
        	$('tr#' + userId).hide('slow', function(){ $('tr#' + userId).remove(); });
            $('tr#' + userId).remove();
            $('#confirmationModal').modal('hide');
        },
        error: function () {
            location.reload();
        }
    });
})

function searchForUserMatch() {
    var data = $('#inputUserToRemove').val();
    console.log(data);

    $.ajax({
        type: 'POST',
        url: "../../actions/users/searchFTS.php",
        data: { data: data },
        success: function (data) {
            console.log(data);
        }
    });
}