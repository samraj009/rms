<?php
ob_start();
setcookie('user_id', '', time()-3600,'/');
setcookie('user_name', '', time()-3600,'/');
setcookie('user_email', '', time()-3600,'/');

setcookie("selected_year", '', time()-3600,'/');
setcookie("selected_year_text", '', time()-3600,'/');
setcookie("selected_year_from_date", '', time()-3600,'/');
setcookie("selected_year_to_date", '', time()-3600,'/');

header("Location: login.php?msg=logout");
?>