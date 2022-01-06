<?php

if( empty($params['user_id']) || empty($params['user_name']) || empty($params['user_email'])) {
	header("Location: login.php?error_msg=session_timeout");
}

?>