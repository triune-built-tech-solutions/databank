<?php
require_once("header.php");
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
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query">

<select name="month"><option value=" ">-Month-</option>
<?php
$query_emonth = "Select * from emonth";
$result_emonth = mysqli_query( $connect, $query_emonth);

while($row_emonth = mysqli_fetch_array($result_emonth)){
	echo "<option value='".$row_emonth[0]."'>". $row_emonth[1] . "</option>";
}
?>
</select> &nbsp;&nbsp;&nbsp;

<select name="year"><option value=" ">-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select>&nbsp;&nbsp;&nbsp;

<input type="submit" name="begin_query" value="Begin Query" />
</form>
</div><br />
<table>
<tr><th colspan="11">Staff Information Reports</th></tr>
<tr><th>S/n</th>
<th>Month</th>
<th>Year </th>
<th>Senior Staff</th>
<th>Junior Staff</th>
<th>Non Staff</th>
<th>Staff discipline</th>
<th>Total Staff</th>
</tr>
<?php
if(isset($_POST['begin_query'])){
	$month = $_POST['month']; 
	$year = $_POST['year'];
	
	if($month !== " "){
		$opt = "where month = ".$month;
	}
	if($year !== " " && !isset($opt)){
		$opt = "where year = '".$year."'";
	} else if($year !== " " && isset($opt)){
		$opt .= " and year = ".$year;
	}
}

if(empty($opt)){
	$opt = " ";
}

if($access_right == 4){
	$query_report_view = "select id, month, year, sum(senior_staff) AS senior, sum(junior_staff) AS junior, sum(non_staff) AS non, sum(staff_dis) AS discipline from staff_info $opt group by month, year order by year desc, month desc limit 40";
}

$result_report_view = mysqli_query( $connect, $query_report_view);

$overall = 0;
$overall_staff = 0;

for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
	$rep_id = mysqli_result($result_report_view,  $i,  "id");
	$month = mysqli_result($result_report_view,  $i,  "month");
	$year = mysqli_result($result_report_view,  $i,  "year");
	$senior_staff = mysqli_result($result_report_view,  $i,  "senior");
	$junior_staff = mysqli_result($result_report_view,  $i,  "junior");
	$non_staff = mysqli_result($result_report_view,  $i,  "non");
	$staff_dis = mysqli_result($result_report_view,  $i,  "discipline");
	
	$total_staff = $senior_staff+$junior_staff+$non_staff;
	$overall += $total_staff;

		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}
		
		$ie = $i + 1;
	
$month_query = mysqli_query( $connect, "select * from emonth where emonth_id = $month"); 

$month_row = mysqli_fetch_array($month_query);

echo '<tr>
<td bgcolor="'.$bg_color.'">'.$ie.'</td>
<td bgcolor="'.$bg_color.'">'.$month_row[1] .'</td>
<td bgcolor="'.$bg_color.'">'.$year .'</td>
<td bgcolor="'.$bg_color.'">'.$senior_staff.'</td>
<td bgcolor="'.$bg_color.'">'.$junior_staff .'</td>
<td bgcolor="'.$bg_color.'">'.$non_staff .'</td>
<td bgcolor="'.$bg_color.'">'.$staff_dis .'</td>
<td bgcolor="'.$bg_color.'">'.$total_staff .'</td>
</tr>';

$total_itf = $overall;
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