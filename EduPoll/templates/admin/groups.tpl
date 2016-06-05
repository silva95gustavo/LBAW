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
					<li class="active">Manage Groups</li>
				</ol>

				<form class="form-manage-group">
					<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
					<h3 class="form-signin-heading">Search Groups</h3>

					<label for="inputGroupToManage" class="sr-only">Full name</label>
					<input type="text" id="inputGroupToManage" class="form-control" placeholder="Group Name"
					required autofocus>
					<input type="hidden" name="groupID" id="groupID" value="{$groupid}">
					<br/>
				</form>

				{if $listing}

				<form action="{$BASE_URL}actions/admin/create_group.php" method="post" enctype="multipart/form-data">
					<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
					<h3 class="form-signin-heading">Create Group</h3>

					<label for="create_group" class="sr-only">Full name</label>
					<input type="text" name="groupname" id="groupname" class="form-control" placeholder="Group Name"
					required autofocus> 
					<br/>
				</form>

				<table class="table table-striped">
					<thead>
						<tr>
							<th>Name</th>
							<th>Number Of Students</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						{foreach $groups as $group}
						<tr id="{$group.id}">
							<td><a href="?groupID={$group.id}">{$group.name}</a></td>
							<td>{$nstudents[$group['id']]}</td>
							<td><a data-groupid="{$group.id}" href="#" data-toggle="modal" data-target="#confirmationModalGroup">Remove</a></td>
						</tr>
					</tr>
					{/foreach}
				</tbody>
			</table>

			{for $i=1 to $numberOfPages}
			<a href="groups.php?page={$i}">{$i}</a> 
			{/for}

			{else}
			<br/>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 text-center">
						<h2>{$groupname}</h2>
						<a data-groupid="{$groupid}" href="#" data-toggle="modal" data-target="#confirmationModalGroup">
							<h5 class="text-center">(Delete)</h5> </a>
						</div>
						<form class="form-add-user col-md-6" id="addform" >
							<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
							<h2 class="form-signin-heading">Add Student To Group</h2>

							<label for="userToAddToGroup" class="sr-only">Full name</label>
							<input type="text" id="userToAddToGroup" class="form-control" placeholder="User name or email"
							required autofocus/>
							<input type="hidden" name="groupID" id="groupID" value="{$groupid}"/>
						</form>

						<form class="form-remove-user col-md-6" id="removeform">
							<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
							<h2 class="form-signin-heading">Remove Student From Group</h2>

							<label for="userToRemoveFromGroup" class="sr-only">Full name</label>
							<input type="text" id="userToRemoveFromGroup" class="form-control" placeholder="User name or email"
							required autofocus/>
							<input type="hidden" name="groupID" id="groupID" value="{$groupid}"/>
						</form>
					</div>
				</div/>
				<br/>

				{if sizeof($students) === 0}
				<div class="alert alert-info" role="alert">
					There are Students in Group.
				</div>
				{else}

				<h2>List of Students in Group </h2>
				<br/>

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
						{foreach $students as $student}
						<tr id="{$student.studentid}">
							<td>{$student.studentid}</td>
							<td>{$student.studentname}</td>
							<td>{$student.studentemail}</td>
							<td><a data-userid="{$student.studentid}" data-groupid="{$groupid}" data-bool="1" href="#" 
								data-toggle="modal"	data-target="#confirmationModal">Remove from Group</a></td>
							</tr>
							{/foreach}

							{/if}
							{/if}

							<div id="confirmationModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header text-center">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Are you sure?</h4>
										</div>
										<div class="modal-body text-center">
											<button type="button" id="yes" class="btn btn-success">Yes</button>
											<button type="button" id="no" class="btn btn-danger" data-dismiss="modal">No</button>
										</div>
									</div>
								</div>
							</div>

							<div id="confirmationModalGroup" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header text-center">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Are you sure?</h4>
										</div>
										<div class="modal-body text-center">
											<button type="button" id="yesGroup" class="btn btn-success">Yes</button>
											<button type="button" id="no" class="btn btn-danger" data-dismiss="modal">No</button>
										</div>
									</div>
								</div>
							</div>


						</div>
						<!-- /container -->
						{include file='common/footer.tpl'}
						<script src="{$BASE_URL}javascript/admin/manage_groups.js"></script>
						<script src="{$BASE_URL}javascript/jquery.jeditable.js"></script>
						<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>