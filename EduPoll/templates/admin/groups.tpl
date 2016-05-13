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
					
					<h2>Group list:</h2>

					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Grupo "MIEIC-LBAW"</h3>
						</div>
							<button type="submit" class="btn btn-success" style="margin: 10px 10px 2px 30px;">Add member</button>
						<button type="button" class="btn btn-warning" style="margin: 10px 10px 2px 30px;">Rename</button>
						<button type="button" class="btn btn-danger" style="margin: 10px 10px 2px 30px;">Remove</button>
						<div class="panel-body">
							<h4 class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"
									role="button" aria-haspopup="true" aria-expanded="false">Members<span
									class="caret"></span></a>
							</h4>
							<table class="table table-striped" style="display: none;">
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
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>AntÃ³nio Moreira</td>
										<td>amoreira@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>JoÃ£o Neves</td>
										<td>jneves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Rita Esteves</td>
										<td>resteves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>5</td>
										<td>Maria Costa</td>
										<td>mcosta@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>6</td>
										<td>Ricardo Carvalho</td>
										<td>rcarvalho@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>7</td>
										<td>MÃ¡rio Gomes</td>
										<td>mgomes@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Grupo "MIEIC-SDIS"</h3>
						</div>
						<form class="form-rename">
							<label style="width: 80%;" for="inputName" class="sr-only">New group name</label> <input
								type="text" id="inputName" class="form-control"
								placeholder="New group name" required autofocus>
						</form>
							<button type="submit" class="btn btn-success" style="margin: 10px 10px 2px 30px;">Add member</button>
							<button type="submit" class="btn btn-warning" style="margin: 10px 10px 2px 30px;">Rename</button>
							<button type="button" class="btn btn-danger" style="margin: 10px 10px 2px 30px;">Remove</button>
						<div class="panel-body">
							<h4 class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"
									role="button" aria-haspopup="true" aria-expanded="false">Members<span
									class="caret"></span></a>
							</h4>
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
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>AntÃ³nio Moreira</td>
										<td>amoreira@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>JoÃ£o Neves</td>
										<td>jneves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Rita Esteves</td>
										<td>resteves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>5</td>
										<td>Maria Costa</td>
										<td>mcosta@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>6</td>
										<td>Ricardo Carvalho</td>
										<td>rcarvalho@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>7</td>
										<td>MÃ¡rio Gomes</td>
										<td>mgomes@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div class="last-element panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">Grupo "MIEIC-PPIN"</h3>
						</div>
						<form class="form-rename">
							<label style="width: 80%;" for="inputName" class="sr-only">New member name or email</label> <input
								type="text" id="inputName" class="form-control"
								placeholder="New member's name or email" required autofocus>
						</form>
							<button type="submit" class="btn btn-success" style="margin: 10px 10px 2px 30px;">Add member</button>
						<button type="button" class="btn btn-warning" style="margin: 10px 10px 2px 30px;">Rename</button>
						<button type="button" class="btn btn-danger" style="margin: 10px 10px 2px 30px;">Remove</button>
						<div class="panel-body">
							<h4 class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"
									role="button" aria-haspopup="true" aria-expanded="false">Members<span
									class="caret"></span></a>
							</h4>
							<table class="table table-striped" style="display: none;">
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
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>2</td>
										<td>AntÃ³nio Moreira</td>
										<td>amoreira@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>3</td>
										<td>JoÃ£o Neves</td>
										<td>jneves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Rita Esteves</td>
										<td>resteves@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>5</td>
										<td>Maria Costa</td>
										<td>mcosta@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>6</td>
										<td>Ricardo Carvalho</td>
										<td>rcarvalho@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
									<tr>
										<td>7</td>
										<td>MÃ¡rio Gomes</td>
										<td>mgomes@up.pt</td>
										<td><a href="#">Remove from group</a></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}
