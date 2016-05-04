
var userId = null;

$('a').click(function(e){
    
    userId = $(this.id).selector;
    $('#yes').click(function () {
        if (this.id == 'yes') {
            
            $.ajax({
                type: 'POST',
                url: "../../actions/users/delete.php",
                data: { id: userId },
                statusCode: {
                    200: function () {
                        $('tr#'+userId).remove();
                    },

                    400: function () {
                        location.reload();
                    }
                }

            });
            
        }
    })

});


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