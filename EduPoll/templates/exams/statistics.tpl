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
						<li class="active">Exam statistics</li>
					</ol>

					<div class="jumbotron">
						<h1>{$exam['name']}</h1>
						{if isset($exam['endtime'])}
							<p>{$exam['starttime']} - {$exam['endtime']} </p>
						{else}
							<p>{$exam['starttime']} - Until manager closes the exam </p>
						{/if}
					</div>
					
					{if $stats['attempts'] === 0}
						<div class="alert alert-warning" role="alert">
        					<strong>Warning!</strong> No attempts have been made for this exam.
      					</div>
					{else}
						<div id="grade_distribution" style="display: none;">
							{foreach from=$gradedistribution key=k item=i}
								<div id="grade{$k}">{$i}</div>
							{/foreach}
						</div>
					
					
						<div class="row text-center">
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Number of Submitted Exams</strong>
									</div>
									<div id="exam_submitted_no" class="panel-body">{$stats['attempts']}</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Number of Approved Exams</strong>
									</div>
									<div id="exam_approved_no" class="panel-body">{$stats['approved']}</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="panel panel-default">
									<div class="panel-heading">
										<strong>Average Score</strong>
									</div>
									<div class="panel-body">{(float)$stats['averagegrade']}</div>
								</div>
							</div>
						</div>

						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#questions">Questions Summary</a></li>
							<li><a data-toggle="tab" href="#students">Students Summary</a></li>
							<li><a id="AStab" data-toggle="tab" href="#AS">Approved Students</a></li>
							<li><a id="GDtab" data-toggle="tab" href="#GD">Grades Distribution</a></li>
							<li><a data-toggle="tab" href="#downloads">Export Statistics</a></li>
						</ul>

						<div class="tab-content">
							<div id="questions" class="tab-pane fade in active">
								<h3>Questions Summary</h3>
								<div id="questions-stats" class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Question</th>
												<th>Number of Answer Attempts</th>
												<th>Average Score</th>
											</tr>
										</thead>
										<tbody>
											{foreach from=$questionstats item=statline}
											<tr>
												<td>{$statline['statement']}</td>
												<td>{$statline['answers']}</td>
												{if $statline['score'] !== "-"}
													<td>{(float)$statline['score']}</td>
												{else}
													<td>-</td>
												{/if}
											</tr>
											{/foreach}
										</tbody>
									</table>
								</div>
							</div>
							<div id="students" class="tab-pane fade">
								<h3>Students Summary</h3>
								<div id="students-stats" class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Name</th>
												<th>Grade</th>
											</tr>
										</thead>
										<tbody>
											{foreach from=$studentstats item=statline}
												<tr>
													<td>{$statline['username']}</td>
													<td>{$statline['finalscore']}</td>
												</tr>
											{/foreach}
										</tbody>
									</table>
								</div>
							</div>
							<div id="AS" class="tab-pane fade text-center">
								<h3>Approved Students</h3>
									<canvas id="AScanvas" width="600" height="350"></canvas>
							</div>
							<div id="GD" class="tab-pane fade text-center">
								<h3>Grades Distribution</h3>
									<canvas id="GDcanvas" width="600" height="350"></canvas>
							</div>
							<div id="downloads" class="tab-pane fade">
								<h3>Export Statistics</h3>
									<div class="jumbotron">
										<div class="row">
											<div class="col-md-4"><button class="btn-primary btn-lg">Export PDF</button></div>
											<div class="col-md-8">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet ornare aliquet. Maecenas interdum lacus enim, vel ultrices est pulvinar vel. Sed vitae interdum nibh. Curabitur et justo ullamcorper, ullamcorper leo vel, imperdiet dolor. Proin egestas nisl in porttitor convallis. Proin maximus tempor elit, in semper eros mollis in. Donec lobortis magna ut massa feugiat, eu porta nulla sollicitudin. Donec lobortis iaculis felis at tempus. Quisque ac lectus libero. Nulla diam turpis, mollis vitae dapibus et, facilisis vitae erat. In pellentesque, sapien ac sagittis consectetur, erat ante egestas purus, id scelerisque mauris nibh eget tortor. Nunc pretium mauris eros, quis consequat ipsum convallis a. In sodales congue felis, eget elementum mauris finibus euismod. Nunc vitae fermentum lacus. Morbi tempor neque non tortor rutrum malesuada. Integer bibendum risus elementum nulla viverra, vitae imperdiet urna pharetra.</div>
										</div>
									
									</div>
									<div class="jumbotron">
										<div class="row">
											<div class="row">
												<div class="col-md-4"><button class="btn-primary btn-lg">Export CLS</button></div>
												<div class="col-md-8">Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Suspendisse ac mi ex. Suspendisse elit risus, dictum sit amet turpis quis, imperdiet venenatis risus. Etiam quis velit augue. In cursus luctus eros, id blandit lacus aliquet sit amet. Fusce ut sapien eget lectus feugiat aliquet vel in ligula. Nulla maximus sed arcu vitae tristique.</div>
											</div>
										</div>
										
									</div>
							</div>
						</div>
					{/if}


				</div>
			</div>
		</div>
	</div>

	<script src="{$BASE_URL}frameworks/Chart.js"></script>
	<script src="{$BASE_URL}javascript/exam-statistics.js"></script>
{include file='common/footer.tpl'}