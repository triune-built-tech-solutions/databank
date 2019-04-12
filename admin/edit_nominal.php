<?php
require_once("header.php");
?>
<style>
p.sid a{
	font-size:15px;
	padding:10px;
	margin:0;
	color:#F00;
	font-style:italic;
}

div#pag {
	float:left;
	width:10%;
	padding:0 50px;
}

.not_visible {
	display:none;
}

div#page {
	float:left;
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
if(isset($_GET['repId'])){
	$query_report_view = "select * from nominal where id = ".$_GET['repId']." ";
	
	$result_report_view = mysqli_query( $connect, $query_report_view);
	
	for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
		$rep_id = mysqli_result($result_report_view,  $i,  "id");
		$surname = mysqli_result($result_report_view,  $i,  "surname");
		$other_name = mysqli_result($result_report_view,  $i,  "other_name");
		$staff_no = mysqli_result($result_report_view,  $i,  "staff_no");
		$sex = mysqli_result($result_report_view,  $i,  "sex");
		$job_title = mysqli_result($result_report_view,  $i,  "job_title");
		$date_appt = mysqli_result($result_report_view,  $i,  "date_appt");
		$dob = mysqli_result($result_report_view,  $i,  "dob");
		$state = mysqli_result($result_report_view,  $i,  "state");
		$added_date = mysqli_result($result_report_view,  $i,  "added_date");
		$added_by = mysqli_result($result_report_view,  $i,  "added_by");
	}
}
?>
</div>
<hr />
<div id="pag">
<p class="sid"><a href="view_nominal.php">View Nominal</a></p>
</div>
<div id="page">
<form method="post" action="process_edit_nominal.php" enctype="multipart/form-data" id="meet">
<p class="ex" align="left">Surname : <input class="only" type="text" size="40" name="surname" id="surname" value="<?php echo $surname; ?>" /></p><br />
<p class="ex" align="left">Other Names: <input class="only" type="text" size="40" name="other_name" id="other_name" value="<?php echo $other_name; ?>" /></p><br />
<p class="ex" align="left">Staff Number : <input class="only" type="text" size="40" name="staff_no" id="staff_no" value="<?php echo $staff_no; ?>" /></p><br />
<p class="ex" align="left">Sex : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="sex" id="sex"><option value=" ">-Gender-</option>
<?php
if($sex == 'M'){
	echo '<option value="F"> Female </option>
	<option value="M" selected="selected"> Male </option>';
} else if($sex == 'F'){
	echo '<option value="F" selected="selected"> Female </option>
	<option value="M"> Male </option>';
} else {
	echo '
	<option value="F"> Female </option>
	<option value="M"> Male </option>';
}
?>
</select>
</p><br />
<p class="ex" align="left">Job Title : <input class="only" type="text" size="40" name="job_title" id="job_title" value="<?php echo $job_title; ?>" /></p><br />
<p class="ex" align="left">Date of first Appt : <input class="only" type="text" size="40" name="doa" id="doa" value="<?php echo $date_appt; ?>" /></p><br />
<p class="ex" align="left">Date of Birth : <input class="only" type="text" size="40" name="dob" id="dob" value="<?php echo $dob; ?>" /></p><br />
<p align="left" class="ex">State of Origin : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="state" id="state"><option value=" ">-State-</option>
<?php
$query_emonth = "Select * from states";
$result_emonth = mysqli_query( $connect, $query_emonth);

while($row_emonth = mysqli_fetch_array($result_emonth)){
	if($row_emonth[1] == $state)
		echo "<option value='".$row_emonth[1]."' selected='selected'>". $row_emonth[1] . "</option>";
	else
		echo "<option value='".$row_emonth[1]."'>". $row_emonth[1] . "</option>";
}
?>
</select>
</p><br />
<input class="only not_visible" type="text" size="40" name="repid" id="repid" value="<?php echo $_GET['repId']; ?>" />
<p align="center"><input class="none" type="submit" id="send" value="Edit" name="submit" /></p><br />
</form>
</div>
<p class="both" />
</div><!-- close content -->

<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>