{include file='common/header.tpl'}
<link href="{$BASE_URL}css/signin.css" rel="stylesheet">
	<div class="container">
		{include file='common/result_messages.tpl'}
		<div class="col-md-4 col-md-offset-4">
			<form class="form-signin" action="{$BASE_URL}actions/auth/login.php" method="post">
				<h2 class="form-signin-heading">EduPoll</h2>
				<label for="inputEmail" class="sr-only">Email address</label> <input
					   type="email" id="inputEmail" name="email" class="form-control"
					   placeholder="Email address" required autofocus> 
					<label for="inputPassword" class="sr-only">Password</label> 
						<input type="password" id="inputPassword" name="password" class="form-control"
							   placeholder="Password" required>
					<div class="checkbox">
						<label> 
							<input type="checkbox" value="remember-me">Remember me
						</label>
					</div>
					<a href="#" data-toggle="modal" data-target="#myModal"><p>Reset password</p></a>
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				
				<!-- Modal -->
				<div id="myModal" class="modal fade" role="dialog">
  					<div class="modal-dialog">

    					<!-- Modal content-->
    					<div class="modal-content">
      						<div class="modal-header">
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
        						<h4 class="modal-title">Reset Password</h4>
      						</div>
      						<div class="modal-body">
        						<input type="email" id="resetEmailValue" name="resetEmailValue" class="form-control"
					   				placeholder="Email address">
      						</div>
      						<div class="modal-footer">
        						<button id="resetEmailSubmit" type="button" class="btn btn-default">Reset</button>
      						</div>
    					</div>
  					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="{$BASE_URL}javascript/auth/reset_password.js"></script>
{include file='common/footer.tpl'}
