<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Owner Master";
$page_title = "Edit Owner Master";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['owner_name']) && !empty($_POST['owner_commision']) ) {
		owner_row_update();
		$msg = "Owner details edited";
	} else {
		$error_msg = "Please enter input fields";
	}	
}

$params['owner_id'] = $_GET['id'];
$data = owner_row_select_single($params);
$result = isset($data[0]) ? $data[0] : array();
//echo "<pre>";print_r($result);echo "</pre>";

$form_action = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Rent Management Software | <?php echo $page_title ?></title>

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
            <a href="owner_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Owner</a>
          </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Edit Owner</h6>
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
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Owner Details</h6></div>
			  
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="owner_name">Owner Name <span class="required_field">&#8727;</span></label>
      <input type="text" class="form-control" id="owner_name" name="owner_name" placeholder="Enter Name" value="<?php echo ISSET($result['owner_name']) ? $result['owner_name']: '';?>" />
    </div>
	<div class="form-group col-md-4">
      <label for="owner_phone">Owner Phone</label>
      <input type="text" class="form-control" id="owner_phone" name="owner_phone" placeholder="Enter Phone Number" value="<?php echo ISSET($result['owner_phone']) ? $result['owner_phone']: '';?>" />
    </div>
	<div class="form-group col-md-4">
      <label for="owner_email">Owner Email</label>
      <input type="text" class="form-control" id="owner_email" name="owner_email" placeholder="Enter Email" value="<?php echo ISSET($result['owner_email']) ? $result['owner_email']: '';?>" />
    </div>
  </div>
  
  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Commision Details</h6></div>
  
  <div class="form-row">  
    <div class="form-group col-md-4">
      <label for="owner_commision">Commision % <span class="required_field">&#8727;</span></label>
      <input type="text" class="form-control" id="owner_commision" name="owner_commision" placeholder="Enter Commision" value="<?php echo ISSET($result['commision']) ? $result['commision']: '';?>" />
    </div>
  </div>
  
  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Address Details</h6></div>
  
  <div class="form-group">
    <label for="owner_address">Owner Address</label>
	<div class="form-group col-md-4">
	<textarea class="form-control" id="owner_address" name="owner_address" placeholder="Enter Address" rows="2"><?php echo ISSET($result['owner_address']) ? $result['owner_address']: '';?></textarea>
	</div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="owner_city">City</label>
      <input type="text" class="form-control" id="owner_city" name="owner_city" value="<?php echo ISSET($result['owner_city']) ? $result['owner_city']: '';?>" />
    </div>
	<div class="form-group col-md-3">
      <label for="owner_district">District</label>
      <input type="text" class="form-control" id="owner_district" name="owner_district" value="<?php echo ISSET($result['owner_district']) ? $result['owner_district']: '';?>" />
    </div>
	<?php $state = ISSET($result['owner_state']) ? $result['owner_state']: '';?>
    <div class="form-group col-md-3">
      <label for="owner_state">State</label>
      <select id="owner_state" name="owner_state" class="form-control">
        <option value="">Choose...</option>
        <option value="Tamilnadu" selected="selected">Tamilnadu</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="owner_zipcode">Zip</label>
      <input type="text" class="form-control" id="owner_zipcode" name="owner_zipcode" value="<?php echo ISSET($result['owner_zipcode']) ? $result['owner_zipcode']: '';?>" />
    </div>
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
