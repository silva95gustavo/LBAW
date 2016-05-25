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
						<li><a href="{$BASE_URL}pages/exams/exams_taken.php">Previous Exams</a></li>
						<li><a href="{$BASE_URL}pages/exams/results.php">Exam Results</a></li>
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
								<div class="col-md-6 text-right"><a href="results.php">Return to the Results Page</a></div>
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
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
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
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
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
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
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
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
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
{include file='common/footer.tpl'}