{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div style="display: none;" class="exam-id" examid={$exam.id}></div>
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
					
					<div id="confirmationModalAddManager" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure to add this user as manager?</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes_manager" class="btn btn-success">Yes</button>
									<button type="button" id="no_manager" class="btn btn-danger" data-dismiss="modal">No</button>
								</div>
							</div>
						</div>
					</div>
					
					<div id="confirmationModalRemoveManager" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure you want to remove this manager?</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes_rem_manager" class="btn btn-success">Yes</button>
									<button type="button" id="no_rem_manager" class="btn btn-danger" data-dismiss="modal">No</button>
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
					
					<div id="modalCreateQuestion" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Create question</h4>
								</div>
								<div class="modal-body">
									<form action="{$BASE_URL}actions/exams/create_question.php" method="post" id="createQuestion">
										<label>Question statement: </label>
										<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
										<input type="hidden" name="examid" value="{$exam.id}" />
										<input type="text" name="statement" class="form-control">
										<div class="modal-body text-center">
											<button type="submit" id="yes_create_question" class="btn btn-success" data-examid="{$exam.id}">Create</button>
											<button type="button" id="no_create_question" class="btn btn-danger" data-dismiss="modal">Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					
					<div id="confirmationModalDeleteCategory" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure you want to delete this category? All questions inside it will be deleted as well.</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes_delete_category" class="btn btn-success">Yes</button>
									<button type="button" id="no_delete_category" class="btn btn-danger" data-dismiss="modal">No</button>
								</div>
							</div>
						</div>
					</div>
					
					<div id="confirmationModalDeleteQuestion" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure you want to delete this question?</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes_delete_question" class="btn btn-success">Yes</button>
									<button type="button" id="no_delete_question" class="btn btn-danger" data-dismiss="modal">No</button>
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
									<h3 class="inline-editable exam-description" name="description" data-id="{$exam.id}">{$exam.description|escape:'html'|nl2br}</h3>
								</div>
							</div>
						</div>
						
  						<div id="demo" class="collapse">
  							{if $isOwner}
  								<form class="form-add-manager">
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />

									<input type="text" id="inputUserToAdd" class="form-control" placeholder="User name or email"
										required autofocus>
								</form>
								<br/>
  							{/if}
  							<ul class="list-group">
  								{if $isOwner}  								
  									{if sizeof($managers) == 0}
  										<li class="list-group-item">There are no managers for this exam</li>
  									{else}
  										{for $manager=0 to sizeof($managers)-1}
  											<a href="#" class="list-group-item removable_manager" managerid={$managers[$manager]['id']}>{$managers[$manager]['name']|escape:'html'}</a>
  										{/for}
  									{/if}
  								{else}
  									<li class="list-group-item">{$owner['name']|escape:'html'} (owner)</li>
  									{for $manager=0 to sizeof($managers)-1}
  										<li class="list-group-item">{$managers[$manager]['name']|escape:'html'}</li>
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
	
						{foreach $examElements as $examElement}
							{if $examElement.type == 'category'}
							<div class="panel panel-info">
								<div class="panel-heading">
									<div class="row">
										<div class="col-md-6"><strong class="inline-editable category-name" data-id="{$examElement.id}">{$examElement.name|escape:'html'}</strong></div>
										<div class="col-md-6 text-right">
											<span class="icon-clickable">
												<i class="fa fa-plus" data-categoryid="{$examElement.id}" data-toggle="modal" data-target="#modalCreateQuestion"></i>
											</span>
											<span class="icon-clickable">
												<i class="fa fa-trash-o" data-categoryid="{$examElement.id}" data-toggle="modal" data-target="#confirmationModalDeleteCategory"></i>
											</span>
										</div>
									</div>
								</div>
								
								{foreach $examElement.questions as $question}
									{include file='exams/question.tpl'}
								{/foreach}
								
							</div>
							{else if $examElement.type == 'question'}
								{assign question $examElement}
								{include file='exams/question.tpl'}
							{/if}
						{/foreach}
						
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
					</div>					
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
	<script src="{$BASE_URL}javascript/jquery.jeditable.js"></script>
	<script src="{$BASE_URL}javascript/exams/edit.js"></script>
{include file='common/footer.tpl'}