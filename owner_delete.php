<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Owner Master";
$page_title = "Owner Master Delete";

if( $_REQUEST['action'] == "delete" && !empty($_REQUEST['id']) ) {
	owner_row_delete();
	header("Location: owner_list.php?msg=owner deleted");
} else {
	header("Location: owner_list.php?error_msg=owner deletion failed");
}

?>	