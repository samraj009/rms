<?php
require_once('config.php');
require_once('login_session_check.php');


$page_name = "Reports";
$page_title = "Ledger View";

$msg = "";
$error_msg = "";

$search_result = "";
$result = array();
$total_credit = 0;
$total_debit = 0;
$balance = 0;
$open_balance = 0;
$close_balance = 0;

$account = "";
$from_date = date("Y-m-d");
$to_date = date("Y-m-d");

if( ISSET($_POST['search_button']) ) {
	
	if( !empty($_POST['account']) && !empty($_POST['from_date']) && !empty($_POST['to_date'])  ) {
		
		$search_result = "true";
		$account = $_POST['account'];
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$result = reports_ledger_view();
		
	} else {
		$error_msg = "Please enter input values";
	}	
}

$account_list = '';
$account_lists = accounts_head_row_select_multiple($params);

if( count($account_lists) > 0 ){
	foreach($account_lists as $row){
		if( $row['account_id'] == $account ){
			$selected = 'selected="selected"';
		}else {
			$selected = '';
		}	
	$account_list .= '<option value="'.$row['account_id'].'" '.$selected.'>'.$row['account_name'].'</option>';
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

  <title>Rent Management Software | <?php echo $page_name.' - '.$page_title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
    <!-- datepicker css -->
  <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
  
    <style>
  .required_field{
	color:red;
	font-weight:bold;
}
.buttons-print{
	float:left;
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
			
			<form name="form" id="form" method="post" action="<?php echo $form_action;?>">
			
			<div class="form-row">
			
			<div class="form-group col-md-3">
					  <label for="account">Account Head <span class="required_field">&#8727;</span></label>
					  <select id="account" name="account" class="form-control">
						<option value="">Choose...</option>
						<?php echo $account_list;?>
					  </select>
			</div>
			  
			  <div class="form-group col-md-3">
				  <label for="from_date">From Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="from_date" name="from_date" placeholder="" value="<?php echo $from_date;?>" />
			  </div>
			  
			  <div class="form-group col-md-3">
				  <label for="to_date">To Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="to_date" name="to_date" placeholder="" value="<?php echo $to_date;?>" />
			  </div>
			  
			  <div class="form-group col-md-3">
			    <label>&nbsp;</label>
				  <button type="submit" class="btn btn-success btn-icon-split" name="search_button" style="display: block;">
				  <span class="icon text-white-50"><i class="fas fa-search"></i></span>
				  <span class="text">Search</span>
				 </button>
			  </div>
			  
			</div>
				  
			</form>
			
            </div>
			<!-- /.card-body -->
          </div>
		  <!-- /.card shadow mb-4 -->
		  
		  <?php if( $search_result == "true" ) { ?>
		  <!-- BEGIN : search result -->
		  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Search Result</h6>
            </div>
            <div class="card-body">
			
			<div class="row">
			<div class="col-sm-12">
			<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" data-ordering="false" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Date</th>
					  <th>Particulars</th>
					  <th>Notes</th>
					  <th>Credit</th>
					  <th>Debit</th>
					  <th>Balance</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
					$i = 0;
					if( count($result) > 0 ){
						$open_balance = isset( $result[0]['open_balance'] ) ? $result[0]['open_balance'] : 0;
						foreach($result as $row){
						    echo "<tr>";
							echo "<td>".frontend_date_format($row['sheet_date'])."</td>";
							echo "<td>".$row['particulars']."</td>";
							echo "<td>".$row['particulars_notes']."</td>";
							if($row['type'] == "receipts") {
								$total_credit = $total_credit + $row['total'];
								echo "<td>".number_format($row['total'],2)."</td>";
							} else {
								echo "<td> &nbsp; </td>";
							}	
							if($row['type'] == "payments") {
								echo "<td>".number_format($row['total'],2)."</td>";
								$total_debit = $total_debit + $row['total'];
							} else {
								echo "<td> &nbsp; </td>";
							}
							if( $row['type'] == "receipts" ) {
								$balance = $balance + $row['total'];
							} else {
								$balance = $balance - $row['total'];
							}								
							echo "<td>".number_format($balance,2)."</td>";
							echo "</tr>";
							$i++;
				        }
					} else {
						echo "<tr><td colspan='5' align='center'>No data found.</tr>";
					}
					?>
				  </tbody>
				  </table>
				  </div>
			</div>
			</div>
			 
			 <div class="form-row" style="margin-top:20px;display:none">
			  <div class="form-group col-md-8"></div>
			  <div class="form-group col-md-4">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			  <tbody>
			  <tr>
			  <td><strong>Opening Balance &#8377;</strong></td>
			  <td><?php echo number_format($open_balance,2); ?></td>
			  </tr>
			  <tr>
			  <td><strong>Total Credit &#8377;</strong></td>
			  <td><?php echo number_format($total_credit,2); ?></td>
			  </tr>
			  <tr>
			  <td><strong>Total Debit &#8377;</strong></td>
			  <td><?php echo number_format($total_debit,2); ?></td>
			  </tr>
			  <tr>
			  <td><strong>Closing Balance &#8377;</strong></td>
			  <td>
			  <?php 
			  $close_balance = $open_balance + $total_credit - $total_debit;
			  $close_balance = round($close_balance,2);
			  echo number_format($close_balance,2);
			  ?>
			  </td>
			  </tr>
			  </tbody>
			  </table>
			  </div>
			  </div>
			  </div>
			 
			</div>
		</div>
		<!-- END : search result -->
		  <?php } ?>

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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="vendor/datatables/dataTables.buttons.min.js"></script>
  <script src="vendor/datatables/buttons.print.min.js"></script>
  
   <!-- datapicker js -->
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script>
$('#from_date').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
});
$('#to_date').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
});
  </script>
</body>

</html>
