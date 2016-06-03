<div class="panel-body">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6 question-statement-container">
					<div class="inline-editable question-statement" name="statement" data-id="{$question.id}">{$question.statement}</div>
				</div>
				<div class="col-md-6 text-right">
					<span class="icon-clickable">
						<i class="fa fa-trash-o" data-questionid="{$examElement.id}" data-toggle="modal" data-target="#confirmationModalDeleteQuestion"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
			
			{foreach $question.answers as $answer}
			<div class="radio disabled answer">
				<label class="answer">
					<input type="radio" name="optradio1" checked="checked">
					<div class="inline-editable answer-text" name="text" data-id="{$answer.id}">{$answer.text}</div>
				</label>
			</div>
			{/foreach}
			
			<form class="add-answer" data-id={$answer.id}>
				<i class="fa fa-plus"></i>
				<input type="hidden" name="questionid" value="{$question.id}"/>
				<input type="text" name="text" placeholder="Add answer"/>
			</form>
		</div>
	</div>
</div>