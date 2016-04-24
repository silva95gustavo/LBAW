{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">

					<ol class="breadcrumb">
						{if isAdmin() }
							<li><a href="{$BASE_URL}pages/admin/main.php">Home</a></li>
						{elseif isAcademic() }
							<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
						{/if}
						<li><a href="exams-taken.html">Previous Exams</a></li>
						<li class="active">Exam Results</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>LBAW - Test 1: Results</h2>
					</div>

					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Information</h3>
						</div>
						<div class="panel-body">This exam's results are not available yet. Please come back again later.</div>
					</div>
					
					<a href="exams-taken.html"><button type="button" class="btn btn-primary">Return</button><p></p></a>
					
					
				</div>
			</div>
		</div>
	</div>

	<script src="./frameworks/Chart.js"></script>
	<script src="./javascript/results.js"></script>
{include file='common/footer.tpl'}