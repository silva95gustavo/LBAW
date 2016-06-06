$(document).ready(function() {
	$('input#inputEmail').tooltip({ /*or use any other selector, class, ID*/
	    placement: "left",
	    trigger: 'hover',
	    delay: { "show": 500, "hide": 100 }
	});
	
	$('input#inputPassword').tooltip({ /*or use any other selector, class, ID*/
	    placement: "left",
	    trigger: 'hover',
	    delay: { "show": 500, "hide": 100 }
	});
}); 