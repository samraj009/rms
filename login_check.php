<?php
require_once('config.php');
if($_SERVER['REQUEST_METHOD'] == "POST") {
 //Username and Password sent from Form
 $username = $_POST['username'];
 $password = $_POST['userpass'];
 
 if( !empty($username) && !empty($password) ) {
 $row = login_data();
 //echo "<pre>";print_r($row);echo "</pre>";

 
 //If result match $username and $password Table row must be 1 row
 if( count($row) > 0 ){
	 
	 $user_id = $row[0]['user_id'];
	 $user_name = $row[0]['user_name'];
	 $user_email = $row[0]['user_email'];
	 setcookie("user_id", $user_id, time() + (86400 * 30), "/");
	 setcookie("user_name", $user_name, time() + (86400 * 30), "/");
	 setcookie("user_email", $user_email, time() + (86400 * 30), "/");
	 
	 $cur_year = date("Y");
	 $cur_month = date("m");

	if($cur_month > 3){
		$selected_year = $cur_year;
	} else{
		$selected_year = $cur_year-1;
	}	

	$next_year = $selected_year+1;
	$selected_year_from_date = $selected_year.'-04-01';
	$selected_year_to_date = $next_year.'-03-31';
	$selected_year_text  = '1-April-'.$selected_year.' to 31-March-'.$next_year;

	setcookie("selected_year", $selected_year, time() + (86400 * 30), "/");
	setcookie("selected_year_text", $selected_year_text, time() + (86400 * 30), "/");
	setcookie("selected_year_from_date", $selected_year_from_date, time() + (86400 * 30), "/");
	setcookie("selected_year_to_date", $selected_year_to_date, time() + (86400 * 30), "/");
  
 header("Location: index.php");
 }
 else
 {
 header("Location: login.php?error_msg=login failed please check your username and password");
 }
 } else {
	 header("Location: login.php?error_msg=login failed please fill the fields");
 }	 
 
} else {
	header("Location: login.php?error_msg=login failed please submit the login form");
}	

?>