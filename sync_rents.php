<?php

//////////////////////////////////////////
/////   RENTAL MANAGEMENT SOFTWARE  /////
/////         VERSION 1.0          /////
/////           2020              /////
/////       E2 DEVELOPERS        /////
/////////////////////////////////////

include_once('config.php');
require_once('login_session_check.php');

$page = "Settings";
$page_name = "Settings";
$page_title = "Rent Sync With Receipts";

if( ISSET($_POST['save_button']) ) {
	    $result = manual_sync_rent_receiptsv1($params);
		$msg = "Rent sync completed";
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
  
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<style>
.buttons-print{
	float:left;
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
          <div class="d-sm-flex mb-4">
		  <div class="col-md-6"><h1 class="h3 mb-0 text-gray-800"><?php echo $page_title; ?></h1></div>
		  <div class="col-md-6">
		   
          </div>
		  </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex">
              <div class="col-md-10"><h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title; ?></h6></div>
			  <div class="col-md-2">
			  
			  
			  </div>
            </div>
            <div class="card-body">
			
			<?php 
			if(!empty($msg) ) { 
			echo '<div class="alert alert-success"><strong>Success!</strong> '.$msg.'</div>';
			}
			if(!empty($_REQUEST['error_msg']) ) { 
			echo '<div class="alert alert-danger"><strong>Failed!</strong> '.$_REQUEST['error_msg'].'</div>';
			}
			?>
			
			  <form name="form" method="post" action="<?php echo $form_action;?>">
			  <div class="form-row form_last_row" style="margin:30px 0;">
			  <center>
			  <button type="submit" class="btn btn-success btn-icon-split" name="save_button">
				  <span class="icon text-white-50"><i class="fas fa-check"></i></span>
				  <span class="text">RENT SYNC WITH RECEIPTS</span>
			  </button>
			  </center>
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
