$(document).ready(function() {
	$('input[type="checkbox"].examType').click(function() {
		if ($(this).is(':checked')) {
			$('.examTypeWarning').show(200);
		} else {
			$('.examTypeWarning').hide(200);
		}
	});
});