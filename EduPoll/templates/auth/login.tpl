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
				<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
	</div>

{include file='common/footer.tpl'}
