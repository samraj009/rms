<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Account Settings";
$page_title = "Balance Updates";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['amount']) ) {
		$result = balance_row_insert($params);
		$msg = "balance updated";
		
	} else {
		$error_msg = "Please fill the fields";
	}	
} 

$balance_last_row = receipts_select_last_row();
$open_balance = isset( $balance_last_row[0]['close_balance'] ) ? $balance_last_row[0]['close_balance'] : '0.00';

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

    <?php include('sidebar_account.php'); ?>

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
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Balance Details</h6></div>
			  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="amount">Amount &#8377; <span class="required_field">&#8727;</span></label>
      <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $open_balance;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
	  <input type="hidden" class="form-control" id="open_balance" name="open_balance" value="<?php echo $open_balance;?>" />
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