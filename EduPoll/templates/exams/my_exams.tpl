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
						<li class="active">My Exams</li>
					</ol>
					
					{if (sizeof($exams) === 0)}
						<div class="alert alert-info" role="alert">
        					You do not own or manage any exam. <a href="{$BASE_URL}pages/exams/create.php">Create one now.</a>
      					</div>
					{else}
					<div class="list-group">
					
						{foreach $exams as $exam }
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-10">
									<a href="statistics.php"><h4 class="list-group-item-heading">{$exam.name}</h4></a>
									<datetime class="list-group-item-text">{$exam.startendtime}</datetime>
								</div>

								<div class="col-md-2">
									<br/><p class="list-group-item-text">{if isOwner($exam)}Owner{else}Manager{/if} <a href="edit.php?id={$exam.id}">(edit exam)</a></p>
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