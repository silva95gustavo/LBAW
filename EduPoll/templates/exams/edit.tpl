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
						<li class="active">Edit Exam</li>
					</ol>

					<!-- Trigger the modal with a button -->

					<!-- Modal -->
					<div id="myModal" class="modal fade" role="dialog">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"><strong>Create/Edit Question</strong></h4>
								</div>
								<div class="modal-body">
									<p><strong>Category: </strong> Category A</p>
									<label><strong>Question:</strong></label>
									<input type="text" class="form-control">
									<form>
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 1</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 2</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 3</label>
										</div>
										<input type="text" class="form-control">
										
										<div class="radio">
											<label><input type="radio" name="optradio1">Option 4</label>
										</div>
										<input type="text" class="form-control">
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>
					
					<div id="confirmationModal" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure to delete this exam?</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes" class="btn btn-success">Yes</button>
									<button type="button" id="no" class="btn btn-danger" data-dismiss="modal">No</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="exam" id="exam{$exam.id}">

						<div class="jumbotron">
							<div class="row">
								<div class="exam-name-container">
									<h2 class="inline-editable exam-name" name="name" data-id="{$exam.id}">{$exam.name|escape:'html'}</h2>
								</div>
								<div class="exam-description-container">
									<h3 class="inline-editable exam-description" name="description" data-id="{$exam.id}">{$exam.description|escape:'html'|nl2br}</h2>
								</div>
							</div>
						</div>
						
  						<div id="demo" class="collapse">
  							{if $isOwner}
  								<form class="form-remove-user">
  									<input type="text" id="inputUserToRemove" class="form-control" placeholder="Inser user name or email of manager to add" required autofocus>
  									<br/>
  								</form>
  							{/if}
  							<ul class="list-group">
  								{if $isOwner}  								
  									{if sizeof($managers) == 0}
  										<li class="list-group-item">There are no managers for this exam</li>
  									{else}
  										{for $manager=0 to sizeof($managers)-1}
  											<a href="#" class="list-group-item">{$managers[$manager]['name']}</a>
  										{/for}
  									{/if}
  								{else}
  									<li class="list-group-item">{$owner['name']} (owner)</li>
  									{for $manager=0 to sizeof($managers)-1}
  										<li class="list-group-item">{$managers[$manager]['name']}</li>
  									{/for}
  								{/if}
          					</ul>
  						</div>
						<a href="#demo" class="btn btn-info show-managers" data-toggle="collapse">Show/hide managers</a>
	
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<div class="row">
									<div class="col-sm-3">
										<button type="button" class="btn btn-info">Add New Category</button>
									</div>
									<div class="col-sm-3">
										<button type="button" class="btn btn-success">Save Changes</button>
									</div>
									<div class="col-sm-3">
										<button type="button" class="btn btn-danger">Cancel Changes</button>
									</div>	
									{if $isOwner}
									<div class="col-sm-3">
										<button type="submit" class="btn btn-danger" data-id="{$exam.id}" data-toggle="modal" data-target="#confirmationModal">Delete exam</button>
									</div>
									{/if}
								</div>
							</div>
						</div>
	
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-6"><strong>Category A</strong></div>
									<div class="col-md-6 text-right">
										<i class="fa fa-plus"></i>
										<i class="fa fa-pencil"></i>
										<i class="fa fa-trash-o"></i>
									</div>
								</div>
							</div>
							
							<div class="panel-body">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">Question A1</div>
											<div class="col-md-6 text-right">
												<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<p><strong>Question: </strong>First question. Select the correct option:</p>
										<form>
											<div class="radio disabled">
												<label><input type="radio" name="optradio1" checked="checked">Option 1</label>
											</div>
											<div class="radio disabled">
												<label><input type="radio" name="optradio1" disabled>Option 2</label>
											</div>
											<div class="radio disabled">
												<label><input type="radio" name="optradio1" disabled>Option 3</label>
											</div>
											<div class="radio disabled">
												<label><input type="radio" name="optradio1" disabled>Option 4</label>
											</div>
										</form>
									</div>
								</div>
							</div>
							
							<div class="panel-body">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">Question A2</div>
											<div class="col-md-6 text-right">
												<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<p><strong>Question: </strong>Second question. Select the correct option:</p>
										<div class="radio disabled">
											<label><input type="radio" name="optradio2" disabled>Option 1</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio2" checked="checked">Option 2</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio2" disabled>Option 3</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio2" disabled>Option 4</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="panel panel-info">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-6"><strong>Category B</strong></div>
									<div class="col-md-6 text-right">
										<i class="fa fa-plus"></i>
										<i class="fa fa-pencil"></i>
										<i class="fa fa-trash-o"></i>
									</div>
								</div>
							</div>
							
							<div class="panel-body">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">Question B1</div>
											<div class="col-md-6 text-right">
												<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<p><strong>Question: </strong>First question. Select the correct option:</p>
										<div class="radio disabled">
											<label><input type="radio" name="optradio3" checked="checked">Option 1</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio3" disabled>Option 2</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio3" disabled>Option 3</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio3" disabled>Option 4</label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel-body">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">Question B2</div>
											<div class="col-md-6 text-right">
												<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<p><strong>Question: </strong>Second question. Select the correct option:</p>
										<div class="radio disabled">
											<label><input type="radio" name="optradio4" disabled>Option 1</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio4" disabled>Option 2</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio4" checked="checked">Option 3</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio4" disabled>Option 4</label>
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel-body">
								<div class="panel panel-primary">
									<div class="panel-heading">
										<div class="row">
											<div class="col-md-6">Question B3</div>
											<div class="col-md-6 text-right">
												<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<p><strong>Question: </strong>Third question. Select the correct option:</p>
										<div class="radio disabled">
											<label><input type="radio" name="optradio5" disabled>Option 1</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio5" disabled>Option 2</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio5" checked="checked">Option 3</label>
										</div>
										<div class="radio disabled">
											<label><input type="radio" name="optradio5" disabled>Option 4</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default text-center">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-4">
										<button type="button" class="btn btn-info">Add New Category</button>
									</div>
									<div class="col-md-4">
										<button type="button" class="btn btn-success">Save Changes</button>
									</div>
									<div class="col-md-4">
										<button type="button" class="btn btn-danger">Cancel Changes</button>
									</div>	
								</div>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
	<script src="{$BASE_URL}javascript/exams/edit.js"></script>
{include file='common/footer.tpl'}