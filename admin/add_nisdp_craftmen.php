<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#scheduled input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#scheduled input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#scheduled input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#scheduled select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#scheduled p{
	margin-bottom: 15px;
}

#scheduled p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#scheduled p span.error{
	color: #e46c6e;
}
#scheduled #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#scheduled #send:hover{
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
<h2 align="center"> NISDP MASTERCRAFTMEN DETAIL </h2><br />
<form method="post" action="process_nisdp_craftmen.php" name="nisdp_craftmen" id="nisdp_craftmen">
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
<p align="left" class="ex">Name of centre coordinator: &nbsp;&nbsp;<input class="only" type="text" size="25" name="craftman" id="craftman" /></p><br />
<p align="left" class="ex">Centre: &nbsp;&nbsp;<input class="only" type="text" size="25" name="centre" id="centre" /></p><br />
<p align="left" class="ex">Trade Area : &nbsp;&nbsp;<input class="only" type="text" size="25" name="trade_area" id="trade_area" /></p><br />
<p class="ex" align="left">Gender : &nbsp;&nbsp;<select class="only" id="gender" name="gender"><option value=" ">--Gender--</option>
<?php
$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender order by gender_name");
while($row_gender = mysqli_fetch_array($result_gender)){
	echo "<option value='".$row_gender[1]."'>".$row_gender[1]."</option>";
}

?>
</select></p><br />
<p class="ex" align="left">E-mail : &nbsp;&nbsp;<input class="only" type="text" size="25" name="email" id="email" /></p><br />
<p class="ex" align="left">Address : &nbsp;&nbsp;<input class="only" type="text" size="25" name="address" id="address" /></p><br />
<p align="left" class="ex">Phone Number : &nbsp;&nbsp;<input class="only" type="text" size="25" name="phone" id="phone" /></p><br />
<p align="center"><input type="submit" id="send" value="Submit" name="submit" /></p><br />
</form>
</div>
</td>
</tr></table>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script>
$('dd').filter('dd:nth-child(n+2)').hide();

$('dt').click( function() {
		$(this).next().siblings('dd').hide();
		$(this).next().show();
							 });
//$('.subject').click(removeClass('li.page'));

</script>
<script type="text/javascript" src="old_assets/val_sch_train.js"></script>
</body>
</head>
</html>