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
					<li class="active">Exam List at {$currentDay}/{$currentMonth}/{$currentYear}</li>
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
							{if $exam.type == 0}
							<div class="col-md-12">
								<a href="welcome.php?id={$exam.id}"><h4 class="list-group-item-heading">{$exam.name}</h4></a>
							</div>

							<div class="col-md-12 ">
								<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								{assign "score" getBestScore($userID,$exam.id) nocache}
									{if sizeof($score) != 0}
									<p class="list-group-item-text pull-right">Grade: {$score} / {$exam.maxscore}</p>
									{else}
									<p class="list-group-item-text pull-right">Grade: Not Attempted / {$exam.maxscore}</p>
									{/if}
							</div>
							{else}
							<div class="col-md-12">
								<a href="statistics.php?examid={$exam.id}"><h4 class="list-group-item-heading">{$exam.name}</h4></a>
							</div>

							<div class="col-md-12">
								<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								<p class="list-group-item-text pull-right">{if $exam.type == 1}Owner{else}Manager{/if} <a href="edit.php?id={$exam.id}">(edit exam)</a></p>
							</div>
							{/if}
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