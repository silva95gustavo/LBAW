//animationEasing for Pie Charts: easeOutBounce, easeOutBack, easeOutElastic, easeOutCirc, easeInOutExpo, easeInOutSine
var ctx = null;
var chart = null;


$(document).ready(function(){
	ctx = $("#myChart").get(0).getContext("2d");
	adChart();
});


$("#AD").click(function(){
	if(chart != null)
		chart.destroy();
	adChart();
});

$("#GD").click(function(){
	if(chart != null)
		chart.destroy();
	gdChart();
});


function adChart(){
	
	data = [
	        {
	        	value: 43,
	        	color: "#85e085",
	        	highlight: "#00e64d",
	        	label: "Approved"
	        },
	        {
	        	value: 7,
	        	color: "#ff4d4d",
	        	highlight: "#ff1a1a",
	        	label: "Disapproved"
	        }
	];
	
	
	chart = new Chart(ctx).Pie(data);
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
	            data: [1,2,1,2,1,1,0,1,
	                   1,1,2,5,5,1,4,5,
	                   7,4,2,3,1]
			}
		]
	};
	
	

	
	
	chart = new Chart(ctx).Bar(data);
}