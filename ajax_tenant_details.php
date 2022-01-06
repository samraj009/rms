<?php

include_once('config.php');

//print_r($_POST);
$result = array();
$result['tenant_door'] = '';
$result['tenant_rent_amount'] = '';
$result['tenant_fromdate'] = '';
$result['tenant_lastpaid'] = '';
$result['agent_commision'] = '';
$result['rent_lastpaid_month'] = '';
$result['duemonth'] = '';
$result['tenant_last_pay_date'] = "";
$result['tenant_todate'] = '';
$duelist = '';

$tenant_rent_amount = '';
$tenant_from_date = '';
$tenant_lastpaid_month = '';
$rent_lastpaid_month = '';

$params['owner_id'] = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
$params['building_id'] = isset($_POST['building_id']) ? $_POST['building_id'] : '';
$params['tenant_id'] = isset($_POST['tenant_id']) ? $_POST['tenant_id'] : '';

if( !empty($params['owner_id']) && !empty($params['building_id']) && !empty($params['tenant_id']) ) {
	
	// GET TENANT DETAILS
$tenant_data = tenant_row_select_single($params);
$tenant_row = isset($tenant_data[0]) ? $tenant_data[0] : array();
if(count($tenant_row) > 0) {
$result['tenant_door'] = $tenant_row['tenant_door'];
$result['tenant_rent_amount'] = $tenant_rent_amount = $tenant_row['tenant_rent_amount'];
$result['tenant_fromdate'] = $tenant_from_date = $tenant_row['tenant_fromdate'];
$result['tenant_lastpaid'] = $tenant_lastpaid_month = $tenant_row['tenant_lastpaid'];

$to_todate = isset( $tenant_row['tenant_todate'] ) ? $tenant_row['tenant_todate'] : '';
if($to_todate == '0000-00-00'){
	$to_todate = '';
}
$result['tenant_todate'] = $to_todate;

// GET OWNER DETAILS
$owner_data = owner_row_select_single($params);
$owner_row = isset($owner_data[0]) ? $owner_data[0] : array();
if(count($owner_row) > 0) {
$result['agent_commision'] = $owner_row['commision'];
}

// GET RENT DETAILS
$rent_row = rent_select_last_row($params);
if(count($rent_row) > 0) {
$result['rent_lastpaid_month'] = $rent_lastpaid_month = isset( $rent_row[0]['rent_month'] ) ? $rent_row[0]['rent_month'] : '';
}

if( !empty($rent_lastpaid_month) ) {
	$start_date = "$rent_lastpaid_month-01";
} elseif( !empty($tenant_lastpaid_month) ) {
	$start_date = "$tenant_lastpaid_month-01";
} elseif( !empty($tenant_from_date) && ( $tenant_from_date != '0000-00-00' ) ) {
	//$start_date = $tenant_from_date;
	$start = new DateTime($tenant_from_date);
   $start->modify('last day of previous month');
   $start_date = $start->format("Y-m-d");
} else {
	$start_date = date('Y-m-d'); 
}



$result['tenant_last_pay_date'] = $start_date;

$duemonth = rent_calculate_duemonth($start_date,$to_todate);

if( count($duemonth) > 0 ) {
	$i = 0;
foreach($duemonth as $due) {
	$i++;
$duelist .= '<tr>';
//$duelist .= '<td align="center"><input type="checkbox" name="rent_duemonth[]" class="rent_duemonth" value="'.$due['no'].'" onclick="selectDueMonth();"></td>';
$duelist .= '<td>'.$i.'</td>';
$duelist .= '<td>'.$due['text'].'</td>';
$duelist .= '<td><span>&#8377; </span>'.$tenant_rent_amount.'</td>';
$duelist .= '</tr>';
}
} else {
	$duelist .= '<tr><td colspan="4" align="center">No Due</td></tr>';
}
$result['duemonth'] = $duelist;

} else {
	//echo "no tenant details found";
}

} else {
	//echo "please fill the fields!";
}
echo json_encode($result);

?>