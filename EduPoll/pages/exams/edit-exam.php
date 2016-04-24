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
<!-- Font awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
					<li class="active"><a href="create-exam.html">Create Exam</a></li>
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
							<li class="calendar-prev-month">❮</li>
							<li class="calendar-next-month">❯</li>
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

				<ul class="nav nav-sidebar">
					<li><a href="edit-profile.html">Teacher's Name</a></li>
				</ul>

			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">

					<ol class="breadcrumb">
						<li><a href="main.html">Home</a></li>
						<li><a href="my-exams.html">My Exams</a></li>
						<li class="active">Edit Exam</li>
					</ol>

					<!-- Trigger the modal with a button -->

					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><strong>Create/Edit Question</strong></h4>
								</div>
								<div class="modal-body">
									<p><strong>Category: </strong> Category A</p>
									<label><strong>Question:</strong></label>
									<input type="text" class="form-control">
									<form>
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 1</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 2</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 3</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 4</label>
										</div>
										<input type="text" class="form-control">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>

					<div class="panel panel-default text-center">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<button type="button" class="btn btn-info">Add New Category</button>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-success">Save Changes</button>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-danger">Cancel Changes</button>
								</div>	
							</div>
						</div>
					</div>
					

					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6"><strong>Category A</strong></div>
								<div class="col-md-6 text-right">
									<i class="fa fa-plus"></i>
									<i class="fa fa-pencil"></i>
									<i class="fa fa-trash-o"></i>
								</div>
							</div>
						</div>
						
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6">Question A1</div>
										<div class="col-md-6 text-right">
											<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
											<i class="fa fa-trash-o"></i>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<p><strong>Question: </strong>First question. Select the correct option:</p>
									<form>
										<div class="radio disabled">
											<label><input type="radio" name="optradio1" checked="checked">Option 1</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio1" disabled>Option 2</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio1" disabled>Option 3</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio1" disabled>Option 4</label>
										</div>
									</form>
								</div>
							</div>
						</div>
						
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6">Question A2</div>
										<div class="col-md-6 text-right">
											<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
											<i class="fa fa-trash-o"></i>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<p><strong>Question: </strong>Second question. Select the correct option:</p>
									<div class="radio disabled">
										<label><input type="radio" name="optradio2" disabled>Option 1</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio2" checked="checked">Option 2</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio2" disabled>Option 3</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio2" disabled>Option 4</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="panel panel-info">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6"><strong>Category B</strong></div>
								<div class="col-md-6 text-right">
									<i class="fa fa-plus"></i>
									<i class="fa fa-pencil"></i>
									<i class="fa fa-trash-o"></i>
								</div>
							</div>
						</div>
						
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6">Question B1</div>
										<div class="col-md-6 text-right">
											<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
											<i class="fa fa-trash-o"></i>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<p><strong>Question: </strong>First question. Select the correct option:</p>
									<div class="radio disabled">
										<label><input type="radio" name="optradio3" checked="checked">Option 1</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio3" disabled>Option 2</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio3" disabled>Option 3</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio3" disabled>Option 4</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6">Question B2</div>
										<div class="col-md-6 text-right">
											<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
											<i class="fa fa-trash-o"></i>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<p><strong>Question: </strong>Second question. Select the correct option:</p>
									<div class="radio disabled">
										<label><input type="radio" name="optradio4" disabled>Option 1</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio4" disabled>Option 2</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio4" checked="checked">Option 3</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio4" disabled>Option 4</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel-body">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6">Question B3</div>
										<div class="col-md-6 text-right">
											<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
											<i class="fa fa-trash-o"></i>
										</div>
									</div>
								</div>
								<div class="panel-body">
									<p><strong>Question: </strong>Third question. Select the correct option:</p>
									<div class="radio disabled">
										<label><input type="radio" name="optradio5" disabled>Option 1</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio5" disabled>Option 2</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio5" checked="checked">Option 3</label>
									</div>
									<div class="radio disabled">
										<label><input type="radio" name="optradio5" disabled>Option 4</label>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="panel panel-default text-center">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<button type="button" class="btn btn-info">Add New Category</button>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-success">Save Changes</button>
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn-danger">Cancel Changes</button>
								</div>	
							</div>
						</div>
					</div>
					
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