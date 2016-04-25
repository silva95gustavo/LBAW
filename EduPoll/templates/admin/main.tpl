{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="container theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}

					<ol class="breadcrumb">
						<li class="active">Home</li>
					</ol>

					<a href="add_users.php"><button type="button" class="btn btn-lg btn-primary">Add users</button></a>
					<a href="remove_users.php"><button type="button" class="btn btn-lg btn-primary">Remove users</button></a>
					<a href="groups.php"><button type="button" class="btn btn-lg btn-primary">Manage groups</button></a>

					<div class="page-header">
						<h1>Statistics</h1>
					</div>

					<div class="row">
						<table class="table">
							<tbody>
								<tr>
									<td>1</td>
									<td>Number of registered users</td>
									<td>8012</td>
								</tr>
								<tr>
									<td>2</td>
									<td>Number of exams this week</td>
									<td>10</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Exams created during the last week</td>
									<td>2</td>
								</tr>
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}