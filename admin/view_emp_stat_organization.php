<?php
require_once("header.php");

if(isset($_GET['id']))
	$taker = $_GET['id'];

?>
<div id="content"><!-- open content -->
<div id="depart">
<?php
if(isset($department)){
	$query_dept = "SELECT * FROM department where id = $department";
	$result_dept = mysqli_query( $connect, $query_dept);
	
	while($row_dept = mysqli_fetch_array($result_dept)){
		$department = $row_dept[1];
		echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
	}
} else {
	$query_unit = "SELECT * FROM unit where id = $unit";
	$result_unit = mysqli_query( $connect, $query_unit);
		
		while($row_unit = mysqli_fetch_array($result_unit)){
			$department = $row_unit[1];
			echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> UNIT:</span> " . $row_unit[1] . ".&nbsp;&nbsp;&nbsp;";
		}
}
if(isset($division)){
	$query_div = "SELECT * FROM division where id = $division";
	$result_div = mysqli_query( $connect, $query_div);
	
	while($row_div = mysqli_fetch_array($result_div)){
		echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> DIVISION:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
	}
}else {
	$query_div = "SELECT * FROM sub_unit where id = $sub_unit";
	$result_div = mysqli_query( $connect, $query_div);
	
	while($row_div = mysqli_fetch_array($result_div)){
		$division = $row_div[2];
		echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SUB UNIT:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
	}
}
if(isset($section)){
	$query_section = "SELECT * FROM section where section_id = $section";
	$result_section = mysqli_query( $connect, $query_section);
	
	while($row_section = mysqli_fetch_array($result_section)){
		echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SECTION:</span> " . $row_section[2] . ".</p>";
	}
}
?>
</div>

<table>
<tr><th colspan="15">Defaulting Companies</th></tr>
<tr><th>S/n</th>
<th>Office Type</th>
<th>Office Location</th>
<th>Organization</th>
<th>Reg. No.</th>
<th>Address</th>
<th>Email</th>
<th>Sector</th>
<th>Phone No.</th>
<th>No. Of Employee</th>
<th>Status</th>
<th>Added by</th>
<th>Month</th>
<th>Year </th>
<th>Date Added</th>
</tr>
<?php
if(isset($_GET['err']) && $_GET['err'] == 'exist'){
	echo '<script>
			alert("Report for specified office and date already exist");
		</script>';
}

if(isset($_POST['begin_query'])){
	$month = $_POST['month']; 
	$year = $_POST['year'];
	$office_type = $_POST['office_type'];
	$office_location = $_POST['office_loc'];
	
	if($month !== " "){
		$opt = "where month = ".$month;
	}
	if($year !== " " && !isset($opt)){
		$opt = "where year = '".$year."'";
	} else if($year !== " " && isset($opt)){
		$opt .= " and year = ".$year;
	}
	if($office_type !== " " && !isset($opt)){
		$opt = "where office_type = ".$office_type;
	} else if($office_type !== " " && isset($opt)){
		$opt .= " and office_type = ".$office_type;
	}
	if($office_location !== " "){
		$opt .= " and office_location = ".$office_location;
	}
}

if(empty($opt)){
	$opt = " ";
}

$query_report_view = "select * from emp_stat where id = '".$taker."' order by year desc, month desc limit 80";

$result_report_view = mysqli_query( $connect, $query_report_view);

for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
	$rep_id = mysqli_result($result_report_view,  $i,  "id");
	$office_type = mysqli_result($result_report_view,  $i,  "office_type");
	$office_location = mysqli_result($result_report_view,  $i,  "office_location");
	$month = mysqli_result($result_report_view,  $i,  "month");
	$year = mysqli_result($result_report_view,  $i,  "year");
	$auto_date = mysqli_result($result_report_view,  $i,  "auto_date");
	$added_by = mysqli_result($result_report_view,  $i,  "added_by");
	$reg_t_date = mysqli_result($result_report_view,  $i,  "reg_t_date");
	$dis_d_month = mysqli_result($result_report_view,  $i,  "dis_d_month");
	$reg_d_month = mysqli_result($result_report_view,  $i,  "reg_d_month");
	$con_t_date = mysqli_result($result_report_view,  $i,  "con_t_date");
	$defaulting = mysqli_result($result_report_view,  $i,  "defaulting");
}

$query_part = "select * from comp_defaulting where office_type = ".$office_type." and office_loc = ".$office_location." and month = ".$month." and year = ".$year." order by name limit 80";

$result_part = mysqli_query( $connect, $query_part);

for($i=0; $i<mysqli_num_rows($result_part); $i++){
	$rep_id = mysqli_result($result_part,  $i,  "id");
	$office_type = mysqli_result($result_part,  $i,  "office_type");
	$office_location = mysqli_result($result_part,  $i,  "office_loc");
	$month = mysqli_result($result_part,  $i,  "month");
	$year = mysqli_result($result_part,  $i,  "year");
	$name = mysqli_result($result_part,  $i,  "name");
	$reg_no = mysqli_result($result_part,  $i,  "reg_no");
	$address = mysqli_result($result_part,  $i,  "address");
	$email = mysqli_result($result_part,  $i,  "email");
	$sector = mysqli_result($result_part,  $i,  "sector");
	$phone = mysqli_result($result_part,  $i,  "phone");
	$no_employee = mysqli_result($result_part,  $i,  "no_employee");
	$status = mysqli_result($result_part,  $i,  "status");
	$auto_date = mysqli_result($result_part,  $i,  "added_date");
	$added_by = mysqli_result($result_part,  $i,  "added_by");	
	
	
	$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_array($result_office)){
		$office_location = $row_office['2'];
	}
	
		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}

$query_office = "SELECT type FROM office_type where id = $office_type";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_assoc($result_office)){
		$office_name = $row_office['type'];
	}
$month_query = mysqli_query( $connect, "select * from emonth where emonth_id = $month"); $month_row = mysqli_fetch_array($month_query);

$ih = $i + 1;

echo '<tr>
<td bgcolor="'.$bg_color.'">'.$ih .'</td>
<td bgcolor="'.$bg_color.'">'. $office_name .'</td>
<td bgcolor="'.$bg_color.'">'. $office_location .'</td>
<td bgcolor="'.$bg_color.'">'.$name.'</td>
<td bgcolor="'.$bg_color.'">'.$reg_no.'</td>
<td bgcolor="'.$bg_color.'">'.$address.'</td>
<td bgcolor="'.$bg_color.'">'.$email.'</td>
<td bgcolor="'.$bg_color.'">'.$sector.'</td>
<td bgcolor="'.$bg_color.'">'.$phone.'</td>
<td bgcolor="'.$bg_color.'">'.$no_employee.'</td>
<td bgcolor="'.$bg_color.'">'.$status.'</td>
<td bgcolor="'.$bg_color.'">'.$added_by .'</td>
<td bgcolor="'.$bg_color.'">'.$month_row[1] .'</td>
<td bgcolor="'.$bg_color.'">'.$year .'</td>
<td bgcolor="'.$bg_color.'">'.$auto_date .'</td>
</tr>';
}

?>
</table>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
</body>
</head>
</html>