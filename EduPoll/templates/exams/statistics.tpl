{include file='common/header.tpl'}
{include file='common/menu.tpl'}

<div class="container-fluid">
	<div class="row">
		{include file='common/sidebar.tpl'}
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="theme-showcase" role="main">
				
				{include file='common/result_messages.tpl'}

				<ol class="breadcrumb">
					<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
					<li><a href="my_exams.php">My Exams</a></li>
					<li class="active">Exam statistics</li>
				</ol>

				<div class="jumbotron">
					<div class="text-center">
						<h1>{$exam['name']}</h1>
					</div>
					<p><strong>Start: </strong>{$exam['starttime']}</p>
					{if isset($exam['endtime'])}
					<p><strong>End: </strong>{$exam['endtime']}</p>
					{else}
					<p><strong>End: </strong>Until the owner closes the exam</p>
					{/if}
				</div>
				
				{if $stats['attempts'] === 0}
				<div class="alert alert-warning" role="alert">
					<strong>Warning!</strong> No attempts have been made for this exam.
				</div>
				{else}
				<div id="grade_distribution" style="display: none;">
					{foreach from=$gradedistribution key=k item=i}
					<div id="grade{$k}">{$i}</div>
					{/foreach}
				</div>


				<div class="row text-center">
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Number of Submitted Exams</strong>
							</div>
							<div id="exam_submitted_no" class="panel-body">{$stats['attempts']}</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Number of Approved Exams</strong>
							</div>
							<div id="exam_approved_no" class="panel-body">{$stats['approved']}</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<strong>Average Score</strong>
							</div>
							<div class="panel-body">{(float)$stats['averagegrade']}</div>
						</div>
					</div>
				</div>

				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#questions">Questions Summary</a></li>
					<li><a data-toggle="tab" href="#students">Students Summary</a></li>
					<li><a id="AStab" data-toggle="tab" href="#AS">Approved Students</a></li>
					<li><a id="GDtab" data-toggle="tab" href="#GD">Grades Distribution</a></li>
					<li><a data-toggle="tab" href="#downloads">Export Statistics</a></li>
				</ul>

				<div class="tab-content">
					<div id="questions" class="tab-pane fade in active">
						<h3>Questions Summary</h3>
						<div id="questions-stats" class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Question</th>
										<th>Number of Answer Attempts</th>
										<th>Average Score</th>
									</tr>
								</thead>
								<tbody>
									{foreach from=$questionstats item=statline}
									<tr>
										<td>{$statline['statement']}</td>
										<td>{$statline['answers']}</td>
										{if $statline['score'] !== "-"}
										<td>{(float)$statline['score']}</td>
										{else}
										<td>-</td>
										{/if}
									</tr>
									{/foreach}
								</tbody>
							</table>
						</div>
					</div>
					<div id="students" class="tab-pane fade">
						<h3>Students Summary</h3>
						<div id="students-stats" class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Name</th>
										<th>Grade</th>
									</tr>
								</thead>
								<tbody>
									{foreach from=$studentstats item=statline}
									<tr>
										<td>{$statline['username']}</td>
										<td>{$statline['finalscore']}</td>
									</tr>
									{/foreach}
								</tbody>
							</table>
						</div>
					</div>
					<div id="AS" class="tab-pane fade text-center">
						<h3>Approved Students</h3>
						<canvas id="AScanvas" width="600" height="350"></canvas>
					</div>
					<div id="GD" class="tab-pane fade text-center">
						<h3>Grades Distribution</h3>
						<canvas id="GDcanvas" width="600" height="350"></canvas>
					</div>
					<div id="downloads" class="tab-pane fade">
						<h3>Export Statistics</h3>
						<div class="jumbotron">
							<div class="row">
								<div class="col-md-4"><button class="btn-primary btn-lg">Export PDF</button></div>
								<div class="col-md-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet ornare aliquet. Maecenas interdum lacus enim, vel ultrices est pulvinar vel. Sed vitae interdum nibh. Curabitur et justo ullamcorper, ullamcorper leo vel, imperdiet dolor. Proin egestas nisl in porttitor convallis. Proin maximus tempor elit, in semper eros mollis in. Donec lobortis magna ut massa feugiat, eu porta nulla sollicitudin. Donec lobortis iaculis felis at tempus. Quisque ac lectus libero. Nulla diam turpis, mollis vitae dapibus et, facilisis vitae erat. In pellentesque, sapien ac sagittis consectetur, erat ante egestas purus, id scelerisque mauris nibh eget tortor. Nunc pretium mauris eros, quis consequat ipsum convallis a. In sodales congue felis, eget elementum mauris finibus euismod. Nunc vitae fermentum lacus. Morbi tempor neque non tortor rutrum malesuada. Integer bibendum risus elementum nulla viverra, vitae imperdiet urna pharetra.</div>
							</div>

						</div>
						<div class="jumbotron">
							<div class="row">
								<div class="row">
									<div class="col-md-4"><button class="btn-primary btn-lg">Export CLS</button></div>
									<div class="col-md-8">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse ac mi ex. Suspendisse elit risus, dictum sit amet turpis quis, imperdiet venenatis risus. Etiam quis velit augue. In cursus luctus eros, id blandit lacus aliquet sit amet. Fusce ut sapien eget lectus feugiat aliquet vel in ligula. Nulla maximus sed arcu vitae tristique.</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				{/if}
				<div class="container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" class="tab" data-id="groups-assigned-tab" href="#groups-assigned">Groups Assigned</a></li>
						<li><a data-toggle="tab" class="tab" data-id="users-assigned-tab" href="#users-assigned">Individual Users Assigned</a></li>
						<li><a data-toggle="tab" class="tab" data-id="assign-group-tab" href="#assign-group">Assign New Group</a></li>
						<li><a data-toggle="tab" class="tab" data-id="assign-user-tab" href="#assign-user">Assign New User</a></li>
					</ul>

					<div class="tab-content">
						<div id="groups-assigned" class="tab-pane fade in active">
							<table class="table table-striped" id="groups-assigned-table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Remove</th>
									</tr>
								</thead>
								<tbody>
									{foreach $groupsAssigned as $group}
									<tr id="removegroup{$group.id}">
										<td>{$group.id}</td>
										<td>{$group.name}</td>
										<td><button type="button" class="btn btn-danger idSubmition" data-id="{$group.id}" data-toggle="modal" data-target="#confirmationModal">Remove</td>
									</tr>
									{/foreach}
								</tbody>
							</table>
						</div>
						<div id="users-assigned" class="tab-pane fade">
							<div class="tab-pane fade in active">
								<form class="form-remove-user">
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
									<h2 class="form-signin-heading">Remove user</h2>

									<label for="inputUserToRemove" class="sr-only">Full name</label>
									<input type="text" id="inputUserToRemove" class="form-control" placeholder="User name or email"
									required autofocus>
									<br/>
								</form>
								<table class="table table-striped" id="users-assigned-table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Add</th>
										</tr>
									</thead>
									<tbody>
										{foreach $studentsAssigned as $student}
										<tr id="removestudent{$student.id}">
											<td>{$student.id}</td>
											<td>{$student.name}</td>
											<td>{$student.email}</td>
											<td><button type="button" class="btn btn-danger idSubmition" data-id="{$student.id}" data-toggle="modal" data-target="#confirmationModal">Remove</td>
										</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
						<div id="assign-group" class="tab-pane fade">
							<div class="tab-pane fade in active">
								<table class="table table-striped" id="assign-group-table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Add</th>
										</tr>
									</thead>
									<tbody>
										{foreach $groupsNotAssigned as $group}
										<tr id="addgroup{$group.id}">
											<td>{$group.id}</td>
											<td>{$group.name}</td>
											<td><button type="button" class="btn btn-success idSubmition"  data-id="{$group.id}"data-toggle="modal" data-target="#confirmationModal">Add</td>
										</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
						<div id="assign-user" class="tab-pane fade">
							<div class="tab-pane fade in active">
								<form class="form-add-user">
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
									<h2 class="form-signin-heading">Add user</h2>

									<label for="inputUserToAdd" class="sr-only">Full name</label>
									<input type="text" id="inputUserToAdd" class="form-control" placeholder="User name or email"
									required autofocus>
									<br/>
								</form>
								<table class="table table-striped" id="assign-user-table">
									<thead>
										<tr>
											<th>ID</th>
											<th>Name</th>
											<th>Email</th>
											<th>Add</th>
										</tr>
									</thead>
									<tbody>
										{foreach $studentsNotAssigned as $student}
										<tr id="addstudent{$student.id}">
											<td>{$student.id}</td>
											<td>{$student.name}</td>
											<td>{$student.email}</td>
											<td><button type="button" class="btn btn-success idSubmition" data-id="{$student.id}" data-toggle="modal" data-target="#confirmationModal">Add</td>
										</tr>
										{/foreach}
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

				<div id="confirmationModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header text-center">
								<button type="button" class="close"  data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Are you sure to apply this change?</h4>
							</div>
							<div class="modal-body text-center">
								<button data-id="{$exam.id}" type="button" id="yes" class="btn btn-success">Yes</button>
								<button type="button" id="no" class="btn btn-danger" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{if $examOver === 1 }
<script src="{$BASE_URL}frameworks/Chart.js"></script>
<script src="{$BASE_URL}javascript/exams/exam-statistics-after.js"></script>
{else}
<script src="{$BASE_URL}javascript/exams/exam-statistics-previous.js"></script><script src="{$BASE_URL}javascript/jquery.jeditable.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw=" crossorigin="anonymous"></script>
{/if}
{include file='common/footer.tpl'}