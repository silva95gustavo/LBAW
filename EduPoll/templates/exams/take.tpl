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
						<li><a href="{$BASE_URL}pages/exams/welcome.php?id={$exam.id}">Exam</a></li>
						<li class="active">Take Exam</li>
					</ol>
					
					<div id="confirmationModalSubmit" class="modal fade" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header text-center">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Are you sure you want to submit this attempt?</h4>
								</div>
								<div class="modal-body text-center">
									<button type="button" id="yes_submit" class="btn btn-success">Yes</button>
									<button type="button" id="no_submit" class="btn btn-danger" data-dismiss="modal">No</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>{$exam.name}</h2>
						{if $exam.opentopublic}
							<p>{$exam.starttime} - {$exam.endtime}</p>
						{else}
							<p>{$attempt.starttime} - {if isset($attempt.endtime)}{$attempt.endtime}{else}Ongoing{/if}</p>
						{/if}
					</div>
					
					<div id="attempt_id_elem" style="display: none;">{$attempt.id}</div>
					<div id="exam_id_elem" style="display: none;">{$exam.id}</div>
					<div id="exam_open_elem" style="display: none;">{if $exam.opentopublic}0{else}1{/if}</div>
					
					<button type="button" class="btn btn-primary submit-attempt">Submit exam</button><p></p>

					{foreach from=$questions item=question}
						{$score = 0}
						{$maxscore = 0}
						<div class="panel panel-primary exam-question">
							<div class="panel-heading">
								<h3 class="panel-title">{$question.statement}</h3>
							</div>
							<div class="panel-body">
								<form>
									<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
									<div class="checkbox">
									{foreach from=$question.answers item=answer}
										{if $answer.score > $maxscore}
											{$maxscore = $answer.score}
										{/if}
									
										<label class="radio-inline"><input type="radio"
											name="optradio" class="checkbox_input"
											{if $exam.opentopublic}
												id="{$question.id}_{$answer.id}"
											{else}
												id="answer_{$answer.id}"
											{/if}
											
											{if $answer.id == $question.answerid}
												checked="checked"
												{$score = $answer.score}
											{/if}
										>{$answer.text}</label>
										<br/>
									{/foreach}
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Max Score: {(float)$maxscore}
									</div>
								</div>
							</div>
						</div>
					{/foreach}
					
					<h4>Total exam max score: {$exam.maxscore}</h4>
					
					<button type="button" class="btn btn-primary submit-attempt">Submit exam</button><p></p>
					
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
	
<script src="{$BASE_URL}javascript/exams/take.js"></script>

{include file='common/footer.tpl'}