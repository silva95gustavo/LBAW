<div class="panel-body">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-md-6">Question A1</div>
				<div class="col-md-6 text-right">
					<i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
					<span class="icon-clickable">
						<i class="fa fa-trash-o" data-questionid="{$examElement.id}" data-toggle="modal" data-target="#confirmationModalDeleteQuestion"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="panel-body">
			<p><strong>Question: </strong>{$question.statement}</p>
			<form>
				<input type="hidden" name="csrf_token" value="{$CSRF_TOKEN}" />
				
				{foreach $question.answers as $answer}
				<div class="radio disabled">
					<label><input type="radio" name="optradio1" checked="checked">{$answer.text}</label>
				</div>
				{/foreach}
				
			</form>
		</div>
	</div>
</div>