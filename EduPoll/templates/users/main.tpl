{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
					<ol class="breadcrumb">
						<li class="active">Home</li>
					</ol>

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Ongoing exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">LBAW - Teste 1</h4> <datetime
										class="list-group-item-text">22-01-2015 12:00-14:00</datetime>
									<p class="list-group-item-text">This exam starts in less
										than 10 minutes!</p>
								</a>
							</div>
						</div>
					</div>
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Upcoming exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">IART - Teste 1</h4> <datetime
										class="list-group-item-text">25-01-2015 12:00-14:00</datetime>
								</a> <a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">COMP - Avaliação
										Individual 1</h4> <datetime class="list-group-item-text">27-01-2015
									12:00-14:00</datetime>
								</a> <a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">SDIS - Prova 2</h4> <datetime
										class="list-group-item-text">29-01-2015 12:00-14:00</datetime>
								</a>
							</div>
						</div>
					</div>
					<div class="last-element panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Future exams</h3>
						</div>
						<div class="panel-body">
							<div class="list-group">
								<a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">LBAW - Teste 2</h4> <datetime
										class="list-group-item-text">05-02-2015 12:00-14:00</datetime>
								</a> <a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">COMP - Avaliação
										Individual 2</h4> <datetime class="list-group-item-text">15-02-2015
									12:00-14:00</datetime>
								</a> <a href="{$BASE_URL}pages/exams/exam_welcome.php" class="list-group-item">
									<h4 class="list-group-item-heading">SDIS - Prova 3</h4> <datetime
										class="list-group-item-text">23-02-2015 12:00-14:00</datetime>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
	<!-- /container -->

{include file='common/footer.tpl'}