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
						<li><a href="{$BASE_URL}pages/exams/exams_taken.php">Previous Exams</a></li>
						<li><a href="{$BASE_URL}pages/exams/results.php">Exam Results</a></li>
						<li class="active">Exam review</li>
					</ol>

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>LBAW - Teste 3</h2>
						<p>{$attempt.starttime} - {$attempt.endtime}</p>
					</div>
					
					<div class="panel panel-success">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-6"><h3 class="panel-title">Your Score was: <strong>{(float)$attempt.finalscore}</strong>/{(float)$exam.maxscore}</h3></div>
								<div class="col-md-6 text-right"><a href="{$BASE_URL}pages/exams/welcome.php?id={$attempt.examid}">Return to the Results Page</a></div>
							</div>
						</div>
					</div>
					
					{foreach from=$questions item=question}
						{$score = 0}
						{$maxscore = 0}
						<div class="panel panel-primary">
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
											name="optradio" 
											
											{if $answer.id == $question.answerid}
												checked="checked"
												{$score = $answer.score}
											{/if}
											
											disabled>{$answer.text}</label>
										<br/>
									{/foreach}
									</div>
								</form>
								
								<div class="row">
									<div class="col-md-10"></div>
									<div class="col-md-2">
										Score: {(float)$score} / {(float)$maxscore}
									</div>
								</div>
							</div>
						</div>
					{/foreach}					
					
					<button type="button" class="btn btn-primary"><a href="{$BASE_URL}pages/exams/welcome.php?id={$attempt.examid}">Return to results page</a></button><p></p>	
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->
{include file='common/footer.tpl'}