{include file='common/header.tpl'}
<link href="{$BASE_URL}css/signin.css" rel="stylesheet">
	<div class="container">
	
	<div id="error_messages">
    {foreach $ERROR_MESSAGES as $error}
      <div class="alert alert-danger alert-dismissable">{$error}
      <button type="button" class="close" data-dismiss="alert">&times;</a>
      {$success}
      </div>
    {/foreach}
    </div>
    <div id="success_messages">
    {foreach $SUCCESS_MESSAGES as $success}
      <div class="alert alert-success alert-dismissable">{$success}
      <button type="button" class="close" data-dismiss="alert">&times;</a>
      {$success}
      </div>
    {/foreach}
    </div>

	<div class="col-md-4 col-md-offset-4">
		<form class="form-signin" action="{$BASE_URL}actions/users/login.php">
			<h2 class="form-signin-heading">EduPoll</h2>
			<label for="inputEmail" class="sr-only">Email address</label> <input
				   type="email" id="inputEmail" class="form-control"
				   placeholder="Email address" required autofocus> 
				<label for="inputPassword" class="sr-only">Password</label> 
			<input type="password" id="inputPassword" class="form-control"
				   placeholder="Password" required>
				<div class="checkbox">
					<label> 
						<input type="checkbox" value="remember-me">Remember me
					</label>
				</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		</form>
	</div>

	</div>

{include file='common/footer.tpl'}
