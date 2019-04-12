<?php

	include("../includes/connections.php");

	$rep_year = $_POST['body'];

	$query_report = "SELECT * FROM report_log WHERE year = $rep_year";

	$result_rep = mysqli_query( $connect, $query_report);
	$total_records = mysqli_num_rows($result_rep);

	if ($total_records > 0) {
		echo json_encode($result_rep);
		var_dump($result_rep);
		die('Finished');
	}

	while($row_rep = mysqli_fetch_array($result_rep)){
		$prog = $row_rep['prog_no'];
		$sub_prog = $row_rep['sub_prog_no'];
		$obj = $row_rep['obj_no'];
		$report_type = $row_rep['report_type'];
		$department = $row_rep['department'];
		$unit = $row_rep['unit'];
		$added_by = $row_rep['added_by'];
		$month = $row_rep['month'];
		$year = $row_rep['year'];
		$activity = $row_rep['activities'];
		$achievement = $row_rep['achievements'];
		$constraints = $row_rep['constraints'];
		$of_ty = $row_rep['office_type'];
		$of_lo = $row_rep['office_location'];
	}


	//Fresh call

	$query_new = "SELECT * FROM report_log WHERE month = $month AND year = '$year' AND office_location = $of_lo ORDER BY prog_no, sub_prog_no, obj_no";

	$result = mysqli_query( $connect, $query_new);
	$total_records = mysqli_num_rows($result);
	$pages = ceil($total_records / $rowp);
	((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

	$query_new_view = $query_new." limit $stt, $rowp";

	$result_new_view = mysqli_query( $connect, $query_new_view);

	for($i=0; $i<mysqli_num_rows($result_new_view); $i++){
		$rep_id = mysqli_result($result_new_view,  $i,  "id");
		$office_type = mysqli_result($result_new_view,  $i,  "office_type");
		$office_location = mysqli_result($result_new_view,  $i,  "office_location");
		$prog_no = mysqli_result($result_new_view,  $i,  "prog_no");
		$sub_prog_no = mysqli_result($result_new_view,  $i,  "sub_prog_no");
		$obj_no = mysqli_result($result_new_view,  $i,  "obj_no");
		$activ = mysqli_result($result_new_view,  $i,  "activities");
		$achiv = mysqli_result($result_new_view,  $i,  "achievements");
		$const = mysqli_result($result_new_view,  $i,  "constraints");
		$department = mysqli_result($result_new_view,  $i,  "department");
		$unit = mysqli_result($result_new_view,  $i,  "unit");
		$added_by = mysqli_result($result_new_view,  $i,  "added_by");
		$month = mysqli_result($result_new_view,  $i,  "month");
		$year = mysqli_result($result_new_view,  $i,  "year");
		$io = $i + 1;
		
		$prog_res = mysqli_query( $connect, "select * from prog_no where prog_no = $prog_no and prog_year = $year"); $prog_row = mysqli_fetch_array($prog_res);
		$sub_prog_res = mysqli_query( $connect, "select * from sub_prog_no where sub_no = '$sub_prog_no' and sub_year = $year"); $sub_prog_row = mysqli_fetch_array($sub_prog_res);
		$obj_res = mysqli_query( $connect, "select * from obj_no where obj_no = '$obj_no' and sub_prog_no_id = '$sub_prog_no' and obj_year = $year"); $obj_row = mysqli_fetch_array($obj_res);
		
		$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
		$result_office = mysqli_query( $connect, $query_office);
		
		while($row_office = mysqli_fetch_array($result_office)){
			$office_location = $row_office['2'];
		}
		if($department == ""){
			$query_unit = "SELECT * FROM unit where id = $unit";
			$result_unit = mysqli_query( $connect, $query_unit);
			
			while($row_unit = mysqli_fetch_array($result_unit)){
				$department = $row_unit[1];
			}
		} else {
			$query_dept = "SELECT * FROM department where id = $department";
			$result_dept = mysqli_query( $connect, $query_dept);
			
			while($row_dept = mysqli_fetch_array($result_dept)){
				$department = $row_dept[1];
			}
		}
		
		echo '<tr>
		<td>'.$io .'</td>
		<td>'. $prog_no .'</td>
		<td>'. $prog_row[2] .'</td>
		<td>'. $sub_prog_no .'</td>
		<td>'.$sub_prog_row[3]  .'</td>
		<td>'. $obj_no .'</td>
		<td>'. $obj_row[3] .'</td>
		<td>'. $activ .'</td>
		<td>'.$achiv .'</td>
		<td>'.$const .'</td>
		</tr>';
	}
	//End call
?>