<?php

set_time_limit(0);

ob_start();

date_default_timezone_set("Asia/kolkata");

$params = array();
$params['user_id'] = $_COOKIE['user_id'];
$params['user_name'] = $_COOKIE['user_name'];
$params['user_email'] = $_COOKIE['user_email'];
$params['selected_year'] = isset( $_COOKIE['selected_year'] ) ? $_COOKIE['selected_year'] : '';
$params['selected_year_text'] = isset($_COOKIE['selected_year_text']) ? str_replace("+"," ",$_COOKIE['selected_year_text']) : '';
$params['selected_year_from_date'] = isset( $_COOKIE['selected_year_from_date'] ) ? $_COOKIE['selected_year_from_date'] : '';
$params['selected_year_to_date'] = isset( $_COOKIE['selected_year_to_date'] ) ? $_COOKIE['selected_year_to_date'] : '';
$params['owner_id'] = "";
$params['building_id'] = "";
$params['tenant_id'] = "";
$params['collection_id'] = "";
$params['rent_id'] = "";
$params['month'] = "";
$params['account_id'] = "";

//AGENT DETAILS
$params['agent_commission_account'] = 5;
$params['agent_salary_account'] = 6;
$params['agent_exp_account'] = 7;
$params['agent_motor_account'] = 8;

$site = array();
$site['name'] = "Rent Management Software";
$site['url'] = "";
$site['logo_text'] = "Rent Management";
$site['dir'] = "";
$site['date_format'] = 'd-m-Y';
$site['js_date_format'] = 'dd-mm-yyyy';

include_once('lib/db_connect.php');
include_once('lib/function.php');

?>