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
						<li class="active">Exam</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h1 class="text-center">{$exam.name}</h1>
						<div>
							<p><strong>Starts:</strong> {$exam.starttime} <p> <strong>Ends:</strong> {$exam.endtime}</p>
						</div>
					</div>

					<div class="panel panel-info">
  						<div class="panel-heading text-center"><h3>Exam Information</h3></div>
  						<div class="panel-body"><h5>{$exam.description}<h5></div>
					</div>
					{if $examStatus == 1}
					<a href="../../pages/exams/statistics.php"><button type="button" class="btn btn-lg btn-primary col-md-2 col-md-offset-5"> - TODO Estatisticas</button><p></p></a>
					{elseif $examStatus == 2}
					<a href="take-exam.html"><button type="button" class="btn btn-lg btn-primary col-md-2 col-md-offset-5">Take exam</button><p></p></a>
					{else}
					<div id="examAvailableParent">
						<div id="examAvailable" class="alert alert-info" >
	  						Exam not available
						</div>
					</div>
					{/if}
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}