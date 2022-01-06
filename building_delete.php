<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Building Particulars";
$page_title = "elete Building Particulars";

if( $_REQUEST['action'] == "delete" && !empty($_REQUEST['id']) ) {
	building_row_delete();
	header("Location: building_list.php?msg=building deleted");
} else {
	header("Location: building_list.php?error_msg=building deletion failed");
}

?>	