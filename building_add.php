<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Building Particulars";
$page_title = "Add Building Particulars";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['building_owner']) && !empty($_POST['building_complex']) ) {
		$result = building_row_insert();
		$msg = "Building particulars added";
	} else {
		$error_msg = "Please enter input fields";
	}	
} 

$onwer_list = '';
$owner_lists = owner_row_select_multiple($params);

if( count($owner_lists) > 0 ){
	foreach($owner_lists as $row){
	$onwer_list .= '<option value="'.$row['owner_id'].'">'.$row['owner_name'].'</option>';
} // END: FOR EACH
} // END : IF

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
            <a href="building_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Buildings</a>
          </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title ?></h6>
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
              
			  <form name="building" method="post" action="<?php echo $form_action;?>">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Building Details</h6></div>
			  
			  <div class="form-row">
			  
			  <div class="form-group col-md-4">
			  <label for="building_owner">Select Building owner <span class="required_field">&#8727;</span></label>
			  <select id="building_owner" name="building_owner" class="form-control">
				<option value="">Choose...</option>
				<?php echo $onwer_list;?>
			  </select>
			  <span><a title="ADD OWNER" target="_blank" href="owner_add.php"><i class="fas fa-plus fa-sm"></i> ADD OWNER</a></span>
			</div>
			
			<div class="form-group col-md-4">
			  <label for="building_complex">Complex Name <span class="required_field">&#8727;</span></label>
			  <input type="text" class="form-control" id="building_complex" name="building_complex" placeholder="Enter Complex Name" value="" />
			</div>
			
			<div class="form-group col-md-4">
			  <label for="building_placeno">No.of Rental place</label>
			  <input type="text" class="form-control" id="building_placeno" name="building_placeno" placeholder="Enter No.of Rental Place" value="" />
			</div>
			
			</div>
			
			<div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Maintenance Details</h6></div>
  
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="building_watertax">Water Tax</label>
      <input type="text" class="form-control" id="building_watertax" name="building_watertax" placeholder="Enter water Tax" value="" />
    </div>
	<div class="form-group col-md-4">
      <label for="building_corporationtax">Corporation Tax</label>
      <input type="text" class="form-control" id="building_corporationtax" name="building_corporationtax" placeholder="Enter Corporation Tax" value="" />
    </div>
    <div class="form-group col-md-4">
      <label for="building_ebdeposit">EB Deposit Amount</label>
      <input type="text" class="form-control" id="building_ebdeposit" name="building_ebdeposit" placeholder="Enter EB Deposit Amount" value="" />
    </div>
  </div>
  
  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Address Details</h6></div>
  
  <div class="form-row">
  <div class="form-group col-md-4">
    <label for="building_address">Building Address</label>
	<textarea class="form-control" id="building_address" name="building_address" placeholder="Enter Building Address" rows="3"></textarea>
  </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="building_city">City</label>
      <input type="text" class="form-control" id="building_city" name="building_city">
    </div>
	<div class="form-group col-md-3">
      <label for="building_district">District</label>
      <input type="text" class="form-control" id="building_district" name="building_district">
    </div>
    <div class="form-group col-md-3">
      <label for="building_state">State</label>
      <select id="building_state" name="building_state" class="form-control">
        <option value="">Choose...</option>
        <option value="Tamilnadu">Tamilnadu</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="building_zipcode">Zip</label>
      <input type="text" class="form-control" id="building_zipcode" name="building_zipcode">
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
