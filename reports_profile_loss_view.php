<?php
require_once('config.php');
require_once('login_session_check.php');


$page_name = "Reports";
$page_title = "Profit & Loss A/c View";

$msg = "";
$error_msg = "";

$search_result = "";
$result = array();
$total_credit = "0";
$total_debit = "0";
$open_balance = "0";
$close_balance = "0";

//$sel_year = date("Y");

$cur_year = date("Y");
$cur_month = date("m");

	if($cur_month > 3){
		$sel_year = $cur_year;
	} else{
		$sel_year = $cur_year-1;
	}


if( ISSET($_POST['search_button']) ) {
	
	if( !empty($_POST['year']) ) {
		
		$search_result = "true";
		$sel_year = $_POST['year'];
		$result = reports_profit_loss_view();
		//echo "<pre>";print_r($result);echo "</pre>";
		
	} else {
		$error_msg = "Please enter input values";
	}	
}

// YEAR LIST
$current_year = date("Y");
$next_year = $current_year+1;

$yearArray = range(2019, $current_year);
$year_list = "";
foreach ($yearArray as $year) {
	$selected = ($year == $sel_year) ? 'selected="selected"' : '';
	$previous_year = $year;
	$next_year = $year+1;
	$option_text  = '1-April-'.$previous_year.' to 31-March-'.$next_year;
	$year_list .= '<option '.$selected.' value="'.$year.'">'.$option_text.'</option>';
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

  <title>Rent Management Software | <?php echo $page_name.' - '.$page_title; ?></title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  
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
			  
			  <div class="form-group col-md-4">
				  <label for="from_date">Select Account Year <span class="required_field">&#8727;</span></label>
				  <select id="year" name="year" class="form-control">
						<option value="">Choose...</option>
						<?php echo $year_list;?>
					  </select>
			  </div>
			  
			  <div class="form-group col-md-4">
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
			<table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Particulars</th>
					  <th>Debit</th>
					  <th>Particulars</th>
					  <th>Credit</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
					$i = 0;
					if( count($result) > 0 ){
						
						$commission = isset( $result[0]['commission_total'] ) ? $result[0]['commission_total'] : 0;
						$salary = isset( $result[0]['salary_total'] ) ? $result[0]['salary_total'] : 0;
					    $exp = isset( $result[0]['motor_total'] ) ? $result[0]['motor_total'] : 0;
						$motor = isset( $result[0]['exp_total'] ) ? $result[0]['exp_total'] : 0;
						
						$total_debits = $salary+$exp+$motor;
						
						if($commission > 0){
						$total_gross_profit = $commission - $total_debits;
						$total_net_profit = $commission - $total_debits;
						}else{
							$total_gross_profit = '';
						    $total_net_profit = '';
						}
						
						echo "<tr>
						<td>To Salary</td>
						<td>$salary</td>
						<td>By Commision A/c</td>
						<td>$commission</td>
						</tr>";
						
						echo "<tr>
						<td>To Motor</td>
						<td>$motor</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>To Exp</td>
						<td>$exp</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>To Gross Profit</td>
						<td>$total_gross_profit</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr style='background-color:#eee;font-weight:bold;color:red;'>
						<td>Total</td>
						<td>$commission</td>
						<td>Total</td>
						<td>$commission</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>By Gross Profit C/d</td>
						<td>$total_gross_profit</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>To Net Profit</td>
						<td>$total_net_profit</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						</tr>";
						
						echo "<tr style='background-color:#eee;font-weight:bold;color:red;'>
						<td>Total</td>
						<td>$total_net_profit</td>
						<td>Total</td>
						<td>$total_net_profit</td>
						</tr>";
						
					} else {
						echo "<tr><td colspan='4' align='center'>No data found.</tr>";
					}
					?>
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

</body>
</html>
