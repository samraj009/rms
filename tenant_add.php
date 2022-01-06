<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$page_name = "Tenant Particulars";
$page_title = "Add Tenant Particulars";
$msg = "";
$error_msg = "";

if( ISSET($_POST['save_button']) ) {
	
	if( !empty($_POST['tenant_owner']) && !empty($_POST['tenant_building']) && !empty($_POST['tenant_rent_amount']) && !empty($_POST['tenant_name']) && !empty($_POST['tenant_status']) && !empty($_POST['tenant_fromdate']) ) {
		
		$upload_file_name = "";
		if(isset($_FILES['tenant_agreement']) && !empty($_FILES['tenant_agreement']['name'])){
      $errors= array();
      $file_name = $_FILES['tenant_agreement']['name'];
      $file_size = $_FILES['tenant_agreement']['size'];
      $file_tmp = $_FILES['tenant_agreement']['tmp_name'];
      $file_type = $_FILES['tenant_agreement']['type'];
      $file_ext = explode('.',$_FILES['tenant_agreement']['name']);
	  $file_ext = strtolower($file_ext[1]);
      
      $extensions= array("jpeg","jpg","png","gif","pdf");
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
		  $upload_dir = "uploads/tenant_agreement/";
		  $new_file_name = "tenant_".time().".".$file_ext;
		  $upload_file_name = $new_file_name;
         move_uploaded_file($file_tmp,$upload_dir.$new_file_name);
         //echo "Success";
      }else{
         //print_r($errors);
      }
   }
   $result = tenant_row_insert($upload_file_name);
   $msg = "Tenant particulars added";
	} else {
		$error_msg = "Please enter input fields";
	}	
} 

$owner_list = '';
$owner_lists = owner_row_select_multiple($params);

