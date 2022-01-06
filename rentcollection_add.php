<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Rent Collection";
$page_title = "Add Rent Collection";
$msg = "";
$error_msg = "";

$selected_owner = '';

if( ISSET($_POST['save_button']) ) {
	
	//echo "<pre>";print_r($_REQUEST);echo "</pre>";
	
	if( !empty($_POST['rent_owner']) && !empty($_POST['rent_building']) && !empty($_POST['rent_tenant']) && !empty($_POST['rent_door']) && !empty($_POST['rent_amount']) && !empty($_POST['rent_pay_date']) && !empty($_POST['rent_pay_type']) && !empty($_POST['rent_pay_month']) && !empty($_POST['rent_pay_total']) ) {
		
		$selected_owner = $_POST['rent_owner'];
		
		$upload_file_name = "";
		if(isset($_FILES['rent_cheque']) && !empty($_FILES['rent_cheque']['name'])){
      $errors= array();
      $file_name = $_FILES['rent_cheque']['name'];
      $file_size = $_FILES['rent_cheque']['size'];
      $file_tmp = $_FILES['rent_cheque']['tmp_name'];
      $file_type = $_FILES['rent_cheque']['type'];
      $file_ext = explode('.',$_FILES['rent_cheque']['name']);
	  $file_ext = strtolower($file_ext[1]);
      
      $extensions= array("jpeg","jpg","png","gif","pdf");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
		  $upload_dir = "uploads/rentcollection/";
		  $new_file_name = "cheque_".time().".".$file_ext;
		  $upload_file_name = $new_file_name;
         move_uploaded_file($file_tmp,$upload_dir.$new_file_name);
         //echo "Success";
      }else{
         //print_r($errors);
      }
   }
   $result = rentcollection_row_insertv1($upload_file_name);
   $msg = "Rent collection added";
	} else {
		$error_msg = "Please fill the fields";
	}	
} 

$onwer_list = '';
$owner_lists = owner_row_select_multiple($params);

