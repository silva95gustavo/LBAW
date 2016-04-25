{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}

					<ol class="breadcrumb">
						<li><a href="main.php">Home</a></li>
						<li><a href="add_users.php">Add Users</a></li>
						<li class="active">Add Individual User</li>
					</ol>

					<form class="form-register-ind-user">
						<h2 class="form-signin-heading">Enter the new user's information below</h2>
						
						<label for="inputName" class="sr-only">Full name</label>
						<input type="text" id="inputName" class="form-control" placeholder="Full name" required autofocus>
						<br/>
						
						<label for="inputEmail" class="sr-only">Email</label>
						<input type="email" id="inputEmail" class="form-control" placeholder="Email" required>
						<br/>
						
						<div class="checkbox">
							<label class="radio-inline"><input type="radio" name="optradio" required>Teacher</label>
							<label class="radio-inline"><input type="radio" name="optradio" checked="checked" required>Student</label>
						</div>
						<br/>
						
						<button class="btn btn-lg btn-primary btn-block" type="submit">Register Student</button>
					</form>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}