if( count($owner_lists) > 0 ){
	foreach($owner_lists as $row){
	$owner_list .= '<option value="'.$row['owner_id'].'">'.$row['owner_name'].'</option>';
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
              
			  <form name="building" method="post" action="<?php echo $form_action;?>" enctype="multipart/form-data">
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Building Details</h6></div>
			  
			  <div class="form-row">
			  
				  <div class="form-group col-md-3">
					  <label for="tenant_owner">Select owner <span class="required_field">&#8727;</span></label>
					  <select id="tenant_owner" name="tenant_owner" class="form-control">
						<option value="">Choose...</option>
						<?php echo $owner_list;?>
					  </select>
					  <span><a title="ADD OWNER" target="_blank" href="owner_add.php"><i class="fas fa-plus fa-sm"></i> ADD OWNER</a></span>
				   </div>
			   
				   <div class="form-group col-md-3">
					  <label for="tenant_building">Select Building <span class="required_field">&#8727;</span></label>
					  <select id="tenant_building" name="tenant_building" class="form-control">
						<option value="">Choose...</option>
					  </select>
					  <span><a title="ADD BUILDING" target="_blank" href="building_add.php"><i class="fas fa-plus fa-sm"></i> ADD BUILDING</a></span>
					</div>
					
					<div class="form-group col-md-3">
					  <label for="tenant_door">Door No <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="tenant_door" name="tenant_door" placeholder="Enter Door No" value="" />
					</div>
					
					<div class="form-group col-md-3">
					  <label for="tenant_rent_amount">Rent Amount(Monthly) <span class="required_field">&#8727;</span></label>
					  <input type="text" class="form-control" id="tenant_rent_amount" name="tenant_rent_amount" placeholder="Enter Rent Amount" value="" />
					</div>
	
			  </div>

			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Tenant Details</h6></div>
			  
			  <div class="form-row">
				  <div class="form-group col-md-4">
				  <label for="tenant_name">Tenant Name <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control" id="tenant_name" name="tenant_name" placeholder="Enter Tenant Name" value="" />
				</div>
				<div class="form-group col-md-4">
				  <label for="tenant_phone">Tenant Phone</label>
				  <input type="text" class="form-control" id="tenant_phone" name="tenant_phone" placeholder="Enter Tenant Phone" value="" />
				</div>
				<div class="form-group col-md-4">
				  <label for="tenant_email">Tenant Email</label>
				  <input type="text" class="form-control" id="tenant_email" name="tenant_email" placeholder="Enter Tenant Email" value="" />
				</div>
			  </div>
			  
			  <div class="form-row">
			    <div class="form-group col-md-4">
				  <label for="tenant_proof_type">Proof Type</label>
				  <select id="tenant_proof_type" name="tenant_proof_type" class="form-control">
					<option value="">Choose...</option>
					<option value="aadhar card">Aadhar card</option>
					<option value="driving licence">Driving licence</option>
					<option value="others">Others</option>
				  </select>
				</div>
				<div class="form-group col-md-4">
				  <label for="tenant_proof_value">Proof Value</label>
				  <input type="text" class="form-control" id="tenant_proof_value" name="tenant_proof_value" placeholder="Enter Proof Value" value="" />
				  </select>
				</div>
			  </div>
			  
			  <div class="form-row">
				<div class="form-group col-md-6">
					<label for="tenant_address">Tenant Address</label>
					<textarea class="form-control" id="tenant_address" name="tenant_address" placeholder="Enter Tenant Address" rows="2"></textarea>
		        </div>
			  </div>
			  
			  <div class="form-row">
			    <div class="form-group col-md-3">
				  <label for="tenant_city">City</label>
				  <input type="text" class="form-control" id="tenant_city" name="tenant_city">
				</div>
				<div class="form-group col-md-3">
				  <label for="tenant_district">District</label>
				  <input type="text" class="form-control" id="tenant_district" name="tenant_district">
				</div>
				<div class="form-group col-md-3">
				  <label for="tenant_state">State</label>
				  <select id="tenant_state" name="tenant_state" class="form-control">
					<option value="">Choose...</option>
					<option value="Tamilnadu" selected='selected'>Tamilnadu</option>
				  </select>
				</div>
				<div class="form-group col-md-3">
				  <label for="tenant_zipcode">Zip</label>
				  <input type="text" class="form-control" id="tenant_zipcode" name="tenant_zipcode">
				</div>
			  </div>
			  
			  <div class="form-row"><h6 class="font-weight-bold text-primary" style="margin:15px 0;">Rental Details</h6></div>
			  
			  <div class="form-row">
			    <div class="form-group col-md-2" style="margin-bottom:0;"><label>Agreement Document</label></div>
				<div class="form-group col-md-6">
				 <input type="file" class="custom-file-input" id="tenant_agreement" name="tenant_agreement">
				  <label class="custom-file-label" for="tenant_agreement">Choose file</label>
			    </div>
			  </div>
	        
			<div class="form-row">
			  <div class="form-group col-md-4">
				  <label for="tenant_advance_amount">Advance Amount</label>
				  <input type="text" class="form-control" id="tenant_advance_amount" name="tenant_advance_amount" placeholder="Enter Advance Amount" value="" />
			  </div>
			  <div class="form-group col-md-4">
				  <label for="tenant_advance_receiver">Advance Receiver</label>
				  <select id="tenant_advance_receiver" name="tenant_advance_receiver" class="form-control">
					<option value="">Choose...</option>
					<option value="owner">Owner</option>
					<option value="agent">Agent</option>
				  </select>
			 </div>
			</div>
			
			<div class="form-row">
			  <div class="form-group col-md-4">
				  <label for="tenant_status">Status <span class="required_field">&#8727;</span></label>
				  <select id="tenant_status" name="tenant_status" class="form-control">
					<option value="">Choose...</option>
					<option value="in" selected='selected'>Tenant In</option>
					<option value="out">Tenant Out</option>
				  </select>
			  </div>
			  <div class="form-group col-md-4">
				  <label for="tenant_fromdate">From Date <span class="required_field">&#8727;</span></label>
				  <input type="text" class="form-control datepicker" id="tenant_fromdate" name="tenant_fromdate" placeholder="" value="<?php echo date("d-m-Y");?>" />
			 </div>
			 <div class="form-group col-md-4" id="todate" style="display:none">
				  <label for="tenant_todate">To Date</label>
				  <input type="text" class="form-control datepicker" id="tenant_todate" name="tenant_todate" placeholder="" value="" />
			 </div>
			</div>
			
			<div class="form-row">
			  <div class="form-group col-md-4">
				  <label for="tenant_lastpaid">Last Paid</label>
				  <input type="text" class="form-control" id="tenant_lastpaid" name="tenant_lastpaid" placeholder="" value="" />
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
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    //startDate: '-3d'
});

$("#tenant_lastpaid").datepicker( {
    format: "yyyy-mm",
    startView: "months", 
    minViewMode: "months"
});

$("#tenant_status").on("change", function() {
  var value = $(this).val();
  if(value == 'out') {
	  $('#todate').css("display","inline-block");
  }  else {
	  $('#todate').css("display","none");
  }
});

$("#tenant_owner").on("change", function() {
  var value = $(this).val();
  if( value.length != 0 ) {
	  //alert('not empty string');
	  get_buildings();
  } else {
	  //alert('empty string');
  }
});

function get_buildings(){
	var owner_id = $("#tenant_owner").val();
	$("#tenant_building").find('option').not(':first').remove();
	var datastring = "owner_id="+owner_id;
	 $.ajax({
        url: "ajax_get_buildings.php",
        type: "post",
        data: datastring ,
        success: function (data) {
			//console.log(data);
			//alert('success');
			$("#tenant_building").append(data);
        },
        error: function() {
           //alert('error');
        }
    });
}

</script>

</body>
</html>
