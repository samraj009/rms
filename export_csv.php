<?php

set_time_limit(0);

include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}
	
$page_name = "Export";
$page_title = "Export CSV";

if( $_REQUEST['action'] == "export" && !empty( $_REQUEST['page'] )) {
	
	$page = $_REQUEST['page'];
	$owner_id = $params['owner_id'] = isset($_REQUEST['owner_id']) ? $_REQUEST['owner_id'] : '';
	$building_id = $params['building_id'] = isset($_REQUEST['building_id']) ? $_REQUEST['building_id'] : '';
	$tenant_id = $params['tenant_id'] = isset($_REQUEST['tenant_id']) ? $_REQUEST['tenant_id'] : '';
	$month = $params['month'] = isset($_REQUEST['month']) ? $_REQUEST['month'] : '';
	
	if( $page == "owner" ) {
		
		$result = owner_row_select_multiple($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "owner_master_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			$header = array("#","ID","Name","Phone","Email","Commision","Address","City","District","State","Zipcode","Date(Y-M-D)");
			fputcsv($fp, $header);
			
		foreach($result as $row){
		$i++;										 	
		$data = array($i,$row['owner_id'],$row['owner_name'],$row['owner_phone'],$row['owner_email'],$row['commision'],$row['owner_address'],$row['owner_city'],$row['owner_district'],$row['owner_state'],$row['owner_zipcode'],frontend_date_format($row["owner_created_date"]) );
		fputcsv($fp, $data);
		} // END : FOR EACH
		
		exit;
		
		} else {
			header("Location: owner_list.php?error_msg=export failed!");
		}
		
	} 
	
	elseif( $page == 'buildings' ){
		$result = building_row_select_multiple($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "building_particulars_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			$header = array("#","Owner Name","Building ID","Building Name","No Of Places","Address","City","District","State","Zipcode","Created Date(Y-M-D)");
			fputcsv($fp, $header);
			
		foreach($result as $row){
		$i++;										 	
		$data = array($i,ucfirst( $row['owner_name'] ),$row['building_id'],ucfirst( $row['building_complex'] ),$row['building_placeno'],$row['building_address'],$row['building_city'],$row['building_district'],$row['building_state'],$row['building_zipcode'],frontend_date_format($row["building_created_date"]) );
		fputcsv($fp, $data);
		} // END : FOR EACH
		
		exit;
		
		} else {
			header("Location: building_list.php?error_msg=export failed!");
		}
	}
	elseif( $page == 'tenants' ){
		$result = tenant_row_select_multiple($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "tenant_particulars_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			$header = array("#","Owner Name","Building Name","Tenant ID","Tenant Name","Phone","Advance","Rent Amount","Tenant Address","Status");
			fputcsv($fp, $header);
			
		foreach($result as $row){
		$i++;
        $address = "";
		$address .= !empty($row['tenant_address']) ? $row['tenant_address'].',' : '';
		$address .= !empty($row['tenant_city']) ? $row['tenant_city'].',' : '';
		$address .= !empty($row['tenant_district']) ? $row['tenant_district'].',' : '';
		$address .= !empty($row['tenant_state']) ? $row['tenant_state'] : '';
		$address .= !empty($row['tenant_zipcode']) ? '-'.$row['tenant_zipcode'] : '';
		$status = "";
		$status .= $row['tenant_status'];
		$status .= '('.frontend_date_format($row['tenant_fromdate']);
		$status .= ($row['tenant_todate'] != '0000-00-00') ? ' to '.frontend_date_format($row['tenant_todate']) : '';
		$status .= ')';
		$data = array($i,ucfirst( $row['owner_name'] ),ucfirst( $row['building_complex'] ),$row['tenant_id'],ucfirst( $row['tenant_name'] ),$row['tenant_phone'],$row['tenant_advance_amount'],$row['tenant_rent_amount'],$address,$status);
		fputcsv($fp, $data);
		} // END : FOR EACH
		
		exit;
		
		} else {
			header("Location: tenant_list.php?error_msg=export failed!");
		}
	}
	elseif( $page == 'rentcollection' ){
		$result = rentcollection_row_select_multiple($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "rent_collection_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			$header = array("#","Paid Date","Owner Name","Building Name","Tenant Name","Door No.","Rent Amount(Monthly)</span>","Paid Type","Paid No.Of Months","Paid Amount","Total");
			fputcsv($fp, $header);
			
		foreach($result as $row){
		$i++;
		$data = array($i,frontend_date_format($row['collection_pay_date']), ucfirst( $row['owner_name'] ),ucfirst( $row['building_complex'] ),ucfirst( $row['tenant_name'] ),$row['collection_door'],$row['collection_rentamount'],$row['collection_pay_type'],$row['collection_pay_no_of_months'],$row['collection_rentamount'],$row['colection_pay_total']);
		fputcsv($fp, $data);
		} // END : FOR EACH
		
		exit;
		
		} else {
			header("Location: rentcollection_list.php?error_msg=export failed!");
		}
	}
	elseif( $page == 'rentcollection_month' ){
		$result = rentcollection_monthly_row_select($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "rent_collection_month_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			$header = array("#","Paid Date","Rent Month","Owner Name","Building Name ","Tenant Name","Door No.","Rent Amount");
			fputcsv($fp, $header);
			
		foreach($result as $row){
		$i++;
		$data = array($i,frontend_date_format($row['rent_date']),$row['rent_month'],ucfirst( $row['owner_name'] ),ucfirst( $row['building_complex'] ),ucfirst( $row['tenant_name'] ),$row['tenant_door'],$row['tenant_rent_amount']);
		fputcsv($fp, $data);
		} // END : FOR EACH
		
		exit;
		
		} else {
			header("Location: rentcollection_list_monthly.php?error_msg=export failed!");
		}
	}
	elseif( $page == 'rentcollection_year' ){
		$result = rentcollection_year_paid_row_select($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-M-d");
			$csv_name = "rentcollection_year_downloads_";
			$csv_format = ".csv";
			$filename = $csv_name.$current_date.$csv_format;
			$fp = fopen('php://output', 'w');
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			
			$sel_year = !empty( $params['selected_year'] ) ? $params['selected_year'] : date("Y");
			$next_year = $sel_year+1;
			$result_year = array();
			$result_year[0] = $sel_year.'-04';
			$result_year[1] = $sel_year.'-05';
			$result_year[2] = $sel_year.'-06';
			$result_year[3] = $sel_year.'-07';
			$result_year[4] = $sel_year.'-08';
			$result_year[5] = $sel_year.'-09';
			$result_year[6] = $sel_year.'-10';
			$result_year[7] = $sel_year.'-11';
			$result_year[8] = $sel_year.'-12';
			$result_year[9] = $next_year.'-01';
			$result_year[10] = $next_year.'-02';
			$result_year[11] = $next_year.'-03';

			$header = array("Tenant Name","Rent Amount",$result_year[0],$result_year[1],$result_year[2],$result_year[3],$result_year[4],$result_year[5],$result_year[6],$result_year[7],$result_year[8],$result_year[9],$result_year[10],$result_year[11]);
			fputcsv($fp, $header);
			
		            $i = 0;
					$tenant_array = array();
					if( count($result) > 0 ){
						foreach($result as $row){
							$tenant_array[$i] = $row['rent_tenant'];
						$i++;
						$data = array(ucfirst( $row['tenant_name'] ),$row['tenant_rent_amount']);
					  foreach($result_year as $month){
							array_push($data,$row[$month]);
						}
                      fputcsv($fp, $data);
				    }
					} else {
						//echo "no data found";
					}
					$tenants = rentcollection_year_unpaid_row($params,$tenant_array);
					//echo "<pre>";print_r($tenants);echo "</pre>";
					if( count($tenants) > 0 ){
						foreach($tenants as $tenant){
							$data1 = array(ucfirst( $tenant['tenant_name'] ),$row['tenant_rent_amount']);
							for($x = 0; $x <= 11; $x++){
								array_push($data1,"-");
							}	
							fputcsv($fp, $data1);
						}	
					}
		
		exit;
		
		} else {
			header("Location: rentcollection_list_due.php?error_msg=export failed!");
		}
	}else {
		header("Location: index_rent.php");
	}	
	
	
} else {
	header("Location: index_rent.php");
}

?>	