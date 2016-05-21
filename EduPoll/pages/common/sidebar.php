<?php
function prepareDate($smarty) {
	date_default_timezone_get();
  	$day = date('d', time());
  	$month = date('m', time());
  	$year = date('y', time());
  
  	$first_day = strftime("%w",strtotime($year . "-" . $month . "-1"));
  	$month_days = date('t');
  	$month_name = date('M');
  
  	$smarty->assign('day', $day);
  	$smarty->assign('monthDays', $month_days);
 	$smarty->assign('firstDay', $first_day);
  	$smarty->assign('monthName', $month_name);
  	$smarty->assign('dateReady', 1);
}
?>