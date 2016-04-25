{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}
					
					<ol class="breadcrumb">
						<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
						<li class="active">Create Exam</li>
					</ol>

					<form class="form-register-ind-user" method="post" action="{$BASE_URL}actions/exams/create.php">
						<h2 class="form-signin-heading">Enter the new exam's information below</h2>
						
						<label for="inputName" class="sr-only">Exam name</label>
						<input type="text" name="examName" id="inputName" class="form-control" placeholder="Exam name" required autofocus>
						<br/>
						
						<label for="inputDescription" class="sr-only">Exam description</label>
						<textarea id="inputDescription" name="examDescription" class="form-control" placeholder="Exam description" rows="10" required></textarea>
						<br/>
						
						<div class="checkbox">
							<label class="checkbox"><input type="checkbox" name="examType" checked="checked" >Closed exam?</label>
						</div>
						<br/>

						<div class="alert alert-warning" role="alert">
							<strong>Warning!</strong> Closed exams can only be seen by users you later invite to them.
						</div>

						<!--  <div class="alert alert-warning" role="alert">
							<strong>Warning!</strong> Open exams can be seen and taken by anyone with the exam link. It might be hard to control who has access to this exam.
						</div> -->

						<button class="btn btn-lg btn-primary btn-block" type="submit">Create Exam</button>
					</form>
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}