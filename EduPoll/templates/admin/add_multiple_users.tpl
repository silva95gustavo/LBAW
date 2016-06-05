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
					<li><a href="add_users.php">Add Users</a></li>
					<li class="active">Add Multiple Users</li>
				</ol>

				<div class="page-header">
					<h1>Import file</h1>
				</div>

				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Select the file with the users'
							information</h3>
						</div>
						<div class="panel-body">
							<form class="form-importfile" action="../../actions/admin/add_multiple_users.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
								<input type="file" name="json_file" id="json_file">
								<br/><button type="submit" name="json_file" class="btn btn-primary">Submit</button>
							</form>
						</div>
					</div>
					
					<br/><br/><h3>The specified file must match the following JSON format:</h3>

					<div class="last-element well">
						<div>
							{literal}
							{ <br/>
							<div class="json-printing">
							"students": [<br/>
						<div class="json-printing">
							{<br/>
							<div class="json-printing">
							"name": "Andre Vieira de Castro",<br/>
							"email": "andre_castro@fe.up.pt",<br/>
							"gender": 1<br/>
							</div>
						},<br/>
						{<br/>
						<div class="json-printing">
						"name": "Guilhermina Rocha e Silva",<br/>
						"email": "gigablue@fe.up.pt",<br/>
						"gender": 0<br/>
						</div>
					}<br/></div>
					],</div>
						<div class="json-printing">
					"teachers": [<br/>
						<div class="json-printing">
					{<br/>
						<div class="json-printing">
					"name": "Sérgio Boldt Lopes",<br/>
					"email": "novoProfessor@fe.up.pt",<br/>
					"gender": 1<br/>
				</div>
				}<br/></div>
				],</div>
						<div class="json-printing">
				"categories": [<br/>
						<div class="json-printing">
				{<br/>
				"name": "mieic13",<br/>
				"users": [<br/>
						<div class="json-printing">
				"andre_castro@fe.up.pt",<br/>
				"gigablue@fe.up.pt"<br/>
				]<br/>
			</div>
			}
			</div>
			]
			</div>
		</div>}
		{/literal}</div>
	</div>

</div>
</div>
</div>






</div>
<!-- /container -->

{include file='common/footer.tpl'}