	<!-- Fixed navbar -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{$BASE_URL}pages/users/main.php">EduPoll</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				{if isAdmin()}
					<li><a href="{$BASE_URL}pages/admin/add_users.php">Add users</a></li>
					<li><a href="{$BASE_URL}pages/admin/remove_users.php">Remove users</a></li>
					<li><a href="{$BASE_URL}pages/admin/groups.php">Manage groups</a></li>
					<li><a href="{$BASE_URL}actions/users/logout.php">Logout</a></li>
				{elseif isAcademic()}
					<li><a href="{$BASE_URL}pages/exams/exams_taken.php">Previous Exams</a></li>
					<li><a href="{$BASE_URL}pages/exams/create.php">Create Exam</a></li>
					<li><a href="{$BASE_URL}pages/exams/my_exams.php">My Exams</a></li>
					<li><a href="{$BASE_URL}actions/users/logout.php">Logout</a></li>
				{/if}
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>