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
				{if $invited}
				<a class="navbar-brand" href="#">EduPoll</a>
				{elseif isAdmin()}
				<a class="navbar-brand" href="{$BASE_URL}pages/admin/main.php">EduPoll</a>
				{elseif isAcademic()}
				<a class="navbar-brand" href="{$BASE_URL}pages/users/main.php">EduPoll</a>
				{/if}
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				{if $invited}
				{elseif isAdmin()}
					<li><a href="{$BASE_URL}pages/admin/add_users.php">Add users</a></li>
					<li><a href="{$BASE_URL}pages/admin/remove_users.php">Remove users</a></li>
					<li><a href="{$BASE_URL}pages/admin/groups.php">Manage groups</a></li>
					<li><a href="{$BASE_URL}pages/users/edit_profile.php">Edit profile</a></li>
					<li><a href="{$BASE_URL}actions/auth/logout.php">Logout</a></li>
				{elseif isAcademic()}
					<li><a href="{$BASE_URL}pages/exams/exams_taken.php">Previous Exams</a></li>
					<li><a href="{$BASE_URL}pages/exams/create.php">Create Exam</a></li>
					<li><a href="{$BASE_URL}pages/exams/my_exams.php">My Exams</a></li>
					<li><a href="{$BASE_URL}pages/users/edit_profile.php">Edit profile</a></li>
					<li><a href="{$BASE_URL}actions/auth/logout.php">Logout</a></li>
				{/if}
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>