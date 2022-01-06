<?php

include_once('config.php');

//print_r($_POST);

$params['owner_id'] = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
$params['building_id'] = isset($_POST['building_id']) ? $_POST['building_id'] : '';
$list = '';
$lists = tenant_selectby_params($params);

if( count($lists) > 0 ){
	foreach($lists as $row){
	$list .= '<option value="'.$row['tenant_id'].'">'.$row['tenant_name'].'</option>';
} // END: FOR EACH
} // END : IF
else {
	$list = '<option value="">No Tenant Found</option>';
}

echo $list;

?>