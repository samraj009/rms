<?php
include_once('config.php');

if( !ISSET($params['user_id']) && !empty($params['user_id']) ) {
	header("Location: login.php?error_msg=session_timeout");
}

include_once('lib/fpdf.php');

set_time_limit(0);
	
$page_name = "Export";
$page_title = "Export PDF";

if( $_REQUEST['action'] == "export" && !empty( $_REQUEST['page'] )) {
	
	
	$page = $_REQUEST['page'];
	
	$pdf = new FPDF();
    $pdf->AddPage('P','A4');
	
	if( $page == "owner" ) {
		
		$result = owner_row_select_multiple($params);
		$i = 0;
		if( count($result) > 0 ){
			$current_date = date("Y-m-d");
			$name = "owner_master_downloads_";
			$format = ".pdf";
			$filename = $name.$current_date.$format;
			$header = array("#","Owner ID","Name","Phone","Email","Commision","Address","City","District","State","Zipcode","Created Date");
			$pdf->SetFont('Arial','B',8);
			foreach($header as $column_heading){
				$pdf->Cell(16,6,$column_heading,1);
			}
			
		foreach($result as $row){
		$i++;										 	
		$data = array($i,$row['owner_id'],$row['owner_name'],$row['owner_phone'],$row['owner_email'],$row['commision'],$row['owner_address'],$row['owner_city'],$row['owner_district'],$row['owner_state'],$row['owner_zipcode'],date("Y-M-d", strtotime($row["owner_created_date"])));
		$pdf->SetFont('Arial','',8);
		$pdf->Ln();
		foreach($data as $column)
		$pdf->Cell(16,6,$column,1);
		} // END : FOR EACH
		
		$pdf->Output();
		exit;
		
		} else {
			header("Location: owner_list.php?error_msg=owner export failed due to no data found");
		}
		
	}else {
		header("Location: owner_list.php?error_msg=owner export failed");
	}
	
	
} else {
	header("Location: owner_list.php?error_msg=owner export failed");
}

?>	