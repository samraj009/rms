<?php
//////////////////////////////////////////
/////   RENTAL MANAGEMENT SOFTWARE  /////
/////         VERSION 1.0          /////
/////           2020              /////
/////       E2 DEVELOPERS        /////
/////////////////////////////////////

include_once('config.php');
require_once('login_session_check.php');

$page = "Agent Commission";
$page_name = "Agent Commission";
$page_title = "Add Agent Commission";

$currency_symbol = '<span class="currency_symbol">&#8377;</span>';
$currency_text = '<span class="currency_text">INR</span>';

$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['total_rent']) && !empty($_POST['total_commission']) && !empty($_POST['commission_pending']) && !empty($_POST['commission_taken_date']) ) {
		$result = manual_sync_commission_payments($params);
		$msg = "Commision added";
	} else {
		$error_msg = "Due to Empty input values";
	}	
} 

$result = agent_commision_row_select_multiple($params);

if( count( $result ) > 0 ){
	$total_rent = array_sum(array_column($result, 'rent_total'));
	$total_commission = array_sum(array_column($result, 'agent_commision'));
	$commission_complete = array_sum(array_column($result, 'complete'));
	$commission_pending = array_sum(array_column($result, 'pending'));
} else {
	$total_rent = 0;
	$total_commission = 0;
	$commission_complete = 0;
	$commission_pending = 0;
}

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
    <!-- datepicker css -->
  <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
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
		
		<?php include_once('select_financial_year.php'); ?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $page_name; ?></h1>
            <a href="agent_commission_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Agent Commision</a>
          </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title;?></h6>
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
              
			  <form name="agent_commission_add_form" method="post" action="<?php echo $form_action;?>">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Commission Details</h6></div>
			  
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="total_rent">Total Rent <?php echo $currency_symbol;?></label>
      <input type="text" class="form-control" id="total_rent" name="total_rent" value="<?php echo $total_rent;?>" readonly />
    </div>
	<div class="form-group col-md-3">
      <label for="total_commission">Total Commision <?php echo $currency_symbol;?></label>
      <input type="text" class="form-control" id="total_commission" name="total_commission" value="<?php echo $total_commission;?>" readonly />
    </div>
	<div class="form-group col-md-3">
      <label for="commission_complete">Commision Complete <?php echo $currency_symbol;?></label>
      <input type="text" class="form-control" id="commission_complete" name="commission_complete" value="<?php echo $commission_complete;?>" readonly />
    </div>
	<div class="form-group col-md-3">
      <label for="commission_pending">Commision Pending <?php echo $currency_symbol;?></label>
      <input type="text" class="form-control" id="commission_pending" name="commission_pending" value="<?php echo $commission_pending;?>" readonly />
    </div>
  </div>
  
  <div class="form-row">
			  
			  <div class="form-group col-md-3">
				  <label for="commission_taken_date">Commission Taken Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="commission_taken_date" name="commission_taken_date" placeholder="" value="<?php echo date("d-m-Y");?>" />
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
  
    <!-- datapicker js -->
  <script src="js/bootstrap-datepicker.min.js"></script>
  


<script>
$('#commission_taken_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '-3d'
});
</script>



</body>

</html>
