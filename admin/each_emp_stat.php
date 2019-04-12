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

$repo = $_GET['id'];

$qu = "select * from emp_stat where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$reg_t = $ro['reg_t_date'];
	$dis_d = $ro['dis_d_month'];
	$reg_d = $ro['reg_d_month'];
	$con_t = $ro['con_t_date'];
	$defau = $ro['defaulting'];
}
?>
<td>
<div id="exec">
<h2 align="center">EMPLOYERS STATISTICS</h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="emp_stat" id="emp_stat">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p class="ex" align="left">NO. registered to date : &nbsp;&nbsp;<input class="only" type="text" size="25" name="reg_t_date" id="reg_t_date" value="<?php echo $reg_t ?>" /></p><br />
<p align="left" class="ex">NO. discovered during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="dis_d_month" id="dis_d_month" value="<?php echo $dis_d ?>" /></p><br />
<p align="left" class="ex">NO. registered during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="reg_d_month" id="reg_d_month" value="<?php echo $reg_d ?>" /></p><br />
<p align="left" class="ex">NO. contributing up-to-date : &nbsp;&nbsp;<input class="only" type="text" size="25" name="cont_t_date" id="cont_t_date" value="<?php echo $con_t ?>" /></p><br />
<p align="left" class="ex">NO. defaulting : &nbsp;&nbsp;<input class="only" type="text" size="25" name="defaulting" id="defaulting" value="<?php echo $defau ?>" /></p><br />
<p align="center"><input type="submit" value="Change" name="submit" id="send" /></p><br />
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
<?php
$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$repo = $_POST['repo'];
	$reg_t_date = $_POST['reg_t_date'];
	$dis_d_month = $_POST['dis_d_month'];
	$reg_d_month = $_POST['reg_d_month'];
	$cont_t_date = $_POST['cont_t_date'];
	$defaulting = $_POST['defaulting'];
	
	$staff_info = "UPDATE emp_stat SET reg_t_date = $reg_t_date, dis_d_month = $dis_d_month, reg_d_month = $reg_d_month, con_t_date = $cont_t_date, defaulting = $defaulting where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}
?>
<script type="text/javascript" src="old_assets/val_emp_stat.js"></script>
</body>
</head>
</html>