if( count($owner_lists) > 0 ){
	foreach($owner_lists as $row){
		
		$selected_class = ( $selected_owner == $row['owner_id'] ) ? 'selected' : '';
			
	$onwer_list .= '<option value="'.$row['owner_id'].'" '.$selected_class.'>'.$row['owner_name'].'</option>';
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
  
  <!-- datepicker css -->
  <link href="css/bootstrap-datepicker.min.css" rel="stylesheet">
  
  <!-- select search css -->
  <link href="css/bootstrap-select.min.css" rel="stylesheet">
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
              
			  <form name="rentcollection" method="post" action="<?php echo $form_action;?>" enctype="multipart/form-data">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Building Details</h6></div>
			  
			  <div class="form-row">
			  
				  <div class="form-group col-md-4">
					  <label for="rent_owner">Select owner <span class="required_field">&#8727;</span></label>
					  <select id="rent_owner" name="rent_owner" class="form-control">
						<option value="">Choose...</option>
						<?php echo $onwer_list;?>
					  </select>
					  <span><a title="ADD OWNER" target="_blank" href="owner_add.php"><i class="fas fa-plus fa-sm"></i> ADD OWNER</a></span>
				   </div>
			   
				   <div class="form-group col-md-4">
					  <label for="rent_building">Select Building <span class="required_field">&#8727;</span></label>
					  <select id="rent_building" name="rent_building" class="form-control">
						<option value="">Choose...</option>
					  </select>
					  <span><a title="ADD BUILDING" target="_blank" href="building_add.php"><i class="fas fa-plus fa-sm"></i> ADD BUILDING</a></span>
					</div>
					
			  </div>

			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Tenant Details</h6></div>
			  
			  <div class="form-row">
			  
			       <div class="form-group col-md-4">
					  <label for="rent_tenant">Select Tenant <span class="required_field">&#8727;</span></label>
					  <select id="rent_tenant" name="rent_tenant" class="form-control">
						<option value="">Choose...</option>
						<!--<option value="1">Tenant1</option>-->
					  </select>
					  <span><a title="ADD TENANT" target="_blank" href="tenant_add.php"><i class="fas fa-plus fa-sm"></i> ADD TENANT</a></span>
					</div>
			  
				  <div class="form-group col-md-4">
						  <label for="rent_door">Door No <span class="required_field">&#8727;</span></label>
						  <input type="text" class="form-control" id="rent_door" name="rent_door" placeholder="" value="" readonly />
				  </div>
					
				<div class="form-group col-md-4">
				  <label for="rent_amount">Rent Amount(Monthly) <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="rent_amount" name="rent_amount" placeholder="" value="" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  />
				</div>
					
			  </div>
			  
			  <div class="form-row">
			  
			      <div class="form-group col-md-3">
						  <label for="agent_commision">Agent commision (%) <span class="required_field">&#8727;</span></label>
						  <input type="text" class="form-control" id="agent_commision" name="agent_commision" placeholder="" value="" readonly />
				  </div>
				  
			      <div class="form-group col-md-3">
						  <label for="tenant_fromdate">Tenant From Date <span class="required_field">&#8727;</span></label>
						  <input type="text" class="form-control" id="tenant_fromdate" name="tenant_fromdate" placeholder="" value="" readonly />
				  </div>
				  
				  <div class="form-group col-md-3">
						  <label for="tenant_todate">Tenant To date</label>
						  <input type="text" class="form-control" id="tenant_todate" name="tenant_todate" placeholder="" value="" readonly />
				  </div>
				  
				  </div>
				  
				  <div class="form-row">
				  
				  <div class="form-group col-md-3">
						  <label for="rent_door">Tenant last paid Month <span class="required_field">&#8727;</span></label>
						  <input type="text" class="form-control" id="tenant_lastpaid" name="tenant_lastpaid" placeholder="" value="" readonly />
				  </div>
				  
				  <div class="form-group col-md-3">
						  <label for="rent_lastpaid_month">Rent last paid Month <span class="required_field">&#8727;</span></label>
						  <input type="text" class="form-control" id="rent_lastpaid_month" name="rent_lastpaid_month" placeholder="" value="" readonly />
				  </div>
				  
				  
				  
			  </div>

			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Payment Details</h6></div>
			  
			  <div class="form-row">
			  
			  <div class="form-group col-md-4">
				  <label for="rent_pay_date">Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="rent_pay_date" name="rent_pay_date" placeholder="" value="<?php echo date("d-m-Y");?>" />
				</div>
				
				<div class="form-group col-md-4">
				  <label for="rent_pay_receipt">Receipt No.</label>
				  <input type="text" class="form-control" id="rent_pay_receipt" name="rent_pay_receipt" placeholder="" value="" />
				  </div>
				  
				  <div class="form-group col-md-4">
					  <label for="rent_pay_type">Type <span class="required_field">&#8727;</span></label>
					  <select id="rent_pay_type" name="rent_pay_type" class="form-control">
					  <option value="">Choose...</option>
						<option value="cash" selected>Cash</option>
						<option value="cheque">Cheque</option>
					  </select>
				   </div>
				  
			   </div>
			  
			  <div id="ChequeDetails" style="display:none">
			    <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Cheque Details</h6></div>
				
				<div class="form-row">
			    <div class="form-group col-md-1" style="margin-bottom:0;"><label>Cheque</label></div>
				<div class="form-group col-md-5">
				 <input type="file" class="custom-file-input" id="rent_cheque" name="rent_cheque">
				  <label class="custom-file-label" for="rent_cheque">Choose file</label>
			    </div>
				<div class="form-group col-md-2" style="margin-bottom:0;text-align: center;"><label>Cheque Amount</label></div>
				<div class="form-group col-md-4">
				<input type="text" class="form-control" id="rent_cheque_amount" name="rent_cheque_amount" placeholder="" value="" />
				</div>
			  </div>
			  
				  <div class="form-row">
				  
					  <div class="form-group col-md-3">
						  <label for="rent_cheque_bank">Party bank</label>
						  <input type="text" class="form-control" id="rent_cheque_bank" name="rent_cheque_bank" placeholder="" value="" />
					  </div>
					  
					  <div class="form-group col-md-3">
						  <label for="rent_cheque_no">Cheque No</label>
						  <input type="text" class="form-control" id="rent_cheque_no" name="rent_cheque_no" placeholder="" value="" />
					  </div>
					  
					  <div class="form-group col-md-3">
						  <label for="rent_cheque_date">Cheque Date</label>
						  <input type="text" class="form-control" id="rent_cheque_date" name="rent_cheque_date" placeholder="" value="" />
					  </div>
					  
					  <div class="form-group col-md-3">
						  <label for="rent_cheque_deposit_to">Our Bank</label>
						  <select id="rent_cheque_deposit_to" name="rent_cheque_deposit_to" class="form-control">
						  <option value="">Choose...</option>
							<option value="1">bank1</option>
						  </select>
						  <span><a title="ADD BANK" target="_blank" href="bank_add.php"><i class="fas fa-plus fa-sm"></i> ADD BANK</a></span>
					  </div>
					
				  </div>
			  </div>
			  
			  <div id="DueDetails">
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Due Details</h6></div>
			  

			  <div class="form-row" style="height:250px;overflow:auto;">
			  <table class="table table-bordered" id="dueTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <!-- <th style="text-align: center;">#</th> -->
					  <th>Due No</th>
                      <th>Due Month</th>
					  <th>Due Amount</th>
                    </tr>
                  </thead>
                  <tbody>
				  </tbody>
				  </table>
			  </div>
			  
			  <div class="form-row">
			  
				  <div class="form-group col-md-4">
					  <label for="rent_pay_month">No.Of Month <span class="required_field">&#8727;</span></label>
					  <input oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"  type="text" class="form-control" id="rent_pay_month" name="rent_pay_month" placeholder="" value="" />
				  </div>
				  
				  <div class="form-group col-md-4">
					  <label for="rent_pay_total">Total Amount <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="rent_pay_total" name="rent_pay_total" placeholder="" value="" readonly />
				  </div>
				
			  </div>
			  
			  </div><!--END: DueDetails-->
			  
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

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$('#rent_pay_date').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '-3d'
});

