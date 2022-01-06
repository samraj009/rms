<?php
require_once('config.php');
require_once('login_session_check.php');

$page_name = "Entries";
$page_title = "Add Payments Entry";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['open_balance']) && !empty($_POST['date']) && !empty($_POST['account']) && !empty($_POST['particulars']) && !empty($_POST['amount']) && !empty($_POST['quantity']) && !empty($_POST['total'])  ) {
   
   if( $_POST['close_balance'] > 0 ) {
	   $result = payments_row_insert();
	    $msg = "Entry added";
   }else {
	   $error_msg = "no insufficient amount!";
   }
 
	} else {
		$error_msg = "Please enter input values";
	}	
}

$account_list = '';
$account_lists = accounts_head_row_select_multiple($params);

if( count($account_lists) > 0 ){
	foreach($account_lists as $row){
	$account_list .= '<option value="'.$row['account_id'].'">'.$row['account_name'].'</option>';
} // END: FOR EACH
} // END : IF


$balance_last_row = receipts_select_last_row();

//echo "<pre>";print_r($balance_last);echo "</pre>";

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
            <h1 class="h3 mb-0 text-gray-800"><?php echo "Payments"; ?></h1>
            <a href="payments_list.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-list fa-sm text-white-50"></i> List Payments Entry</a>
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
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Payments Details</h6></div>
			  
			  <div class="form-row">
			  
			  <div class="form-group col-md-6">
				  <label for="open_balance">Cash Balance &#8377; </label>
				  <input type="text" class="form-control" id="open_balance" name="open_balance" placeholder="" value="<?php echo "$open_balance";?>" readonly />
			  </div>
			  
			  <div class="form-group col-md-6">
				  <label for="close_balance">End Balance &#8377; </label>
				  <input type="text" class="form-control" id="close_balance" name="close_balance" placeholder="" value="" readonly />
			  </div>
			  
			  </div>
			  
			  <div class="form-row">
			  
			  <div class="form-group col-md-4">
				  <label for="date">Payments Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="date" name="date" placeholder="" value="<?php echo date("Y-m-d");?>" />
			  </div>

                 <div class="form-group col-md-4">
					  <label for="account">Select Ledger A/c <span class="required_field">&#8727;</span></label>
					  <select id="account" name="account" class="form-control">
						<option value="">Choose...</option>
						<?php echo $account_list;?>
					  </select>
					  <span><a title="ADD Ledger A/c" target="_blank" href="accountshead_add.php"><i class="fas fa-plus fa-sm"></i> ADD LEDGER A/c</a></span>
				   </div>

                    <div class="form-group col-md-4">
					  <label for="particulars">Particulars <span class="required_field">&#8727;</span></label>
					  <select id="particulars" name="particulars" class="form-control">
						<option value="">Choose...</option>
						<option value="building rent">BUILDING RENT</option>
						<option value="building rental share">BUILDING RENTAL SHARE</option>
						<option value="by cash">BY CASH</option>
						<option value="cash">CASH</option>
						<option value="cheque">CHEQUE</option>
						<option value="commission">COMMISSION</option>
						<option value="e.b">E.B</option>
						<option value="petrol">PETROL</option>
						<option value="salary">SALARY</option>
						<option value="tax">TAX</option>
						<option value="thoppu">THOPPU</option>
						<option value="transfer">TRANSFER</option>
					  </select>
				   </div>
				  </div> 

                <div class="form-row">
			  
				  <div class="form-group col-md-4">
					  <label for="amount">Amount <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="amount" name="amount" placeholder="" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onkeyup="calculate_total();"/>
				   </div>
			   
				   <div class="form-group col-md-4" style="display:none">
					  <label for="quantity">Quantity <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="quantity" name="quantity" placeholder="" value="1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" onkeyup="calculate_total();"/>
					</div>
					
				   <div class="form-group col-md-4" style="display:none">
					  <label for="total">Total <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="total" name="total" placeholder="" value="" readonly />
					</div>				
			  </div>	

             <div class="form-row">
			  <div class="form-group col-md-4">
				<label for="notes">Notes</label>
				<textarea class="form-control" id="notes" name="notes" placeholder="Enter Notes" rows="2"></textarea>
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
$('#date').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
});

function calculate_total(){
				var amount = document.getElementById("amount").value;
				var quantity = document.getElementById("quantity").value;
				var open_balance = document.getElementById("open_balance").value; 
				var remaining_balance = parseFloat(open_balance).toFixed(2); //alert("remaining_balance = "+remaining_balance);
				var total = parseFloat(amount * quantity).toFixed(2); //alert("total = "+total);
				document.getElementById("total").value = total;
				var total_balance = (parseFloat(remaining_balance) - parseFloat(total)).toFixed(2); //alert("close balance= "+ total_balance);
				document.getElementById("close_balance").value = total_balance;
			}
</script>

</body>
</html>
