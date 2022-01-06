<?php

include_once('config.php');

$params['owner_id'] = isset($_POST['owner_id']) ? $_POST['owner_id'] : '';
$building_id = isset($_POST['buiding_id']) ? $_POST['buiding_id'] : '';
$list = '';
$lists = building_selectby_params($params);

if( count($lists) > 0 ){
	foreach($lists as $row){
		if($building_id == $row['building_id']){ 
		$selected = "selected='selected'";
		} else {
			$selected = "";
		}
	$list .= '<option value="'.$row['building_id'].'" '.$selected.'>'.$row['building_complex'].'</option>';
} // END: FOR EACH
} // END : IF
else {
	$list = '<option value="">No Building Found</option>';
}

echo $list;

?>