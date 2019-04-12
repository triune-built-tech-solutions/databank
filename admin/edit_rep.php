<?php
require_once("header.php");

   
		if(isset($_GET['repId'])){
			$sn = $_GET['repId'];

		}
	
require_once("../functions/function.php");

if(isset($_POST['edit_rep']) && !empty($_POST['activities'])){
	$activities = $_POST['activities'];
	$archievements = $_POST['archievements'];
	$constraints = $_POST['constraints'];
	
	$activities = mysql_prep($activities);
	$archievements = mysql_prep($archievements);
	$constraints = mysql_prep($constraints);
	
	$edit = "UPDATE report_log SET activities = '$activities', achievements = '$archievements', constraints = '$constraints' WHERE id = $sn";
	
	mysqli_query( $connect, $edit) or
	die("Error connecting to server". mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: vet_report.php");
} else {
	header("location: vet_report.php");
}

require_once("../functions/function.php");
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
$result_rep = mysqli_query( $connect, $query_report);
while($row_rep = mysqli_fetch_array($result_rep)){
	$prog = $row_rep['prog_no'];
	$obj = $row_rep['obj_no'];
	$sub_prog = $row_rep['sub_prog_no'];
	$report_type = $row_rep['report_type'];
	$department = $row_rep['department'];
	$added_by = $row_rep['added_by'];
	$month = $row_rep['month'];
	$year = $row_rep['year'];
	$activity = $row_rep['activities'];
	$achievement = $row_rep['achievements'];
	$constraints = $row_rep['constraints'];
	
$prog_res = mysqli_query( $connect, "select * from prog_no where prog_no = $prog and prog_year = $year"); $prog_row = mysqli_fetch_array($prog_res);
}
if(isset($department)){
	$query_depart = "SELECT * FROM department where id = $department";
	$result_depart = mysqli_query( $connect, $query_depart);
		
		while($row_depart = mysqli_fetch_array($result_depart)){
			$department = $row_depart[1];
		}
} else {
	$query_unit = "SELECT * FROM unit where id = $unit";
	$result_unit = mysqli_query( $connect, $query_unit);
		
		while($row_unit = mysqli_fetch_array($result_unit)){
			$department = $row_unit[1];
		}
}
$month_query = mysqli_query( $connect, "select * from emonth where emonth_id = $month"); $month_row = mysqli_fetch_array($month_query);
?>
<table>
<tr><th colspan="8">View Report</th></tr>
<tr>
	<td colspan="8"><b>INDUSTRIAL TRAINING FUND</b>
	<?php echo "<strong><p>".strtoupper($department)." ".$year."</p><p>". strtoupper($division). "</p><p>". strtoupper($section) ."</p></strong>"; ?>
	</td>
</tr>
<tr><td><b>Report Type</b><br><hr>
<?php echo $report_type ?></td>
<td><b>Programme N<u>o</u></b><br><hr>
<?php echo $prog ?></td>
<td><b>Programme</b><br><hr>
<?php echo $prog_row[2] ?></td>
<td><b>Sub Prog. N<u>o</u></b><br><hr>
<?php echo $sub_prog ?></td>
<td><b>Objective N<u>o</u></b><br><hr>
<?php echo $obj ?></td>
<td><b>Department</b><br><hr>
<?php echo $department ?></td>
<td><b>Month</b><br><hr>
<?php echo $month_row[1] ?></td>
<td><b>Year</b><br><hr>
<?php echo $year ?></td>
</tr>

<form action="" method="post" name="edit_report" >
<tr><td colspan="8"><b>Activities</b><br><textarea rows="10" cols="145" name="activities" ><?php echo $activity ?></textarea></td></tr>
<tr><td colspan="8"><b>Achievements</b><br><textarea rows="10" cols="145" name="archievements" ><?php echo $achievement ?></textarea></td></tr>
<tr><td colspan="8"><b>Constraints</b><br><textarea rows="10" cols="145" name="constraints" ><?php echo $constraints ?></textarea></td></tr>
<tr><td colspan="8"><p align="center"><input type="submit" name="edit_rep" value="Save Changes"></p></td></tr>
</form>
</table>
<?php


?>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>

</body>
</head>
</html>