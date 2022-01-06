<?php
require_once('config.php');
require_once('login_session_check.php');

$page_name = "Entries";
$page_title = "View Receipts Entry";
$msg = "";
$error_msg = "";

$params['bsid'] = $_GET['id'];
$row = receipts_row_select_single();
//echo "<pre>";print_r($row);echo "</pre>";

$result = isset($row[0]) ? $row[0] : array();

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
            <h1 class="h3 mb-0 text-gray-800"><?php echo "Receipts"; ?></h1>
            <a href="receipts_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Receipts Entry</a>
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
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Receipts Details</h6></div>
			  
			  <div class="form-row">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Receipt Date</th>
					  <th>Ledger A/c</th>
					  <th>Particulars</th>
					  <th>Amount</th>
					  <th>Quantity</th>
					  <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
				  <tr>
				  <td><?php echo isset($result['sheet_date']) ? $result['sheet_date'] : '';?></td>
				  <td><?php echo isset($result['account_name']) ? $result['account_name'] : '';?></td>
				  <td><?php echo isset($result['particulars']) ? $result['particulars'] : '';?></td>
				  <td><span>&#8377; </span><?php echo isset($result['amount']) ? $result['amount'] : '';?></td>
				  <td><?php echo isset($result['quantity']) ? $result['quantity'] : '';?></td>
				  <td><span>&#8377; </span><?php echo isset($result['total']) ? $result['total'] : '';?></td>
				  </tr>
				  </tbody>
				  </table>
			  </div>
  
			  <div class="form-row">
			  <div class="form-group col-md-8"></div>
			  <div class="form-group col-md-4">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
			  <tbody>
			  <tr>
			  <td>Open Balance &#8377;</td>
			  <td><?php echo isset($result['open_balance']) ? $result['open_balance'] : '';?></td>
			  </tr>
			  <tr>
			  <td>Total &#8377;</td>
			  <td><?php echo isset($result['total']) ? $result['total'] : '';?></td>
			  </tr>
			  <tr>
			  <td>Close Balance &#8377;</td>
			  <td><?php echo isset($result['close_balance']) ? $result['close_balance'] : '';?></td>
			  </tr>
			  </tbody>
			  </table>
			  </div>
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
$('#date').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
});

function calculate_total(){
				var amount = document.getElementById("amount").value;
				var quantity = document.getElementById("quantity").value;
				var open_balance = document.getElementById("open_balance").value; 
				var remaining_balance = parseFloat(open_balance).toFixed(2); alert("remaining_balance = "+remaining_balance);
				var total = parseFloat(amount * quantity).toFixed(2); //alert("total = "+total);
				document.getElementById("total").value = total;
				var total_balance = (parseFloat(remaining_balance) + parseFloat(total)).toFixed(2); alert("close balance= "+ total_balance);
				document.getElementById("close_balance").value = total_balance;
			}
</script>

</body>
</html>
