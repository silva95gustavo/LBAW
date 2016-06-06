//animationEasing for Pie Charts: easeOutBounce, easeOutBack, easeOutElastic, easeOutCirc, easeInOutExpo, easeInOutSine
var circular = null;
var bar = null;
var chart = null;

var submitted_no;
var approved_no;
var grade_dist = [];

var dir_base;

var examID = null;


$(document).ready(function(){

	

	submitted_no = parseInt($("#exam_submitted_no").text());
	approved_no = parseInt($("#exam_approved_no").text());
	
	for(var i = 0; i <= 20; ++i) {
		grade_dist[i] = parseInt($("#grade_distribution #grade" + i).text());
	}
	
	circular = $("#AScanvas").get(0).getContext("2d");
	bar = $("#GDcanvas").get(0).getContext("2d");
	asChart();
	
	dir_base = window.location.protocol + "//" + window.location.host + $("#base_url_start").text();
});

$('button#generateLink').on('click', function(){
	examID = $(this).data("id");
	var csrf_token = $('input#csrf_token').val();
	$.ajax({
		type: 'POST',
		url: '../../api/exams/generate_guest_link.php',
		data: { examID: examID, csrf_token: csrf_token },
		success: function(data) {
			var urlPath = dir_base + "pages/exams/welcome.php?id="+examID+"&inv=";
			var json = JSON.stringify(data);
			var response = JSON.parse(json);
			$('input#generatedLink').val('');
			$('input#generatedLink').val(urlPath+response);
			animateColorButtonCopy('#FFFF99');
		},
		error: function() {
			location.reload();
		}
	})
});

$('.shareButton').bootstrapSwitch('state', true);

$('.shareButton').on('switchChange.bootstrapSwitch', 
	function (event, state)
	{
		var examid = $(this).data("id");
		if(state){
		$.ajax({
			type: 'POST',
			url: "../../api/exams/share.php",
			data: { examid:examid, share: state , csrf_token: CSRF_TOKEN },
			success: function () {
				console.log("Exam has shared grades.")
			},
			error: function () {
				console.log("Could not change setting.")
			}
		});
		}
		else{
			$.ajax({
			type: 'POST',
			url: "../../api/exams/share.php",
			data: { examid:examid, share: state , csrf_token: CSRF_TOKEN },
			success: function () {
				console.log("Exam has private grades.")
			},
			error: function () {
				console.log("Could not change setting.")
			}
		});
		}
	}
	);


function animateColorButtonCopy(color) {
	$('button#copy').css("background-color", color);
	$('button#copy').animate({
		"background-color": "white"
	}, 1000);
};

$('button#copy').on('click', function(){
	var text = $('input#generatedLink').val();
	if(text == "")
		animateColorButtonCopy('#FF9999');
	else if(copyToClipboard(document.getElementById('generatedLink')))
		animateColorButtonCopy('#ADFFAD');
	else
		animateColorButtonCopy('#FF9999');
});

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
};


$("#AStab").on("click", function(){
	if(chart != null)
		chart.destroy();
	asChart();
});

$("#GDtab").on("click", function(){
	if(chart != null)
		chart.destroy();
	gdChart();
});


function asChart(){

	data = [
	        {
	        	value: approved_no,
	        	color: "#85e085",
	        	highlight: "#00e64d",
	        	label: "Approved"
	        },
	        {
	        	value: submitted_no - approved_no,
	        	color: "#ff4d4d",
	        	highlight: "#ff1a1a",
	        	label: "Disapproved"
	        }
	];
	
	chart = new Chart(circular).Pie(data);
}


function gdChart(){
	
	data = {
		labels: ["0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20"],
		datasets: [
			{
				label: "Grades Distribution",
				fillColor: "#66b3ff",
	            strokeColor: "#0080ff",
	            highlightFill: "#66b3ff",
	            highlightStroke: "#0059b3",
	            data: grade_dist
			}
		]
	};
	
	
	chart = new Chart(bar).Bar(data);
}