$('#rent_cheque_date').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d'
});

$("#rent_pay_type").on("change", function() {
  var value = $(this).val();
  if(value == 'cheque') {
	  $('#ChequeDetails').css("display","block");
  }  else {
	  $('#ChequeDetails').css("display","none");
  }
});

$("#rent_owner").on("change", function() {
  var value = $(this).val();
  if( value.length != 0 ) {
	  //alert('not empty string');
	  get_buildings();
  } else {
	  //alert('empty string');
  }
});

<?php if( !empty( $selected_owner ) ) { ?>
get_buildings();
<?php } ?>


function get_buildings(){
	var owner_id = $("#rent_owner").val();
	$("#rent_building").find('option').not(':first').remove();
	var datastring = "owner_id="+owner_id;
	 $.ajax({
        url: "ajax_get_buildings.php",
        type: "post",
        data: datastring ,
        success: function (data) {
			//console.log(data);
			//alert('success');
			$("#rent_building").append(data);
        },
        error: function() {
           //alert('error');
        }
    });
}

$("#rent_building").on("change", function() {
  var value = $(this).val();
  if( value.length != 0 ) {
	  //alert('not empty string');
	  get_tenants();
  } else {
	  //alert('empty string');
  }
});

function get_tenants(){
	var owner_id = $("#rent_owner").val();
	var building_id = $("#rent_building").val();
	$("#rent_tenant").find('option').not(':first').remove();
	var datastring = "owner_id="+owner_id+"&building_id="+building_id;
	 $.ajax({
        url: "ajax_get_tenants.php",
        type: "post",
        data: datastring ,
        success: function (data) {
			//console.log(data);
			//alert('success');
			$("#rent_tenant").append(data);
        },
        error: function() {
           //alert('error');
        }
    });
}

$("#rent_tenant").on("change", function() {
  var value = $(this).val();
  if( value.length != 0 ) {
	  //alert('not empty string');
	  tenant_details();
  } else {
	  //alert('empty string');
  }
});

function tenant_details(){
	var owner_id = $("#rent_owner").val();
	var building_id = $("#rent_building").val();
	var tenant_id = $("#rent_tenant").val();
	
	$("#rent_door").val('');
	$("#rent_amount").val('');
	
	$("#tenant_fromdate").val('');
	$("#tenant_lastpaid").val('');
	$("#tenant_todate").val('');
	
	$("#agent_commision").val('');
	
	$("#rent_lastpaid_month").val('');
			
	$('#dueTable tbody').empty();

	var datastring = "owner_id="+owner_id+"&building_id="+building_id+"&tenant_id="+tenant_id;
	 $.ajax({
        url: "ajax_tenant_details.php",
        type: "post",
        data: datastring ,
        success: function (data) {
			//console.log(data);
			var result = JSON.parse(data);
			//alert(result.tenant_door);
			
			$("#rent_door").val(result.tenant_door);
			$("#rent_amount").val(result.tenant_rent_amount);
			
			$("#tenant_fromdate").val(result.tenant_fromdate);
			$("#tenant_lastpaid").val(result.tenant_lastpaid);
			$("#tenant_todate").val(result.tenant_todate);
			
			$("#agent_commision").val(result.agent_commision);
			
			$("#rent_lastpaid_month").val(result.rent_lastpaid_month);
			
			$("#dueTable").append(result.duemonth);
        },
        error: function() {
           //alert('error');
        }
    });
}


$(".rent_duemonth").on("change", function() {
  var count = $('input:checkbox:checked').length;
  $("#rent_pay_month").val(count);
  var amount = $("#rent_amount").val();
  var total = parseInt(count*amount);
  $("#rent_pay_total").val(total);
});

function selectDueMonth(){ 
//alert('select due month');
  var count = $('input:checkbox:checked').length;
  $("#rent_pay_month").val(count);
  var amount = $("#rent_amount").val();
  var total = parseInt(count*amount);
  $("#rent_pay_total").val(total);
}

$("#rent_pay_month").keyup(function(){
	
  var count = $(this).val();
  if( count > 0 ){
  var amount = $("#rent_amount").val();
  var total = parseInt(count*amount);
  $("#rent_pay_total").val(total);
  }
});		

</script>

</body>
</html>
