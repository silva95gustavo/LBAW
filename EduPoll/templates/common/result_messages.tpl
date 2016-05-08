<div id="result_messages">
    {foreach $ERROR_MESSAGES as $error}
      <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {$error}
      </div>
    {/foreach}
    {foreach $SUCCESS_MESSAGES as $success}
      <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      {$success}
      </div>
    {/foreach}
</div>