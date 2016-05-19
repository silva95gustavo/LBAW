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
						<li class="active">Previous Exams</li>
					</ol>
					
					{if sizeof($exams) == 0}
						<div class="alert alert-info" role="alert">
        					There are no exams to be shown at the moment.
      					</div>
					{else}
						<div class="list-group">
						{for $examindex=0 to sizeof($exams) - 1}
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-10">
									<a href="results.php?id={$exams[$examindex]['id']}"><h4 class="list-group-item-heading">{$exams[$examindex]['name']}</h4></a>
									<datetime class="list-group-item-text">{$exams[$examindex]['starttime']} - {$exams[$examindex]['endtime']}</datetime>
								</div>

								<div class="col-md-2">
									<br/><p class="list-group-item-text">Grade: {$exams[$examindex]['finalscore']} / {$exams[$examindex]['maxscore']}</p>
								</div>
							</div>
						</div>
						{/for}
					</div>
					{/if}

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}