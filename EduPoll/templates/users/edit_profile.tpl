{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}

					<ol class="breadcrumb">
						<li><a href="main.php">Home</a></li>
						<li class="active">Edit Profile</li>
					</ol>

					<form class="form-change-password" method="post" action="{$BASE_URL}actions/users/edit.php">
						<h2 class="form-signin-heading">Change password</h2>
						
						<div class="row">
							<div class="col-md-6">
								<label for="inputOldPassword" class="sr-only">Full name</label>
								<input type="password" name="inputOldPassword" id="inputOldPassword" class="form-control" placeholder="Current Password" required autofocus>
							</div>
						</div>
						<br/>

						<div class="row">
							<div class="col-md-6">
								<label for="inputNewPassword" class="sr-only">Email</label>
								<input type="password" name="inputNewPassword" id="inputNewPassword" class="form-control" placeholder="New Password" required>
							</div>
						</div>
						<br/>
						
						<div class="row">
							<div class="col-md-6">
								<label for="inputConfirmPassword" class="sr-only">Email</label>
								<input type="password" name="inputConfirmPassword" id="inputConfirmPassword" class="form-control" placeholder="Confirm New Password" required>
							</div>
						</div>
						<br/>
						
						<button class="btn btn-lg btn-primary" type="submit">Update Password</button>
					</form>

					<br/>

					<form class="form-change-email" method="post" action="{$BASE_URL}actions/users/edit.php">
						<h2 class="form-signin-heading">Change email</h2>
						
						<div class="row">
							<div class="col-md-6">
								<label for="inputNewEmail" class="sr-only">New email</label>
								<input type="email" name="inputNewEmail" id="inputNewEmail" class="form-control" placeholder="New Email" required>
							</div>
						</div>
						<br/>
						
						<div class="row">
							<div class="col-md-6">
								<label for="inputConfirmNewEmail" class="sr-only">New email</label>
								<input type="email" name="inputNewEmail" id="inputConfirmNewEmail" class="form-control" placeholder="Confirm New Email" required>
							</div>
						</div>
						<br/>

						<br/>
						
						<button class="btn btn-lg btn-primary" type="submit">Update Email</button>
					</form>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
	
<!--<script src="{$BASE_URL}javascript/user/edit_profile.js"></script>-->
{include file='common/footer.tpl'}