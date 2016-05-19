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
						<p>You do not have any Ongoing exams.</p>
						{else}
						<div class="list-group">
							{foreach $Ongoingexams as $Ongoing }
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-10">
										<a href="statistics.php"><h4 class="list-group-item-heading">{$Ongoing.name}</h4></a>
										<datetime class="list-group-item-text">{$Ongoing.starttime} - {$Ongoing.endtime}</datetime>
									</div>

									<div class="col-md-2">
										<br/><p class="list-group-item-text">{$Ongoing.description}</p>
									</div>
								</div>
							</div>
							{/foreach}
						</div>
						{/if}
					</div>
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">Upcoming exams</h3>
						</div>
						{if (sizeof($Upcomingexams) === 0)}
						<p>You do not have any Upcoming exams.</p>
						{else}
						<div class="list-group">
							{foreach $Upcomingexams as $Upcoming }
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-10">
										<a href="statistics.php"><h4 class="list-group-item-heading">{$Upcoming.name}</h4></a>
										<datetime class="list-group-item-text">{$Upcoming.starttime} - {$Upcoming.endtime}</datetime>
									</div>

									<div class="col-md-2">
										<br/><p class="list-group-item-text">{$Upcoming.description}</p>
									</div>
								</div>
							</div>
							{/foreach}
						</div>
						{/if}
					</div>
					<div class="last-element panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">Future exams</h3>
						</div>
						{if (sizeof($Futureexams) === 0)}
						<p>You do not have any Future exams.</p>
						{else}
						<div class="list-group">
							{foreach $Futureexams as $Future }
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-10">
										<a href="statistics.php"><h4 class="list-group-item-heading">{$Future.name}</h4></a>
										<datetime class="list-group-item-text">{$Future.starttime} - {$Future.endtime}</datetime>
									</div>

									<div class="col-md-2">
										<br/><p class="list-group-item-text">{$Future.description}</p>
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


	</div>
	<!-- /container -->

{include file='common/footer.tpl'}