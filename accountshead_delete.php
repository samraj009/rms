<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Accounts Head";
$page_title = "Delete Accounts Head";

if( $_REQUEST['action'] == "delete" && !empty($_REQUEST['id']) ) {
	accounts_head_row_delete();
	header("Location: accountshead_list.php?msg=Accounts Head deleted");
} else {
	header("Location: accountshead_list.php?error_msg=Accounts Head deletion failed");
}

?>	