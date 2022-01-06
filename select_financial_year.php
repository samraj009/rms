<?php
$query_string = !empty( $_SERVER['QUERY_STRING'] ) ? '?'.urlencode( $_SERVER['QUERY_STRING'] ) : '';
$form_action = $_SERVER['PHP_SELF'].$query_string;

// YEAR LIST
$current_year = date("Y");
$next_year = $current_year+1;

$yearArray = range(2019, $current_year);
$year_list = "";
foreach ($yearArray as $year) {
	$previous_year = $year;
	$next_year = $year+1;
	$text  = '1-April-'.$previous_year.' to 31-March-'.$next_year;
	$year_list .= '<a class="dropdown-item" href="select_year.php?year='.$previous_year.'&redirect='.$form_action.'">'.$text.'</a><div class="dropdown-divider"></div>';
}

$year_text = !empty($params['selected_year_text']) ? $params['selected_year_text'] : 'Select Year';
?>
<div class="row" style="margin-bottom:30px">
		<div class="col-lg-12">
             
              <div class="card position-relative">
                
                <div class="card-body">
                  <nav class="navbar navbar-expand navbar-light bg-light mb-4">
                    <a class="navbar-brand" href="javascript:;">Select The Financial Year</a>
                    <ul class="navbar-nav ml-auto">
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-calendar fa-sm"></i> <?php echo $year_text; ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animated--fade-in" aria-labelledby="navbarDropdown">
                          <?php echo $year_list; ?>
                        </div>
                      </li>
                    </ul>
                  </nav>
                   <p class="mb-0 small">Note: Please select the financial year.</p>
                </div>
              </div>
			  

            </div>
		</div>