<?php
require_once("../includes/header.php");

require_once("../functions/function.php");
?>

<div id="content"><!-- open content -->
<style type="text/css">
#staff_inf input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#staff_inf input.none{
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 20px;
	width: 150px;
	height: 30px;
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#staff_inf input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#staff_inf select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#staff_inf p{
	margin-bottom: 15px;
}

#staff_inf p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#staff_inf p span.error{
	color: #e46c6e;
}
#staff_inf #send{
	
}

#staff_inf #send:hover{
	background: #79a7f1;
}

#error{
	margin-bottom: 20px;
	border: 1px solid #efefef;
}
</style>
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
<tr>
<?php
require_once("side_link.php");
?>
<td>
<div id="exec">
<h2 align="center">STAFF INFORMATION</h2><br />
<form method="post" action="add_staff_info.php" id="staff_inf">

<!--<p align="left" class="ex">Office Type : 
<select class="only"  name="off_type" id="office_t"><option value=" ">--Office type--</option>
<?php
$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
while($row_office_type = mysqli_fetch_array($result_office_type)){
	echo "<option value='".$row_office_type[0]."'>".$row_office_type[1]."</option>";
}
?>
</select></p><br />

<p align="left" class="ex">Office Location : &nbsp;&nbsp;&nbsp;&nbsp;
	<select class="only"  name="off_loc" id="office_loc">

</select></p><br />-->
<p align="left" class="ex">Office Type :
<select class="only" name="off_type"><option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option></select></p><br />
<p align="left" class="ex">Office Location : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" id="off_lo" name="off_loc"><option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option></select></p><br />
<p align="left" class="ex">Month : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_month" id="rep_month"><option value=" ">-Month-</option>
<?php
$query_emonth = "Select * from emonth";
$result_emonth = mysqli_query( $connect, $query_emonth);

while($row_emonth = mysqli_fetch_array($result_emonth)){
	echo "<option value='".$row_emonth[0]."'>". $row_emonth[1] . "</option>";
}
?>
</select>
</p><br />
<p align="left" class="ex">Year : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_year" id="rep_year"><option value=" ">-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select>
</p><br />
<p class="ex" align="left">NO. of Senior Staff : &nbsp;&nbsp;<input class="only" type="text" size="25" name="sen_staff" id="sen_staff" /></p><br />
<p align="left" class="ex">NO. of Junior Staff : &nbsp;&nbsp;<input class="only" type="text" size="25" name="jun_staff" id="jun_staff" /></p><br />
<p align="left" class="ex">Other Non-Staff (IT NYSC etc) : &nbsp;&nbsp;<input class="only" type="text" size="25" name="oth_staff" id="oth_staff" /></p><br />
<p align="left" class="ex">Staff disciplinary action during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="staff_dis" id="staff_dis" /></p><br />
<p ><input class="none" type="submit" id="send" value="Submit" name="submit" /></p><br />
</form>
</div>
</td>
</tr></table>
<script>
$('dd').filter('dd:nth-child(n+2)').hide();

$('dt').click( function() {
		$(this).next().siblings('dd').hide();
		$(this).next().show();
							 });
//$('.subject').click(removeClass('li.page'));

</script>
</div><!-- close content -->
<div id="divi">
&nbsp;
</div><br />
<div align="center" id="style1">
  <p><span style="color:#F00; display:inline">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</p></div>

<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript" src="old_assets/val_staff_inf.js"></script>
</body>
</head>
</html>