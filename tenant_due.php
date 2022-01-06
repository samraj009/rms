<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Tenant Particulars";
$page_title = "List Tenant Particulars";
$msg = "";
$error_msg = "";


$tenant_id = $params['tenant_id'] = isset($_REQUEST['tenant_id']) ? $_REQUEST['tenant_id'] : '';

$download_args = "action=export&page=tenant_due&tenant_id=$tenant_id";

$result = rentcollection_due_row_select($params);
//echo "<pre>";print_r($result);echo "</pre>";

$owner_name = isset( $result[0]['owner_name'] ) ? $result[0]['owner_name'] : '';
$building_complex = isset( $result[0]['building_complex'] ) ? $result[0]['building_complex'] : '';
$tenant_name = isset( $result[0]['tenant_name'] ) ? $result[0]['tenant_name'] : '';
$tenant_door = isset( $result[0]['tenant_door'] ) ? $result[0]['tenant_door'] : '';
$tenant_rent_amount = isset( $result[0]['tenant_rent_amount'] ) ? $result[0]['tenant_rent_amount'] : '';

$rent_lastpaid_month = isset( $result[0]['rent_month'] ) ? $result[0]['rent_month'] : '';
$tenant_lastpaid_month = isset( $result[0]['tenant_lastpaid'] ) ? $result[0]['tenant_lastpaid'] : '';
$tenant_from_date = isset( $result[0]['tenant_fromdate'] ) ? $result[0]['tenant_fromdate'] : '';
$tenant_to_date = isset( $result[0]['tenant_todate'] ) ? $result[0]['tenant_todate'] : '';
$tenant_status = isset( $result[0]['tenant_status'] ) ? $result[0]['tenant_status'] : '';

if( !empty($rent_lastpaid_month) ) {
	$start_date = "$rent_lastpaid_month-01";
} elseif( !empty($tenant_lastpaid_month) ) {
	$start_date = "$tenant_lastpaid_month-01";
} elseif( !empty($tenant_from_date) ) {
	
	//$start_date = $tenant_from_date;
	
	$start = new DateTime($tenant_from_date);
   $start->modify('last day of previous month');
   $start_date = $start->format("Y-m-d");
   
} else {
	$start_date = date('Y-m-d'); 
}
$to_todate = isset( $result[0]['tenant_todate'] ) ? $result[0]['tenant_todate'] : '';
if($to_todate == '0000-00-00'){
	$to_todate = '';
}	
$duemonth = rent_calculate_duemonth($start_date,$to_todate);

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
            <a href="tenant_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Tenant</a>
          </div>
		  
		  <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex">
              <div class="col-md-10"><h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title; ?></h6></div>
			  <div class="col-md-2">
			  
			  <div class="dropdown mb-2" style="float:right;margin-bottom:0px !important;">
                    <button class="btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Downloads
                    </button>
                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="exports/export_pdf.php?<?php echo $download_args;?>">PDF File</a>
                    </div>
                  </div>
			  </div>
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
              
			  <form name="rentcollection" method="post" action="<?php echo $form_action;?>" enctype="multipart/form-data">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Tenant Details</h6></div>
			  
			  <div class="form-row">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Owner Name</th>
					  <th>Building Name</th>
					  <th>Tenant Name</th>
					  <th>Door No.</th>
					  <th>Rent Amount <span style="font-size:12px;">(Monthly)</span></th>
					  <th>From Date</th>
					  <th>To Date</th>
					  <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <tr>
				  <td><?php echo ucfirst( $owner_name );?></td>
				  <td><?php echo ucfirst( $building_complex );?></td>
				  <td><?php echo ucfirst($tenant_name);?></td>
				  <td><?php echo $tenant_door;?></td>
				  <td><span>&#8377; </span><?php echo $tenant_rent_amount;?></td>
				  <td><?php if( $tenant_from_date != '0000-00-00' ){ echo frontend_date_format($tenant_from_date); } else { echo '-'; } ?></td>
				  <td><?php if( $tenant_to_date != '0000-00-00' ){ echo frontend_date_format($tenant_to_date); } else { echo '-'; } ?></td>
				  <td><?php echo $tenant_status;?></td>
				  </tr>
				  </tbody>
				  </table>
				  </div>
			  </div>
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Rent Collection Details</h6></div>
			  
			  <div class="form-row">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Paid Date</th>
					  <th>Rent Month</th>
					  <th>Paid Amount</th>
					  <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
					$i = 0;
					if( count($result) > 0 && !empty( $rent_lastpaid_month ) ){
						$total_paid = 0;
						foreach($result as $row){
						    echo "<tr>";
							echo "<td>".frontend_date_format($row['rent_date'])."</td>";
							echo "<td>".$row['rent_month']."</td>";
							echo "<td><span>&#8377; </span>".$row['rent_total']."</td>";
							echo "<td><span class='btn btn-success btn-sm'>Completed</span></td>";
							echo "</tr>";
							$i++;
							$total_paid = $total_paid + $row['rent_total'];
				        }
						echo "<tr style='background: #eee;'><td colspan='4' align='center'><b>Total Paid Amount <span>&#8377; </span> : $total_paid</b> </td></tr>";
					} else {
						echo "<tr><td colspan='4' align='center'>No data found.</td></tr>";
					}
					?>
				  </tbody>
				  </table>
				  </div>
			  </div>
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Due/Pending Details</h6></div>
			  
			  <div class="form-row">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
					  <th>Rent Month</th>
					  <th>Rent Amount</th>
					  <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
					$i = 0;
					if( count($duemonth) > 0 ){
						$total_due = 0;
						foreach($duemonth as $due){
							$i++;
							$total_due = $total_due+$tenant_rent_amount;
						    echo "<tr>";
							echo "<td>".$i."</td>";
							echo "<td>".$due['text']."</td>";
							echo "<td><span>&#8377; </span>".$tenant_rent_amount."</td>";
							echo "<td><span class='btn btn-danger btn-sm'>Pending</span></td>";
							echo "</tr>";
				        }
						echo "<tr style='background: #eee;'><td colspan='4' align='center'><b>Total Due Amount <span>&#8377; </span> : $total_due</b> </td></tr>";
					} else {
						echo "<tr><td colspan='4' align='center'>No data found.</td></tr>";
					}
					?>
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

</body>
</html>
