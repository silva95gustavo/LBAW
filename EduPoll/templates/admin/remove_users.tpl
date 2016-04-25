{include file='common/header.tpl'}
{include file='common/menu.tpl'}

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

					<form class="form-change-password">
						<h2 class="form-signin-heading">Remove user</h2>
						
						<label for="inputUserToRemove" class="sr-only">Full name</label>
						<input type="text" id="inputUserToRemove" class="form-control" placeholder="User name or email" required autofocus>
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
							<tr>
								<td>1</td>
								<td>Pedro Mota</td>
								<td>pmota@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>2</td>
								<td>AntÃ³nio Moreira</td>
								<td>amoreira@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>3</td>
								<td>JoÃ£o Neves</td>
								<td>jneves@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>4</td>
								<td>Rita Esteves</td>
								<td>resteves@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>5</td>
								<td>Maria Costa</td>
								<td>mcosta@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>6</td>
								<td>Ricardo Carvalho</td>
								<td>rcarvalho@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
							<tr>
								<td>7</td>
								<td>MÃ¡rio Gomes</td>
								<td>mgomes@up.pt</td>
								<td><a href="#">Remove</a></td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}
