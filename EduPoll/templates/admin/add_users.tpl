{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">

					<ol class="breadcrumb">
						<li><a href="main.html">Home</a></li>
						<li class="active">Add Users</li>
					</ol>

					<br/><br/>
					<a href="add_individual_user.php"><button type="button" class="btn btn-lg btn-primary">
						Add individual users
					</button></a>
					<h4>Create a single user and add it to the system
						(automatically notifies the user)</h4>
					<br/><br/><br/><br/>
					<a href="add_multiple_users.php"><button type="button" class="btn btn-lg btn-primary">
						Add multiple users
					</button></a>
					<h4>Import a file containing a list of users, along with their types and groups, therefore adding all of them to the system.</h4>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}