{include file='common/header.tpl'}
{include file='common/menu.tpl'}

<div class="container-fluid">
	<div class="row">
		{include file='common/sidebar.tpl'}
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<div class="theme-showcase" role="main">
				
				{include file='common/result_messages.tpl'}
				
				<div style="display: none;" id="base_url_start">{$BASE_URL}</div>

				<ol class="breadcrumb">
					<li><a href="{$BASE_URL}pages/users/main.php">Home</a></li>
					<li><a href="my_exams.php">My Exams</a></li>
					<li class="active">Exam statistics</li>
				</ol>

				<div class="jumbotron">
					<div class="text-center">
						<h1>{$exam['name']}</h1>
					</div>
					<p><strong>Start: </strong>{$exam['starttime']}</p>
					{if isset($exam['endtime'])}
					<p><strong>End: </strong>{$exam['endtime']}</p>
					{else}
					<p><strong>End: </strong>Until the owner closes the exam</p>
					{/if}
				</div>
	
				{if $exam.opentopublic && $examOver != 1}
				<div class="container-fluid">
					<input type="hidden" id="csrf_token" value="{$CSRF_TOKEN}" />
					<button class="btn btn-lg btn-info col-md-2" id="generateLink" data-id="{$exam.id}">Generate Guest Link</button>
					<input type="text" class="input-lg col-md-8" id="generatedLink" disabled>
					<span class="input-group-btn">
                  		<button class="btn btn-lg btn-default" id="copy" type="button" style="box-shadow: 0 3px 0 0 #888888; border-radius: 20px;">Copy</button>
               		</span>
               		<label><strong>Share grade with Exam Takers:</strong></label>
					<input id="share" class="shareButton" type="checkbox" name="share" data-id="{$exam.id}" data-on-text="Share" data-off-text="Private" checked>
				</div>
				<br>
				{/if}	

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
				{/if}


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
								<div class="col-md-2">
									<form action="{$BASE_URL}pages/exams/export_statistics.php" method="get">
										<input type="hidden" name="examid" value="{$exam.id}"/>
										<input type="hidden" name="format" value="XLS"/>
    									<input class="btn btn-lg btn-primary btn-block" type="submit" value="Export XLS" />
									</form>
								</div>
								<div class="col-md-10">
									Export the exam results to a ".XLS" file, so that you can consult them using Microsoft Office Excel.
									<br/>
									This allows you to easily perform calculations and custom statistics for your exams, by using
									the functionalities provided Excel. Some examples are averages, charts and standard deviations.
								</div>
							</div>
								<br/><br/>
							<div class="row">
								<div class="col-md-2">
									<form action="{$BASE_URL}pages/exams/export_statistics.php" method="get">
										<input type="hidden" name="examid" value="{$exam.id}"/>
										<input type="hidden" name="format" value="JSON"/>
    									<input class="btn btn-lg btn-primary btn-block" type="submit" value="Export JSON" />
									</form>
								</div>
								<div class="col-md-10">
									Export the exam results to a ".json" file, so that you can consult them using JSON parsing tools.
									<br/>
									This format is useful if you want data to be parsed by other tools rather than Excel, for example for
									computation with data analysis software or similar applications.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script type="text/javascript" src="{$BASE_URL}frameworks/bootstrap-switch.min.js"></script>	
<script type="text/javascript" src="{$BASE_URL}frameworks/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{$BASE_URL}frameworks/en-gb.js"></script>
<script src="{$BASE_URL}frameworks/Chart.js"></script>
<script src="{$BASE_URL}javascript/exams/exam-statistics.js"></script>
{include file='common/footer.tpl'}
