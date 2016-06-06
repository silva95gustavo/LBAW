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
						<li class="active">Exam</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h1 class="text-center">{$exam.name}</h1>
						<div>
							<p><strong>Start:</strong> {$exam.starttime} 
							{if isset($exam['endtime'])}
							<p><strong>End: </strong>{$exam['endtime']}</p>
							{else}
							<p><strong>End: </strong>Until the owner closes the exam</p>
							{/if}
							<p><strong>Attempts:</strong> {$exam.maxtries}</p>
						</div>
					</div>

					<div class="panel panel-info">
  						<div class="panel-heading text-center"><h3>Exam Information</h3></div>
  						<div class="panel-body"><h5>{$exam.description}<h5></div>
					</div>
					{if $examStatus == 1}
						{if !$exam.opentopublic}
							{assign var="attempts" value=getAttempts($userID,$examID)}
							{if sizeof($attempts) != 0}
							{foreach $attempts as $attempt}
								<div class="list-group-item">
								<div class="row">
									<div class="col-md-10">
										<datetime class="list-group-item-text">{$attempt.starttime} - {$attempt.endtime}</datetime>
										<br/>
										<a href="../../pages/exams/exam_taken.php?attemptid={$attempt.id}">Review</a>
									</div>
									<div class="col-md-2 text-right">
										<br/><p class="list-group-item-text">Grade: {$attempt.finalscore} / {$exam.maxscore}</p>
									</div>
								</div>
							</div>
							{/foreach}
							{else}
							<div id="examAvailableParent">
								<div id="examAvailable" class="alert alert-info" >
		  							No Attempts Available.
								</div>
							</div>
							{/if}
						</div>
						{/if}
					{elseif $examStatus == 2}
						{if $ongoingattempt === -1 && sizeof($userattempts) < $exam.maxtries}
							<a 
							{if $exam.opentopublic}
								href="{$BASE_URL}pages/exams/take_open.php?exam={$exam.id}">
							{else}
								href="{$BASE_URL}pages/exams/take.php?exam={$exam.id}">
							{/if}
								<div type="button" class="btn btn-lg btn-primary col-md-2 col-md-offset-5">
									Take exam
								</div><p></p>
							</a>
						{elseif $ongoingattempt !== -1}
							<a href="{$BASE_URL}pages/exams/take.php?exam={$exam.id}&attempt={$ongoingattempt}">
								<div type="button" class="btn btn-lg btn-primary col-md-2 col-md-offset-5">
									Continue attempt
								</div><p></p>
							</a>
						{/if}
					{else}
					<div id="examAvailableParent">
						<div id="examAvailable" class="alert alert-info" >
	  						Exam not available
						</div>
					</div>
					{/if}
					
					{if $examStatus !== 0 && sizeof($userattempts) > 0}
						<br/>
						<div class="page-header">
        					<h1>Previous attempts</h1>
      					</div>
      					<table class="table table-striped">
            				<thead>
 				            	<tr>
                					<th>Attempt ID</th>
                					<th>Start</th>
                					<th>End</th>
                					<th>Score</th>
              					</tr>
            				</thead>
            				<tbody>
            					{foreach from=$userattempts item=attempt}
              						<tr>
                						<td>{$attempt.id} <a href="{$BASE_URL}pages/exams/exam_taken.php?attemptid={$attempt.id}">(Review)</a></td>
                						<td>{$attempt.starttime}</td>
                						<td>{$attempt.endtime}</td>
                						<td>{$attempt.finalscore}</td>
              						</tr>
            					{/foreach}
            				</tbody>
          				</table>
					{/if}
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
	
{include file='common/footer.tpl'}