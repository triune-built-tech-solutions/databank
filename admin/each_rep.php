<?php
require_once("header.php");
$sn = $_GET['repId'];
?>
<link rel="stylesheet" href="../old_assets/css/print.css" media="print" />
<style>
.print {
	padding:10px 30px;
	float:right;
	font-size:14px;
}

</style>
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
		$division = $row_div[2];
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
<?php
$query_report = "SELECT * from report_log where id = $sn";

//get off_loc, month, year 

//select * where off_loc == && month == && year ==

$result_rep = mysqli_query( $connect, $query_report);
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
if($department == ""){
	$query_dept = "SELECT * FROM unit where id = $unit";
	$result_dept = mysqli_query( $connect, $query_dept);
	
	while($row_dept = mysqli_fetch_array($result_dept)){
		$department = $row_dept[1];
	}
} else {
	$query_dept = "SELECT * FROM department where id = $department";
	$result_dept = mysqli_query( $connect, $query_dept);
	
	while($row_dept = mysqli_fetch_array($result_dept)){
		$department = $row_dept[1];
	}
}
$month_query = mysqli_query( $connect, "select * from emonth where emonth_id = $month"); $month_row = mysqli_fetch_array($month_query);
$loc_query = mysqli_query( $connect, "select * from area_office where office_type_id = $of_ty AND id = $of_lo"); $loc_row = mysqli_fetch_array($loc_query);
?>
<!-- SELECT * FROM  where  = $office_type and  = $office_location -->
<table>
<tr><th colspan="10" class="nttt">View Report</th></tr>
<tr>
	<td colspan="10"><b>INDUSTRIAL TRAINING FUND</b>
	<?php echo "<strong><p>".strtoupper($loc_row[2]).", ".$month_row[1]." ".$year."</p><p>". strtoupper($department). "</p></strong>"; ?>
	</td>
</tr>
<tr>
<th>S/N</th>
<th>Prog. N<u>o</u></th>
<th>Programme</th>
<th>Sub-Prog. N<u>o</u></th>
<th>Sub-Programme</th>
<th>Obj. N<u>o</u></th>
<th>Objectives</th>
<th>Activities</th>
<th>Achievements </th>
<th>Constraints </th>
</tr>
<?php
$rowp = 4;

if(!isset($_GET['stat'])){
	$stat = 1;
} else {
	$stat = $_GET['stat'];
}

$stt = (($stat * $rowp) - $rowp);

$query_new = "SELECT * from report_log where month = $month AND year = '$year' AND office_location = $of_lo order by prog_no, sub_prog_no, obj_no";

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

?>
</table>
<div align="center" id="page_num">
<?php
$next = ($stat+1);
// let's create the dynamic links now
if ($stat > 1) {
	 $url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=".--$stat;
	 echo "<a href=\"$url\">Previous</a>";
}
// page numbering links now
for ($i = 1; $i <= $pages; $i++) {
	if($i == 50)
			break;
	 $url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=".$i;
	 echo "  <a href=\"$url\">$i</a>  ";
}
if (isset($_GET['stat']) && $_GET['stat'] < $pages) {
  	$url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=$next";
  	echo "<a href=\"$url\">Next</a>";
}

?>
</div>
<div>

</div>

</div><!-- close content --><A class="print" HREF="javascript:window.print()">Print This Page</A>
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>