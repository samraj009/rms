<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "User Profile";
$page_title = "Change Password";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['user_id']) && !empty($_POST['user_name']) && !empty($_POST['user_email']) && !empty($_POST['user_newpass']) && !empty($_POST['user_oldpass']) ) {
		
		$user_id = $_POST['user_id'];
		$user_name = $_POST['user_name'];
		$user_name = $_POST['user_email'];
		$user_oldpass = $_POST['user_oldpass'];
		$user_newpass = $_POST['user_newpass'];
		
		if( $user_oldpass != $user_newpass ){
			$result = user_row_update($params);
		    $msg = "User Profile Updated";
		} else{
			$error_msg = "Change Password Failed.";
        }
		
	} else {
		$error_msg = "Please fill the fields";
	}	
} 

$data = user_row_single($params);
$result = isset($data[0]) ? $data[0] : array();
//echo "<pre>";print_r($result);echo "</pre>";

$user_id = isset( $result['user_id'] ) ? $result['user_id'] : '';
$user_name = isset( $result['user_name'] ) ? $result['user_name'] : '';
$user_email = isset( $result['user_email'] ) ? $result['user_email'] : '';
$user_oldpass = isset( $result['user_password'] ) ? md5($result['user_password']) : '';

$form_action = $_SERVER['PHP_SELF'];	
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rent Management Software | <?php echo $page_name ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style>
.form_last_row{
justify-content: center;
margin: 20px 0;
padding: 20px 0;
border-top: 1px solid #d1d3e2;
}
.required_field{
	color:red;
	font-weight:bold;
}
</style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <?php include('sidebar_rent.php'); ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
	  
          <?php include('topbar.php'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $page_name; ?></h1>
            <a href="javascript:;" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add New User</a>
          </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title; ?></h6>
            </div>
            <div class="card-body">
			
			<?php 
			if(!empty($msg) ) { 
			echo '<div class="alert alert-success"><strong>Success!</strong> '.$msg.'</div>';
			}
			if(!empty($error_msg) ) { 
			echo '<div class="alert alert-danger"><strong>Failed!</strong> '.$error_msg.'</div>';
			}
			?>
              
			  <form name="owner" method="post" action="<?php echo $form_action;?>">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">User Details</h6></div>
			  
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="user_name">User Name <span class="required_field">&#8727;</span></label>
      <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $user_name;?>" />
    </div>
	<div class="form-group col-md-4">
      <label for="user_email">User Email <span class="required_field">&#8727;</span></label>
      <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $user_email;?>" />
    </div>
	<div class="form-group col-md-4">
      <label for="user_newpass">New Password <span class="required_field">&#8727;</span></label>
      <input type="password" class="form-control" id="user_newpass" name="user_newpass" value="<?php echo $user_oldpass;?>" />
    </div>
	
	<input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
	<input type="hidden" name="user_oldpass" value="<?php echo $user_oldpass;?>" />
  </div>

  <div class="form-row form_last_row">
  <button type="submit" class="btn btn-success btn-icon-split" name="save_button">
	  <span class="icon text-white-50"><i class="fas fa-check"></i></span>
	  <span class="text">Save</span>
  </button>
  </div>
</form>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
	  
	  <?php include('footer.php'); ?>
    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->



  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>
</html>