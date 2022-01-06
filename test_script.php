<?php

include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

echo $curdate = date("d-m-Y");
$date_format = date("Y-m-d", strtotime( $curdate) );
echo "<br/>";
echo $date_format;

$rent_ids = '46,47,48';
$array = explode(',',$rent_ids);
print_r($array);
if(count($array) > 0){
	
foreach($array as $val){
	echo $val;
}

}
/*
$result_rent = array();
$result_account = array();

$owner_id = 1;

$owner_name = "";
$rent_total = "";
$agent_commision = "";
$rent_ids = "";

$account_id = "";

$open_balance = "";

$rent_collection_date = date('Y-m-d');



// STEP 1 => SELECT "RENT" DATAS...
echo "<b>SELECT RENT DATAS...</b><br/><br/>";
$sql = "SELECT r.rent_owner AS owner_id, o.owner_name AS owner_name, sum(r.rent_total) AS rent_total, sum(r.rent_commision) AS agent_commision, GROUP_CONCAT(r.rent_id, '') AS rent_ids FROM rent AS r RIGHT JOIN owner AS o ON o.owner_id = r.rent_owner WHERE r.rent_user = '".$_COOKIE['user_id']."' AND r.rent_owner = '".$owner_id."' AND r.account_receipts = 0 group by r.rent_owner";
$query = query_execute($sql);
$count_rows = query_row_count($query);
if($count_rows > 0){
$result_rent = query_row_fetch($query);
$owner_name = isset( $result_rent[0]['owner_name'] ) ? $result_rent[0]['owner_name'] : '';
$rent_total = isset( $result_rent[0]['rent_total'] ) ? $result_rent[0]['rent_total'] : '';
$agent_commision = isset( $result_rent[0]['agent_commision'] ) ? $result_rent[0]['agent_commision'] : '';
$rent_ids = isset( $result_rent[0]['rent_ids'] ) ? $result_rent[0]['rent_ids'] : '';
}
echo "<pre>";print_r($result_rent);echo "</pre>";

echo "$owner_name,$rent_total,$agent_commision,$rent_ids <br/>";

// STEP 2 => CHECKING ACCOUNT HEAD...
echo "<b>CHECKING ACCOUNT HEAD...</b><br/><br/>";
$sql = "SELECT account_id FROM accounts_head WHERE account_uid='".$_COOKIE['user_id']."' AND account_owner='".$owner_id."'";
$query = query_execute($sql);
$count_rows = query_row_count($query);
if($count_rows == 0){
	
	$sql = "INSERT INTO accounts_head (
	account_uid,
	account_owner,
	account_name,
	account_category)
	VALUES (
	'".$_COOKIE['user_id']."',
	'".$owner_id."',
	'".$owner_name."',
	'building owner')";
    $query = query_execute($sql);
	
	echo "Account Head created. <br/>";
	
	$account_id = query_get_last_insert_id();

} else {
	echo "Account Head already exists. <br/>";
	$result_account = query_row_fetch($query);
	$account_id = isset( $result_account[0]['account_id'] ) ? $result_account[0]['account_id'] : '';
}

echo "account_id = $account_id <br/>";

// STEP 3 => GET BALANCE DETAILS
echo "<b>GET BALANCE DETAILS...</b><br/><br/>";
$balance_last_row = receipts_select_last_row();

echo "<pre>";print_r($balance_last_row);echo "</pre>";

$open_balance = isset( $balance_last_row[0]['close_balance'] ) ? $balance_last_row[0]['close_balance'] : '0.00';

echo "open_balance = $open_balance <br/>";

// STEP 4 => RECEIPTS ADDING....
echo "<b>RECEIPTS ADDING....</b><br/><br/>";

$type = "receipts";
$particulars = "building rent";
$particulars_notes = "collection";
$quantity = 1;

$total = $rent_total;
$total = round($total,2);
$amount = $total;

$close_balance = $open_balance + $total;
$close_balance = round($close_balance,2);
	
	$sql = "INSERT INTO balance_sheet (
	uid,
	type,
	sheet_date,
	account_id,
	particulars,
	particulars_notes,
	rent_ids,
	amount,
	quantity,
	total,
	open_balance,
	close_balance)
	VALUES (
	'".$_COOKIE['user_id']."',
	'".$type."',
	'".$rent_collection_date."',
	'".$account_id."',
	'".$particulars."',
	'".$particulars_notes."',
	'".$rent_ids."',
	'".$amount."',
	'".$quantity."',
	'".$total."',
	'".$open_balance."',
	'".$close_balance."')";
$query = query_execute($sql);


// STEP 5 => UPDATE RENT DATAS....
echo "<b>UPDATE RENT DATAS....</b><br/><br/>";
$sql = "UPDATE rent SET
	account_receipts = 1
	WHERE rent_user = '".$_COOKIE['user_id']."' AND rent_owner = '".$owner_id."'";
	$query = query_execute($sql);
	*/

