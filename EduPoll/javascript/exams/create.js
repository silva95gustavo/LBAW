$(document).ready(function() {
	$('input[type="checkbox"].examType').click(function() {
		if ($(this).is(':checked')) {
			$('.examTypeWarning').show(200);
		} else {
			$('.examTypeWarning').hide(200);
		}
	});

	$(function () {
		$('#startDate').datetimepicker({
			format: "YYYY-MM-DD HH:mm:00"
		});
		$('#endDate').datetimepicker({
			format: "YYYY-MM-DD HH:mm:00",
			useCurrent: false
		});
		$('#startDate').data("DateTimePicker").minDate(new Date());
		$('#endDate').data("DateTimePicker").minDate(new Date());
		$("#startDate").on("dp.change", function (e) {
			$('#endDate').data("DateTimePicker").minDate(e.date);
			if($('#startDate').find("input").val() == "")
				$('#endDate').find("input").val("");
		});
		$("#endDate").on("dp.change", function (e) {
			$('#startDate').data("DateTimePicker").maxDate(e.date);
		});
	});

	$("[name='privacy']").bootstrapSwitch();
});
