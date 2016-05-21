{include file='common/header.tpl'}
{include file='common/menu.tpl'}

	<div class="container-fluid">
		<div class="row">
			{include file='common/sidebar.tpl'}
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<div class="theme-showcase" role="main">
				
					{include file='common/result_messages.tpl'}
				
					<ol class="breadcrumb">
						<li class="active">Home</li>
					</ol>

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">Ongoing exams</h3>
						</div>
						{if (sizeof($Ongoingexams) === 0)}
						<div class="alert alert-info" role="alert">
        					You have no Ongoing Exams.
      					</div>
						{else}
						<div class="list-group">
					
						{foreach $Ongoingexams as $exam }
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-10">
									<a href="../../pages/exams/welcome.php?id={$exam.id}">
										<h4 class="list-group-item-heading">{$exam.name}</h4>
									</a>
									<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								</div>

								<div class="col-md-2">
									<br/><p class="list-group-item-text">{$exam.description}</p>
								</div>
							</div>
						</div>
						{/foreach}
					</div>
					{/if}
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Upcoming exams</h3>
						</div>
						{if (sizeof($Upcomingexams) === 0)}
						<div class="alert alert-info" role="alert">
        					You have no Upcoming Exams.
      					</div>
						{else}
						<div class="list-group">
					
						{foreach $Upcomingexams as $exam }
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-10">
									<a href="../../pages/exams/welcome.php?id={$exam.id}">
										<h4 class="list-group-item-heading">{$exam.name}</h4>
									</a>
									<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								</div>

								<div class="col-md-2">
									<br/><p class="list-group-item-text">{$exam.description}</p>
								</div>
							</div>
						</div>
						{/foreach}
					</div>
					{/if}
					<div class="last-element panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Future exams</h3>
						</div>
						{if (sizeof($Futureexams) === 0)}
						<div class="alert alert-info" role="alert">
        					You have no Future Exams.
      					</div>
						{else}
						<div class="list-group">
					
						{foreach $Futureexams as $exam}
						<div class="list-group-item">
							<div class="row">
								<div class="col-md-10">
									<a href="../../pages/exams/welcome.php?id={$exam.id}">
										<h4 class="list-group-item-heading">{$exam.name}</h4>
									</a>
									<datetime class="list-group-item-text">{$exam.starttime} - {$exam.endtime}</datetime>
								</div>

								<div class="col-md-2">
									<br/><p class="list-group-item-text">{$exam.description}</p>
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