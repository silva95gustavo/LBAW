<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" href="img/favicon.png">

<title>EduPoll</title>

<!-- Bootstrap core CSS -->
<link href="{$BASE_URL}css/bootstrap/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap theme -->
<link href="{$BASE_URL}css/bootstrap/bootstrap-theme.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="{$BASE_URL}css/global.css" rel="stylesheet">
<link href="{$BASE_URL}css/signin.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{$BASE_URL}javascript/main.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">
	<div class="container">
	
	<div id="error_messages">
    {foreach $ERROR_MESSAGES as $error}
      <div class="alert alert-danger">{$error}<a class="close" href="#">X</a></div>
    {/foreach}
    </div>
    <div id="success_messages">
    {foreach $SUCCESS_MESSAGES as $success}
      <div class="alert alert-success">{$success}<a class="close" href="#">X</a></div>
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
