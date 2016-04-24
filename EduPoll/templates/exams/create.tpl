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
						<li class="active">Create Exam</li>
					</ol>

					<form class="form-register-ind-user" method="get" action="test.html">
						<h2 class="form-signin-heading">Enter the new exam's information below</h2>
						
						<label for="inputName" class="sr-only">Exam name</label>
						<input type="text" name="examName" id="inputName" class="form-control" placeholder="Exam name" required autofocus>
						<br/>
						
						<label for="inputDescription" class="sr-only">Exam description</label>
						<textarea id="inputDescription" name="examDescription" class="form-control" placeholder="Exam description" rows="10" required></textarea>
						<br/>
						
						<div class="checkbox">
							<label class="radio-inline"><input type="radio" name="examType" checked="checked" >Closed Exam</label>
							<label class="radio-inline"><input type="radio" name="examType">Open Exam</label>
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