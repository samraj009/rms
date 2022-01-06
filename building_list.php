<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

$owner_id = $params['owner_id'] = isset($_REQUEST['owner_id']) ? $_REQUEST['owner_id'] : '';
$action = $params['action'] = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

$download_args = "action=export&page=buildings&owner_id=$owner_id";

$result = building_row_select_multiple($params);


$page_name = "Building Particulars";
$page_title = "List Building Particulars";
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $page_name; ?></h1>
            <a href="building_add.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Building</a>
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
                      <a class="dropdown-item" href="export_csv.php?<?php echo $download_args;?>">CSV File</a>
                    </div>
                  </div>
			  </div>
            </div>
            <div class="card-body">
			
			<?php 
			if(!empty($_REQUEST['msg']) ) { 
			echo '<div class="alert alert-success"><strong>Success!</strong> '.$_REQUEST['msg'].'</div>';
			}
			if(!empty($_REQUEST['error_msg']) ) { 
			echo '<div class="alert alert-danger"><strong>Failed!</strong> '.$_REQUEST['error_msg'].'</div>';
			}
			?>
			
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <td>#</td>
                      <th>Building Owner</th>
                      <th>Complex Name </th>
					  <th>No.of Place</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
					$i = 0;
					if( count($result) > 0 ){
						foreach($result as $row){
						$i++;
					  echo "<tr>";
					  echo "<td>".$i."</td>";
                      echo "<td>".ucfirst( $row['owner_name'] )."</td>";
                      echo "<td>".ucfirst( $row['building_complex'] )."</td>";
                      echo "<td>".$row['building_placeno']."</td>";
                      echo '<td>
					    <a title="List Tenants" href="tenant_list.php?building_id='.$row['building_id'].'" class="btn btn-success btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fas fa-users"></i></span>
						  </a>
						  <a title="Due/Pending" href="rentcollection_list_due.php?building_id='.$row['building_id'].'&action=search" class="btn btn-warning btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fas fa-calendar"></i></span>
						  </a>
						  <a title="List Rent Collection" href="rentcollection_list.php?building_id='.$row['building_id'].'" class="btn btn-secondary btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fas fa-briefcase"></i></span>
						  </a>
						  <a title="Edit" href="building_edit.php?id='.$row['building_id'].'" class="btn btn-info btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fas fa-pen"></i></span>
						  </a>
						<a title="Delete" href="building_delete.php?id='.$row['building_id'].'&action=delete" class="btn btn-danger btn-icon-split btn-sm" onclick="return delete_confirm()">
							<span class="icon text-white-50"><i class="fas fa-trash"></i></span>
						</a>';
					echo "</td>";
                    echo "</tr>";
				    }
					} else {
						//echo "<tr><td colspan='6' align='center'>No data found.</tr>";
					}
					?>	
                  </tbody>
                </table>
              </div>
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="vendor/datatables/dataTables.buttons.min.js"></script>
  <script src="vendor/datatables/buttons.print.min.js"></script>
  <script>
function delete_confirm() {
  var r = confirm("are you sure you want to delete?");
  if(r === true){
	  return true;
  } else {
	  return false;
  }
}
  </script>
</body>
</html>
