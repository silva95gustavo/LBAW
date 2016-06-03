//animationEasing for Pie Charts: easeOutBounce, easeOutBack, easeOutElastic, easeOutCirc, easeInOutExpo, easeInOutSine
var circular = null;
var bar = null;
var chart = null;

var submitted_no;
var approved_no;
var grade_dist = [];

$(document).ready(function(){
	submitted_no = parseInt($("#exam_submitted_no").text());
	approved_no = parseInt($("#exam_approved_no").text());
	
	for(var i = 0; i <= 20; ++i) {
		grade_dist[i] = parseInt($("#grade_distribution #grade" + i).text());
	}
	console.log(grade_dist);
	
	circular = $("#AScanvas").get(0).getContext("2d");
	bar = $("#GDcanvas").get(0).getContext("2d");
	asChart();
});


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

