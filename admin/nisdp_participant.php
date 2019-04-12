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
?>
</div>
<hr />
<div id="pag">
&nbsp;&nbsp;&nbsp;&nbsp;
<p class="sid"><a href="view_nisdp.php">View Trainee</a></p>
</div>
<div id="page">
<h2 align="center">TRAINEE DETAIL</h2><br />
<form method="post" action="process_nisdp_part.php" name="scheduled" id="scheduled">
<p align="left" class="ex">Office Type :
<select class="only" name="off_type"><option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option></select></p><br />
<p align="left" class="ex">Office Location : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="off_loc"><option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option></select></p><br />
<p align="left" class="ex">Month : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_month" id="rep_month"><option value=" ">-Month-</option>
<?php
$query_emonth = "Select * from emonth";
$result_emonth = mysqli_query( $connect, $query_emonth);

while($row_emonth = mysqli_fetch_array($result_emonth)){
	echo "<option value='".$row_emonth[0]."'>". $row_emonth[1] . "</option>";
}
?>
</select></p><br />
<p align="left" class="ex">Year : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_year" id="rep_year"><option value=" ">-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p><br />
<p class="ex" align="left">Program Name: &nbsp;&nbsp;<select class="only" id="gender" name="gender">
	<option value=" ">--Please 	Select--</option>
	<option value="National Industrial Skills Development Programme (NISDP)">National Industrial Skills Development Programme (NISDP)</option>
	<option value="Passion To Profession Programme (P2PP)">Passion To Profession Programme (P2PP)</option>
	<option value="Mobile Skills Training Initiative (MSTI)">Mobile Skills Training Initiative (MSTI)</option>
	<option value="Women Skills Empowerment Programme (WOSEP)">Women Skills Empowerment Programme (WOSEP)</option>
	<option value="Construction Skills Empowerment Programme (CONSEP)">Construction Skills Empowerment Programme (CONSEP)</option>
	<option value="Skills Training Empowerment Programme For Physically Challenged (STEP-C)">Skills Training Empowerment Programme For Physically Challenged (STEP-C)</option>
	<option value="Infotech Skills Empowerment Programme (ISEP)">Infotech Skills Empowerment Programme (ISEP)</option>

</select></p><br />
<p align="left" class="ex">Name of Trainee: &nbsp;&nbsp;<input class="only" type="text" size="25" name="participants" id="participants" /></p><br />
<p align="left" class="ex">Trade Area: &nbsp;&nbsp;<input class="only" type="text" size="25" name="organization" id="organization" /></p><br />
<p class="ex" align="left">Gender : &nbsp;&nbsp;<select class="only" id="gender" name="gender"><option value=" ">--Gender--</option>
<?php
$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender order by gender_name");
while($row_gender = mysqli_fetch_array($result_gender)){
	echo "<option value='".$row_gender[1]."'>".$row_gender[1]."</option>";
}

?>
</select></p><br />
<p class="ex" align="left">Qualification : &nbsp;&nbsp;<select class="only" id="qual" name="qual"><option value=" ">--Qualification--</option>
<option value="none"> None </option>
<option value="primary"> Primary </option>
<option value="secondary"> Secondary </option>
<option value="OND"> OND </option>
<option value="HND"> HND </option>
<option value="NCE"> NCE </option>
<option value="BSc"> BSc </option>
<option value="PGD"> PGD </option>
<option value="MSc"> MSc </option>
<option value="PhD"> PhD </option>
<option value="Professional"> Professional Qualification </option>
</select>
</p><br />
<p class="ex" align="left">E-mail : &nbsp;&nbsp;<input class="only" type="text" size="25" name="email" id="email" /></p><br />
<p class="ex" align="left">Address : &nbsp;&nbsp;<input class="only" type="text" size="25" name="address" id="address" /></p><br />
<p align="left" class="ex">Phone Number : &nbsp;&nbsp;<input class="only" type="text" size="25" name="phone" id="phone" /></p><br />
<p align="left" class="ex">Training Center : &nbsp;&nbsp;<input class="only" type="text" size="25" name="train_center" id="train_center" /></p><br />
<p align="left" class="ex">Date of Enrolment  : &nbsp;&nbsp;<input class="only" type="text" size="25" name="enrol" id="popupDatepicker" /></p><br />
<p align="left" class="ex">Date of Graduation   : &nbsp;&nbsp;<input class="only" type="text" size="25" name="grad" id="popupDatepicker1" /></p><br />
<p align="center"><input type="submit" id="send" value="Submit" name="submit" /></p><br />
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