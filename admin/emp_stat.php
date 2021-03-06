<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#emp_stat input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#emp_stat input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#emp_stat input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#emp_stat select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#emp_stat p{
	margin-bottom: 15px;
}

#emp_stat p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#emp_stat p span.error{
	color: #e46c6e;
}
#emp_stat #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#emp_stat #send:hover{
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
<h2 align="center">EMPLOYERS STATISTICS</h2><br />
<form method="post" action="add_emp_stat.php" name="emp_stat" id="emp_stat">
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
<p class="ex" align="left">NO. registered to date : &nbsp;&nbsp;<input class="only" type="text" size="25" name="reg_t_date" id="reg_t_date" /></p><br />
<p align="left" class="ex">NO. discovered during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="dis_d_month" id="dis_d_month" /></p><br />
<p align="left" class="ex">NO. registered during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="reg_d_month" id="reg_d_month" /></p><br />
<p align="left" class="ex">NO. contributing up-to-date : &nbsp;&nbsp;<input class="only" type="text" size="25" name="cont_t_date" id="cont_t_date" /></p><br />
<p align="left" class="ex">NO. defaulting : &nbsp;&nbsp;<input class="only" type="text" size="25" name="defaulting" id="defaulting" /></p><br />
<p align="left" class="ex">NO. of ordinary defaulters : &nbsp;&nbsp;<input class="only" type="text" size="25" name="ord_defaulting" id="ord_defaulting" /></p><br />
<p align="left" class="ex">NO. of chronic defaulters : &nbsp;&nbsp;<input class="only" type="text" size="25" name="chr_defaulting" id="chr_defaulting" /></p><br />
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
<script type="text/javascript" src="old_assets/val_emp_stat.js"></script>
</body>
</head>
</html>