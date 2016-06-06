
	$("[name='genderType']").bootstrapSwitch();
	$("[name='userType']").bootstrapSwitch();

	$('input#inputName').tooltip({ /*or use any other selector, class, ID*/
	    placement: "left",
	    trigger: 'hover',
	    delay:  { "show": 500, "hide": 100 }
	});

	$('input#inputEmail').tooltip({ /*or use any other selector, class, ID*/
	    placement: "left",
	    trigger: 'hover',
	    delay: { "show": 500, "hide": 100 }
	});

	$('input#confirmUserEmail').tooltip({ /*or use any other selector, class, ID*/
	    placement: "left",
	    trigger: 'hover',
	    delay: { "show": 500, "hide": 100 }
	});