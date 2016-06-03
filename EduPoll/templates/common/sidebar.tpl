{if $dateReady eq 1}
	<div class="col-sm-3 col-md-2 sidebar">

		<div class="calendar-mini">
			<div class="calendar-month">
				<ul class="calendar-header">
					<li style="text-align: center">{$monthName}<br> <span
						style="font-size: 18px">2016</span>
					</li>
				</ul>
			</div>

			<ul class="calendar-weekdays">
				<li>Su</li><li>Mo</li><li>Tu</li><li>We</li><li>Th</li><li>Fr</li><li>Sa</li>
			</ul>

			<ul class="calendar-days">
				{for $foo=0 to $firstDay-1}<li> </li>{/for}{for $foo=1 to $monthDays}<li>{if $foo eq $day}<span class="calendar-day-active">{$foo}</span>{else}{$foo}{/if}</li>{/for}
			</ul>
		</div>
		
  	</br></br><ul class="nav nav-sidebar" text-align="right">
    	<li><a href="{$BASE_URL}pages/users/edit_profile.php">{$name|escape:'html'}</a></li>
  	</ul>
  
	</div>
{/if}