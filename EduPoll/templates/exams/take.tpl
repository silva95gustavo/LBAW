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

					<!-- Main jumbotron for a primary marketing message or call to action -->
					<div class="first-element jumbotron">
						<h2>{$exam.name}</h2>
						<p>{$attempt.starttime} - {if isset($attempt.endtime)}{$attempt.endtime}{else}Ongoing{/if}</p>
					</div>
					
					<a href="exam-welcome.html"></a><button type="button" class="btn btn-primary">Submit exam</button><p></p></a>

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
					
					<h4>Total exam max score: {$exam.maxscore}</h4>
					
					<button type="button" class="btn btn-primary">Submit exam</button><p></p>
					
				</div>
			</div>
		</div>






	</div>
	<!-- /container -->

{include file='common/footer.tpl'}