<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Tenant Particulars";
$page_title = "Tenant Particulars Delete";

if( $_REQUEST['action'] == "delete" && !empty($_REQUEST['id']) ) {
	tenant_row_delete();
	header("Location: tenant_list.php?msg=tenant deleted");
} else {
	header("Location: tenant_list.php?error_msg=tenant deletion failed");
}

?>	