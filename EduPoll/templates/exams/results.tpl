{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}

					<ol class="breadcrumb">
						<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
						<li><a href="exams_taken.php">Previous Exams</a></li>
						<li class="active">Exam Results</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>LBAW - Test 1: Results</h2>
					</div>

					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6"><h3 class="panel-title">Your Score was: <strong>14</strong></h3></div>
								<div class="col-md-6 text-right"><a href="exam_taken.php">Review Exam</a></div>
							</div>
						</div>
					</div>
					
					<div class="row text-center">
						<div class="col-md-4">
							<div class="panel panel-default">
							    <div class="panel-heading"><strong>Number of Submitted Exams</strong></div>
							    <div class="panel-body">50</div>
	 						</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
							    <div class="panel-heading"><strong>Number of Approved Exams</strong></div>
							    <div class="panel-body">43</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="panel panel-default">
							    <div class="panel-heading"><strong>Average Score</strong></div>
							    <div class="panel-body">12.3</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6"><canvas id="myChart" width="600" height="400"></canvas></div>
						<div class="col-md-6 text-center">
							
								<button id="AD" type="button" class="btn btn-primary">Approved/Disapproved</button>
								<button id="GD" type="button" class="btn btn-info">Grades Distribution</button>
						
						</div>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>

	<script src="./frameworks/Chart.js"></script>
	<script src="./javascript/results.js"></script>
{include file='common/footer.tpl'}