<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Rent Collection";
$page_title = "View Rent Collection";
$msg = "";
$error_msg = "";

$params['collection_id'] = $collection_id = $_GET['id'];

$download_args = "action=export&page=rentcollection_view&collection_id=$collection_id";

$data = rentcollection_row_select_single($params);
//echo "<pre>";print_r($data);echo "</pre>";
$result = isset($data[0]) ? $data[0] : array();
//echo "<pre>";print_r($result);echo "</pre>";

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
            <a href="rentcollection_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Rent Collection</a>
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
                    </tr>
                  </thead>
                  <tbody>
				  <tr>
				  <td><?php echo isset($result['owner_name']) ? ucfirst( $result['owner_name'] ) : '';?></td>
				  <td><?php echo isset($result['building_complex']) ? ucfirst( $result['building_complex'] ) : '';?></td>
				  <td><?php echo isset($result['tenant_name']) ? ucfirst( $result['tenant_name'] ) : '';?></td>
				  <td><?php echo isset($result['collection_door']) ? $result['collection_door'] : '';?></td>
				  <td><span>&#8377; </span><?php echo isset($result['collection_rentamount']) ? $result['collection_rentamount'] : '';?></td>
				  </tr>
				  </tbody>
				  </table>
				  </div>
			  </div>
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Payment Details</h6></div>
			  
			  <div class="form-row">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Paid Date</th>
					  <th>Receipt No.</th>
					  <th>Paid Type</th>
					  <th>Paid No.Of Month</th>
					  <th>Paid Amount</th>
                    </tr>
                  </thead>
                  <tbody>
				  <tr>
				  <td><?php echo isset($result['collection_pay_date']) ? frontend_date_format($result['collection_pay_date']) : '';?></td>
				  <td><?php echo isset($result['collection_pay_receipt_no']) ? $result['collection_pay_receipt_no'] : '';?></td>
				  <td><?php echo isset($result['collection_pay_type']) ? $result['collection_pay_type'] : '';?></td>
				  <td><?php echo isset($result['collection_pay_no_of_months']) ? $result['collection_pay_no_of_months'] : '';?></td>
				  <td><span>&#8377; </span><?php echo isset($result['colection_pay_total']) ? $result['colection_pay_total'] : '';?></td>
				  </tr>
				  </tbody>
				  </table>
				  </div>
			  </div>
			  
			  <?php $pay_type = isset($result['collection_pay_type']) ? $result['collection_pay_type'] : '';
			        if($pay_type == "cheque" ) {
                     $cheque = isset($result['collection_pay_cheque']) ? json_decode($result['collection_pay_cheque'],true) : array();
					 //echo "<pre>";print_r($cheque);echo "</pre>";
			   ?>
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Cheque Details</h6></div>
			  <div class="form-row">
			  <div class="table-responsive">
			  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Party Bank</th>
                      <th>Cheque Date</th>
					  <th>Cheque No.</th>
					  <th>Cheque Amount</th>
					  <th>Our bank</th>
					  <th>Attachement</th>
                    </tr>
                  </thead>
                  <tbody>
				  <tr>
				  <td><?php echo isset($cheque['cheque_bank']) ? $cheque['cheque_bank'] : '';?></td>
				  <td><?php echo isset($cheque['cheque_date']) ? frontend_date_format($cheque['cheque_date']) : '';?></td>
				  <td><?php echo isset($cheque['cheque_no']) ? $cheque['cheque_no'] : '';?></td>
				  <td><?php echo isset($cheque['cheque_amount']) ? $cheque['cheque_amount'] : '';?></td>
				  <td><?php echo isset($cheque['cheque_debosit_to']) ? $cheque['cheque_debosit_to'] : '';?></td>
				  <td>
				  <?php 
				  $attachement = isset($cheque['attachement']) ? $cheque['attachement'] : '';
				  if( !empty($attachement) ){
					  echo '<a target="_blank" title="View" href="uploads/rentcollection/'.$attachement.'" class="btn btn-success btn-icon-split btn-sm" style="padding:4px 8px">
							View
						  </a>';
				  } else {
					  echo "-";
				  }
				  ?>
				  </td>
				  </tr>
				  </tbody>
				  </table>
				  </div>
			  </div>
              <?php } ?>
			  
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
					if( count($data) > 0){
						$total_paid = 0;
						foreach($data as $row){
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