/*
$sql = "SELECT rc.*,o.owner_id,o.owner_name,b.building_id,b.building_complex FROM rentcollection as rc
RIGHT JOIN owner as o ON o.owner_id = rc.collection_owner 
RIGHT JOIN building as b ON b.building_owner = rc.collection_building
WHERE collection_userid='".$params['user_id']."' group by rc.collection_id order by rc.collection_id DESC";

$query = mysqli_query($db_con, $sql);
while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
$result[] = $row;
}
echo "<pre>";print_r($result);echo "</pre>";
*/

/*$sql = "SELECT t.*,o.owner_id,o.owner_name,b.building_id,b.building_complex FROM tenant as t 
	RIGHT JOIN owner as o ON o.owner_id = t.tenant_owner
	RIGHT JOIN building as b ON b.building_id = t.tenant_building
	WHERE t.tenant_user_id='".$params['user_id']."' AND t.tenant_delete IS NULL group by t.tenant_id order by t.tenant_id DESC";
	$query = mysqli_query($db_con, $sql);
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
    $result[] = $row;
	}
	echo "<pre>";print_r($result);echo "</pre>";*/

$tenant_from_date = '';
$tenant_lastpaid_month = '';
$rent_lastpaid_month = '';
	
$params['owner_id'] = isset($_POST['owner_id']) ? $_POST['owner_id'] : 1;
$params['building_id'] = isset($_POST['building_id']) ? $_POST['building_id'] : 1;
$params['id'] = isset($_POST['tenant_id']) ? $_POST['tenant_id'] : 2;

$row = tenant_row_select_single($params);
//echo "<pre>";print_r($row);echo "</pre>";

if(count($row) > 0) {
$result['tenant_door'] = $row['tenant_door'];
$result['tenant_rent_amount'] = $row['tenant_rent_amount'];
$result['tenant_fromdate'] = $tenant_from_date = $row['tenant_fromdate'];
$result['tenant_lastpaid'] = $tenant_lastpaid_month = $row['tenant_lastpaid'];

$sql = "SELECT * FROM rent WHERE rent_tenant='".$params['id']."' order by rent_id DESC limit 1";
$query = mysqli_query($db_con, $sql);
$count_rows = mysqli_num_rows($query);
if($count_rows > 0){
$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
$rent_lastpaid_month = $row['rent_month'];
}


$row = rent_select_last_row($params);
//echo "<pre>";print_r($row);echo "</pre>";
if(count($row) > 0) {
	$rent_lastpaid_month = $row['rent_month'];
}
}


if( !empty($rent_lastpaid_month) ) {
	//echo "rent last paid";
	$start_date = "$rent_lastpaid_month-01";
} elseif( !empty($tenant_lastpaid_month) ) {
	//echo "tenant last paid";
	$start_date = "$tenant_lastpaid_month-01";
} elseif( !empty($tenant_from_date) ) {
	//echo "tenant from date";
	$start_date = $tenant_from_date;
} else {
	//echo "current date";
	$start_date = date('Y-m-d'); 
}

$start    = new DateTime($start_date);
$start->modify('first day of next month');
$end      = new DateTime('NOW');
$end->modify('last day of previous month'); 
$interval = DateInterval::createFromDateString('1 month');
$period   = new DatePeriod($start, $interval, $end);
$due_month = array();
$i = 0;
foreach ($period as $month) {
	$due_month[$i]['text'] = $month->format("M Y");
	$due_month[$i]['no'] = $month->format("Y-m");
	$i++;
}
if( count($due_month) > 0 ){
	//echo "<pre>";print_r($due_month);echo "</pre>";
} else {
	//echo "no due";
}

$date = '2019-01-01';
$duemonth = rent_calculate_duemonth($date);


$count_month = 2;
for($i = 0; $i < $count_month; $i++){
	//echo "<br/> $i array val=".$duemonth[$i]['no'];
}

foreach($duemonth as $due) {
	//print_r($due);
/*echo '<tr>
<td align="center"><input type="checkbox" name="rent_duemonth[]" class="rent_duemonth" value="'.$due['no'].'"></td>
<td>'.$due['text'].'</td>
<td><span>&#8377; </span>2000</td>
</tr><br/>';*/
}


//echo "comm=".$commision = 2000*12/100;


//echo json_encode($result);
?>