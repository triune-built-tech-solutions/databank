<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#ind_train input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#ind_train input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#ind_train input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_train select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_train p{
	margin-bottom: 15px;
}

#ind_train p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#ind_train p span.error{
	color: #e46c6e;
}
#ind_train #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#ind_train #send:hover{
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
<h2 align="center">APPRENTICESHIP </h2><br />
<form method="post" action="add_industrial.php" name="ind_train" id="ind_train">
<p align="left" class="ex">Office Type :
<select class="only" name="off_type"><option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option></select></p><br />
<p align="left" class="ex">Office Location : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="off_loc"><option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option></select></p><br />
<p align="left" class="ex">Month : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_month" id="rep_month"><option value=" "> -Month- </option>
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
</select>
</p><br />
<p class="ex" align="left">No. of Promotional visits : &nbsp;&nbsp;<input class="only" type="text" size="25" name="prom_vis" id="prom_vis" /></p><br />
<p align="left" class="ex">No. of Appraisal Exercises : &nbsp;&nbsp;<input class="only" type="text" size="25" name="appraisal" id="appraisal" /></p><br />
<p align="left" class="ex">No. of Installed Schemes : &nbsp;&nbsp;<input class="only" type="text" size="25" name="inst_harm" id="inst_harm" /></p><br />
<p align="left" class="ex">No. of Harmonized Schemes : &nbsp;&nbsp;<input class="only" type="text" size="25" name="harm_skill" id="harm_skill" /></p><br />
<p align="left" class="ex">No. of Monitured Schemes : &nbsp;&nbsp;<input class="only" type="text" size="25" name="monitored" id="monitored" /></p><br />
<p align="left" class="ex">No. of Provisional Apprenticeship Approval: &nbsp;&nbsp;<input class="only" type="text" size="25" name="prov_appren" id="prov_appren" /></p><br />
<p align="left" class="ex">No. of Full Apprenticeship Approval: &nbsp;&nbsp;<input class="only" type="text" size="25" name="full_appren" id="full_appren" /></p><br />
<p align="center"><input type="submit" value="Submit" name="submit" id="send" /></p><br />
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
<script type="text/javascript" src="old_assets/val_ind_train.js"></script>
</body>
</head>
</html>