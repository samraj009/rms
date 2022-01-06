<?php
require_once('config.php');

$selected_year = $_REQUEST['year'];
$redirect_url = $_REQUEST['redirect'];

if( !empty($selected_year) && !empty($redirect_url) ){
	
	$next_year = $selected_year+1;
	$selected_year_from_date = $selected_year.'-04-01';
	$selected_year_to_date = $next_year.'-03-31';
	$selected_year_text  = '1-April-'.$selected_year.' to 31-March-'.$next_year;
	
	setcookie("selected_year", $selected_year, time() + (86400 * 30), "/");
	setcookie("selected_year_text", $selected_year_text, time() + (86400 * 30), "/");
	setcookie("selected_year_from_date", $selected_year_from_date, time() + (86400 * 30), "/");
	setcookie("selected_year_to_date", $selected_year_to_date, time() + (86400 * 30), "/");
	
	header("Location: $redirect_url");
}else{
	header("Location: index.php?error_msg=Financial Year Selection Failed!");
}
	
?>