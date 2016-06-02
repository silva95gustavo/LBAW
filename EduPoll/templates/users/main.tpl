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
						{if (sizeof($Ongoingexams) === 0)}
						<div class="panel-heading" >
							<h3 class="panel-title text-center">You have no Ongoing Exams.</h3>
						</div>
						{else}
						<div class="panel-heading text-center">
							<h3 class="panel-title">Ongoing Exams <h3>
						</div>
						<div class="list-group">

							{foreach $Ongoingexams as $exam}
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-9">
										<a href="../../pages/exams/welcome.php?id={$exam.id}">
											<h4 class="list-group-item-heading">{$exam.name}</h4>
										</a>
									</div>

									<div class="col-md-3">
										<datetime class="list-group-item-text pull-right">Start :{$exam.starttime}</datetime></p>
										<datetime class="list-group-item-text pull-right">End   :{$exam.endtime}</datetime>
									</div>
								</div>
							</div>
							{/foreach}
						</div>
						{/if}
					</div>
					<div class="panel panel-warning">
						{if (sizeof($Upcomingexams) === 0)}
						<div class="panel-heading">
							<h3 class="panel-title text-center">
							You have no Upcoming Exams.</h3>
						</div>
						{else}
						<div class="panel-heading text-center">
							<h3 class="panel-title">
							Upcoming Exams.</h3>
						</div>
						<div class="list-group">
							{foreach $Upcomingexams as $exam }
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-9">
										<a href="../../pages/exams/welcome.php?id={$exam.id}">
											<h4 class="list-group-item-heading">{$exam.name}</h4>
										</a>
									</div>

									<div class="col-md-3">
										<datetime class="list-group-item-text pull-right">Start :{$exam.starttime}</datetime></p>
										<datetime class="list-group-item-text pull-right">End   :{$exam.endtime}</datetime>
									</div>
								</div>
							</div>
							{/foreach}
						</div>
						{/if}
					</div>
					<div class="last-element panel panel-info">
						{if (sizeof($Futureexams) === 0)}
						<div class="panel-heading text-center">
							<h3 class="panel-title">
							You have no Future Exams.</h3>
						</div>
						{else}
						<div class="panel-heading text-center">
							<h3 class="panel-title">
							Future Exams.</h3>
						</div>
						<div class="list-group">
							{foreach $Futureexams as $exam}
							<div class="list-group-item">
								<div class="row">
									<div class="col-md-9">
										<a href="../../pages/exams/welcome.php?id={$exam.id}">
											<p class="list-group-item-heading h4" >{$exam.name}</p>
										</a>
									</div>

									<div class="col-md-3">
										<datetime class="list-group-item-text pull-right">Start :{$exam.starttime}</datetime></p>
										<datetime class="list-group-item-text pull-right">End   :{$exam.endtime}</datetime>
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