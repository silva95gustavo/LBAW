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
						<li><a href="exam-welcome.html">Exam</a></li>
						<li class="active">Take Exam</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>COMP - Teste 1</h2>
						<p>25/02/2016 10:00-13:00</p>
					</div>
					
					<a href="exam-welcome.html"></a><button type="button" class="btn btn-primary">Submit exam</button><p></p></a>

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
											name="optradio" >Option 1</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio"  >Option 2</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 4</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >I don't want to answer</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Max Score: 3
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
											name="optradio" >Option 1</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio">Option 2</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio"  >Option 4</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Max Score: 2
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
											name="optradio" >Option 1</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 2</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio"  >Option 4</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >I don't want to answer</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Max Score: 2
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
											name="optradio" >Option 1</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 2</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 3</label>
											
											<br/><label class="radio-inline"><input type="radio"
											name="optradio" >Option 4</label>
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Max Score: 2
									</div>
								</div>
						</div>
					</div>
					
					<h4>Total exam max score: 9</h4>
					
					<button type="button" class="btn btn-primary">Submit exam</button><p></p>
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}