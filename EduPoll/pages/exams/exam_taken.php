<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="img/favicon.png">

<title>EduPoll</title>

<!-- Bootstrap core CSS -->
<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="css/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/global.css" rel="stylesheet">
<link href="css/theme.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">

	<!-- Fixed navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="main.html">EduPoll</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="exams-taken.html">Previous Exams</a></li>
					<li><a href="create-exam.html">Create Exam</a></li>
					<li><a href="my-exams.html">My Exams</a></li>
					<li><a href="index.html">Logout</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-3 col-md-2 sidebar">

				<div class="calendar-mini">
					<div class="calendar-month">
						<ul class="calendar-header">
							<li class="calendar-prev-month">â�®</li>
							<li class="calendar-next-month">â�¯</li>
							<li style="text-align: center">August<br> <span
								style="font-size: 18px">2016</span>
							</li>
						</ul>
					</div>

					<ul class="calendar-weekdays">
						<li>Mo</li><li>Tu</li><li>We</li><li>Th</li><li>Fr</li><li>Sa</li><li>Su</li>
					</ul>

					<ul class="calendar-days">
						<li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li><li>
						<span class="calendar-day-active">10</span></li><li>11</li><li>12</li><li>13</li><li>14</li><li>15
						</li><li>16</li><li>17</li><li>18</li><li>19</li><li>20</li><li>21</li><li>22</li><li>23</li><li>
						24</li><li>25</li><li>26</li><li>27</li><li>28</li><li>29</li><li>30</li><li>31</li>
					</ul>
				</div>
				
          	</br></br><ul class="nav nav-sidebar" text-align="right">
            	<li><a href="edit-profile.html">AndrÃ© Sousa Lago</a></li>
          	</ul>
          
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">

					<ol class="breadcrumb">
						<li><a href="main.html">Home</a></li>
						<li><a href="exams-taken.html">Previous Exams</a></li>
						<li><a href="results.html">Exam Results</a></li>
						<li class="active">Exam review</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>LBAW - Teste 3</h2>
						<p>12/03/2015 09:30-11:30</p>
					</div>
					
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6"><h3 class="panel-title">Your Score was: <strong>17.5</strong>/20.0</h3></div>
								<div class="col-md-6 text-right"><a href="results.html">Return to the Results Page</a></div>
							</div>
						</div>
					</div>

					<div class="first-element panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Question 1</h3>
						</div>
						<div class="panel-body">
								<p class="list-group-item-text">Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Cras at massa vel quam tincidunt
									tempus a eu ipsum. Pellentesque lobortis, turpis sit amet
									congue fermentum, mauris ante sollicitudin metus, vitae gravida
									leo sem et nunc.</p>
								<form>
									<div class="checkbox">
										<label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 1</label>
											
											<br/><label style="text-decoration: underline;" class="radio-inline"><input type="radio"
											name="optradio" checked="checked" disabled>Correct option</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 4</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Score: 2 / 2
									</div>
								</div>
						</div>
					</div>
					
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Question 2</h3>
						</div>
						<div class="panel-body">
								<p class="list-group-item-text">Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Cras at massa vel quam tincidunt
									tempus a eu ipsum. Pellentesque lobortis, turpis sit amet
									congue fermentum, mauris ante sollicitudin metus, vitae gravida
									leo sem et nunc.</p>
								<form>
									<div class="checkbox">
										<label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 1</label>
											
											<br/><label style="text-decoration: underline;" class="radio-inline"><input type="radio"
											name="optradio" disabled>Correct option</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" checked="checked" disabled>Incorrect option</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Score: 0 / 2
									</div>
								</div>
						</div>
					</div>
					
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Question 3</h3>
						</div>
						<div class="panel-body">
								<p class="list-group-item-text">Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Cras at massa vel quam tincidunt
									tempus a eu ipsum. Pellentesque lobortis, turpis sit amet
									congue fermentum, mauris ante sollicitudin metus, vitae gravida
									leo sem et nunc.</p>
								<form>
									<div class="checkbox">
										<label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 1</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 2</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 3</label>
											
											<br/><label style="text-decoration: underline;" class="radio-inline"><input type="radio"
											name="optradio" disabled checked="checked">Correct option</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Score: 2 / 2
									</div>
								</div>
						</div>
					</div>
					
					<div class="last-element panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Question 4</h3>
						</div>
						<div class="panel-body">
								<p class="list-group-item-text">Lorem ipsum dolor sit amet,
									consectetur adipiscing elit. Cras at massa vel quam tincidunt
									tempus a eu ipsum. Pellentesque lobortis, turpis sit amet
									congue fermentum, mauris ante sollicitudin metus, vitae gravida
									leo sem et nunc.</p>
								<form>
									<div class="checkbox">
										<label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 1</label>
											
											<br/><label style="text-decoration: underline;" class="radio-inline"><input type="radio"
											name="optradio" checked="checked" disabled>Correct option</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" disabled>Option 4</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Score: 2 / 2
									</div>
								</div>
						</div>
					</div>
					
					
					<a href="results.html"><button type="button" class="btn btn-primary">Return to results page</button><p></p></a>	
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
					window.jQuery
							|| document
									.write('<script src="js/vendor/jquery.min.js"><\/script>')
				</script>
	<script src="javascript/bootstrap.min.js"></script>
	<script src="javascript/docs.min.js"></script>
</body>
</html>
