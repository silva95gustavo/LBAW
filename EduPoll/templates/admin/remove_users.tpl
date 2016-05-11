{include file='common/header.tpl'} {include file='common/menu.tpl'}

<div class="container-fluid">
	<div class="row">
		{include file='common/sidebar.tpl'}
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="container theme-showcase" role="main">

				{include file='common/result_messages.tpl'}

				<ol class="breadcrumb">
					<li><a href="admin.html">Home</a></li>
					<li class="active">Remove Users</li>
				</ol>

				<form class="form-remove-user">
					<h2 class="form-signin-heading">Remove user</h2>

					<label for="inputUserToRemove" class="sr-only">Full name</label>
					<input type="text" id="inputUserToRemove" class="form-control" placeholder="User name or email" onkeyup=""
						required autofocus>
					<br/>

					<button class="btn btn-lg btn-primary btn-block" type="submit">Remove User</button>
				</form>
				<br/><br/>

				<h2>User list:</h2>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						{foreach $users as $user}
						<tr id="{$user.id}">
							<td>{$user.id}</td>
							<td>{$user.name}</td>
							<td>{$user.email}</td>
							<td><a data-id="{$user.id}" href="#" data-toggle="modal" data-target="#confirmationModal">Remove</a></td>
						</tr>
						{/foreach}
					</tbody>
				</table>

				{for $i=1 to $numberOfPages}
				<a href="remove_users.php?page={$i}">{$i}</a> {/for}

				<div id="confirmationModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Are you sure to delete this user?</h4>
							</div>
							<div class="modal-body text-center">
								<button type="button" id="yes" class="btn btn-success">Yes</button>
								<button type="button" id="no" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</div>


<!-- /container -->

{include file='common/footer.tpl'}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
<script src="{$BASE_URL}javascript/admin/remove_users.js"></script>
