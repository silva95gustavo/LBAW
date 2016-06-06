$(document).ready(function() {
	$("[name='privacy']").on('switchChange.bootstrapSwitch', function (event, state) {
		if (!state) { //true -> Public   false -> Private
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


$('input#inputExam').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('textarea#inputDescription').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#inputMaxTries').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#starttime').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});

$('input#endtime').tooltip({ /*or use any other selector, class, ID*/
    placement: "top",
    trigger: 'hover',
    delay: { "show": 500, "hide": 100 }
});