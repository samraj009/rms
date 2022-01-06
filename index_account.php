<?php
require_once('config.php');
require_once('login_session_check.php');

$page_name = "Account Dashboard";
$page_title = "Account Dashboard";

//$balance_last_row = receipts_select_last_row();

//echo "<pre>";print_r($balance_last);echo "</pre>";

//$open_balance = isset( $balance_last_row[0]['close_balance'] ) ? $balance_last_row[0]['close_balance'] : '0.00';

$balance_last_row = balance_yearly_row_select($params);

//echo "<pre>";print_r($balance_last);echo "</pre>";

$open_balance = isset( $balance_last_row[0]['close_balance'] ) ? $balance_last_row[0]['close_balance'] : '0.00';

$total_ac = accounts_head_row_select_multiple($params);

//$total_payments = payments_row_select_multiple();

//$total_receipts = receipts_row_select_multiple();

$payments_data = payments_year_data($params);
if( count( $payments_data ) > 0 ){
$total_payments = array_sum(array_column($payments_data, 'total'));
} else {
	$total_payments = 0;
}

$receipts_data = receipts_year_data($params);
if( count( $payments_data ) > 0 ){
$total_receipts = array_sum(array_column($receipts_data, 'total'));
} else {
	$total_receipts = 0;
}



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
		
		<?php include_once('select_financial_year.php'); ?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $page_title; ?></h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-calendar fa-sm text-white-50"></i> <?php echo date("d-m-Y");?></a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">&#8377; <?php echo $open_balance; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total A/c Ledger</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo count( $total_ac ); ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Payments</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">&#8377; <?php echo $total_payments; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-minus-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Receipts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">&#8377; <?php echo $total_receipts; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Payments Chart</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height:360px;">
				<?php if( count($payments_data) > 0 ){ ?>
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
				<?php } else { echo "<p style='text-align:center;'>No data found.</p>"; } ?>  
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Payments Monthly Details</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height:360px;overflow:auto;">
                  <table class="table table-bordered" id="rentcollection_monthly_data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <td>#</td>
                      <th>Month</th>
                      <th>Total </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $i = 0;
				  $payments_monthly = "";
				  $payments_total = "";
					if( count($payments_data) > 0 ){
						foreach($payments_data as $row){
							$i++;
							$payments_monthly .= "'".$row['month']."',";
							$payments_total .= "'".$row['total']."',";
							echo "<tr>";
							echo "<td>".$i."</td>";
							echo "<td>".$row['month']."</td>";
							echo "<td>".$row['total']."</td>";
							echo '<td><a title="View" href="payments_list_monthly.php?month='.$row['month'].'" class="btn btn-warning btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fa fa-eye"></i></span>
						  </a></td>';
							echo "</tr>";
						}
					}else{
						echo "<tr><td colspan='4' align='center'>No data found.</tr>";
					}
					?>
				  </tbody>
				  </table>
                </div>
              </div>
            </div>
          </div>
		  
          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Receipts Chart</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height:360px;">
				<?php if( count($receipts_data) > 0 ){ ?>
                  <div class="chart-area">
                    <canvas id="myAreaChart1"></canvas>
                  </div>
				<?php } else { echo "<p style='text-align:center;'>No data found.</p>"; } ?>  
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Receipts Monthly Details</h6>
                  
                </div>
                <!-- Card Body -->
                <div class="card-body" style="height:360px;overflow:auto;">
                  <table class="table table-bordered" id="rentcollection_monthly_data" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <td>#</td>
                      <th>Month</th>
                      <th>Total </th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  <?php
				  $i = 0;
				  $receipts_monthly = "";
				  $receipts_total = "";
					if( count($receipts_data) > 0 ){
						foreach($receipts_data as $row){
							$i++;
							$receipts_monthly .= "'".$row['month']."',";
							$receipts_total .= "'".$row['total']."',";
							echo "<tr>";
							echo "<td>".$i."</td>";
							echo "<td>".$row['month']."</td>";
							echo "<td>".$row['total']."</td>";
							echo '<td><a title="View" href="receipts_list_monthly.php?month='.$row['month'].'" class="btn btn-warning btn-icon-split btn-sm">
							<span class="icon text-white-50"><i class="fa fa-eye"></i></span>
						  </a></td>';
							echo "</tr>";
						}
					}else{
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
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script>
  // Area Chart Example
var ctx = document.getElementById("myAreaChart1");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php echo rtrim($receipts_monthly,','); ?>],//["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Payments",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo rtrim($receipts_total,','); ?>],//[0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});  

// Area Chart Example
var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php echo rtrim($payments_monthly,','); ?>],//["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Payments",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [<?php echo rtrim($payments_total,','); ?>],//[0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '₹' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ₹' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>

</body>

</html>
