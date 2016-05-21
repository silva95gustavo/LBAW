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

				<form class="form-register-ind-user" method="post" action="{$BASE_URL}actions/users/register.php">
					<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
					<h2 class="form-signin-heading">Enter the new user's information below</h2>

					<label for="inputName" class="sr-only">Full name</label>
					<input type="text" name="userName" id="inputName" class="form-control" placeholder="Full name" required autofocus>
					<br/>

					<label for="inputEmail" class="sr-only">Email</label>
					<input type="email" name="userEmail" id="inputEmail" class="form-control" placeholder="Email" required>
					<br/>

					<label for="confirmUserEmail" class="sr-only">Confirm Email</label>
					<input type="email" name="confirmUserEmail" id="confirmUserEmail" class="form-control" placeholder="Confirm Email" required>
					<br/>

					<label><strong>Gender:</strong></label>
					<input type="checkbox" name="genderType" data-on-text="Male" data-off-text="Female" checked>
					<br/> <br/>
					<label><strong>Permissions:</strong></label>
					<input type="checkbox" name="userType" data-on-text="Student" data-off-text="Teacher" checked>

					<br/><br/>

					<button class="btn btn-lg btn-primary" type="submit">Register User</button>
				</form>

			</div>
		</div>
	</div>

</div>
<!-- /container -->

{include file='common/footer.tpl'}
<script type="text/javascript" src="{$BASE_URL}frameworks/bootstrap-switch.min.js"></script>			
<script src="{$BASE_URL}javascript/admin/add_individual_user.js"></script>