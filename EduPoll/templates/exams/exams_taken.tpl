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
						{foreach $exams as $exam}
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-6">
									<a href="welcome.php?id={$exam.id}"><h4 class="list-group-item-heading">{$exam.name}</h4></a>
									<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								</div>

								<div class="col-md-6 text-right">
									{assign "score" getBestScore($userID,$exam.id) nocache}
									{if sizeof($score) != 0}
									<br/><p class="list-group-item-text">Grade: {$score} / {$exam.maxscore}</p>
									{else}
									<br/><p class="list-group-item-text">Grade: Not Attempted / {$exam.maxscore}</p>
									{/if}
								</div>
							</div>
						</div>
						{/foreach}
					</div>
					{/if}

				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}