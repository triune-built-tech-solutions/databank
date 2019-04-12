<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#unscheduled input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#unscheduled input.none{
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

#unscheduled input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#unscheduled select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#unscheduled p{
	margin-bottom: 15px;
}

#unscheduled p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#unscheduled p span.error{
	color: #e46c6e;
}
#unscheduled #send{

}

#unscheduled #send:hover{
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
<h2 align="center">UNSCHEDULED TRAINING PROGRAMMES </h2><br />
<form method="post" action="add_unscheduled.php" name="unscheduled" id="unscheduled">
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
<p align="left" class="ex">Programme title: &nbsp;&nbsp;<input class="only" type="text" size="25" name="prog_title" id="prog_title" /></p><br />
<p class="ex" align="left">Target For The Year: &nbsp;&nbsp;<input class="only" type="text" size="25" name="training" id="training" /></p><br />
<p align="left" class="ex">NO. Implemented For The Month: &nbsp;&nbsp;<input class="only" type="text" size="25" name="implemented" id="implemented" /></p><br />
<p align="left" class="ex">NO. of participants: &nbsp;&nbsp;<input class="only" type="text" size="25" name="participants" id="participants" /></p><br />
<p align="left" class="ex">NO. of Organizations: &nbsp;&nbsp;<input class="only" type="text" size="25" name="organizations" id="organizations" /></p><br />
<p align="left" class="ex">Duration: &nbsp;&nbsp;<input class="only" type="text" size="25" name="duration" id="duration" /></p><br />
<p align="left" class="ex">Revenue from Course: &nbsp;&nbsp;<input class="only" type="text" size="25" name="revcors" id="revcors" /></p><br />
<p align="left" class="ex">Amount Collected: &nbsp;&nbsp;<input class="only" type="text" size="25" name="revenue" id="revenue" /></p><br />
<p align="left" class="ex">Amount Outstanding: &nbsp;&nbsp;<input class="only" type="text" size="25" name="revout" id="revout" /></p><br />
<p align="center"><input class="none" type="submit" id="send" value="Submit" name="submit" /></p><br />
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
<script type="text/javascript" src="old_assets/val_unsch_train.js"></script>
</body>
</head>
</html>