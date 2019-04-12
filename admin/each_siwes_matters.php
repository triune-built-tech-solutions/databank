<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#siwes_matters input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#siwes_matters input.none{
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
}

#siwes_matters input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#siwes_matters select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#siwes_matters p{
	margin-bottom: 15px;
}

#siwes_matters p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#siwes_matters p span.error{
	color: #e46c6e;
}
#siwes_matters #send{

}

#siwes_matters #send:hover{
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

$qu = "select * from siwes_matters where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$mon = $ro['month'];
	$yer = $ro['year'];
	$part = $ro['part_inst'];
	$orie = $ro['orien_d_month'];
	$zona = $ro['zonal_meet'];
	$stud = $ro['student_placed'];
	$srud = $ro['srudent_paid'];
	$amou = $ro['amount_paid'];
	$supv = $ro['supv_allowance'];
	$s_in = $ro['students_inv'];
	$esupv = $ro['student_eligable'];
	$as_in = $ro['students_inv'];
}
?>
<?php
				$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
				$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
				$stateFetch1 = mysqli_fetch_assoc($stateResult1);
				$shwmon =$stateFetch1['emonth'];
				$shwmonid =$stateFetch1['emonth_id'];
  				?>
<td>
<div id="exec">
<h2 align="center">SIWES MATTERS</h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="siwes_matters" id="siwes_matters">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p align="left" class="ex">Month : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="rep_month" id="rep_month"><option value=" <?php echo $shwmonid; ?>" /><?php echo $shwmon; ?></option>
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
<select class="only" name="rep_year" id="rep_year"><option value=" <?php echo $yer; ?>" /><?php echo $yer; ?></option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select>
</p><br />
<p class="ex" align="left">NO. of Participating institutions : &nbsp;&nbsp;<input class="only" type="text" size="25" name="part_inst" id="part_inst" value="<?php echo $part ?>" /></p><br />
<p align="left" class="ex">NO. of Orientations during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="orien_d_month" id="orien_d_month" value="<?php echo $orie ?>" /></p><br />
<p align="left" class="ex">NO. of Zonal Meetings : &nbsp;&nbsp;<input class="only" type="text" size="25" name="zonal_meet" id="zonal_meet" value="<?php echo $zona ?>" /></p><br />
<p align="left" class="ex">NO. of Students placed during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="std_plc_d_m" id="std_plc_d_m" value="<?php echo $stud ?>" /></p><br />

<p align="left" class="ex">NO. of Students Eligable for payment : &nbsp;&nbsp;<input class="only" type="text" size="25" name="std_eligable" id="std_eligable" value="<?php echo $esupv ?>"/></p><br />

<p align="left" class="ex">NO. of Student paid : &nbsp;&nbsp;<input class="only" type="text" size="25" name="std_paid" id="std_paid" value="<?php echo $srud ?>" /></p><br />
<p align="left" class="ex">Amount paid : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_paid" id="amt_paid" value="<?php echo $amou ?>" /></p><br />




<p align="left" class="ex">Supervising Allowance paid : &nbsp;&nbsp;<input class="only" type="text" size="25" name="sup_all_p" id="sup_all_p" value="<?php echo $supv ?>" /></p><br />
<p align="left" class="ex">No. of Student Involved : &nbsp;&nbsp;<input class="only" type="text" size="25" name="std_inv" id="std_inv" value="<?php echo $s_in ?>" /></p><br />
<p align="center"><input class="none" type="submit" value="Submit" name="submit" id="send" /></p><br />
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
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$part_inst = $_POST['part_inst'];
	$orien_d_month = $_POST['orien_d_month'];
	$zonal_meet = $_POST['zonal_meet'];
	$std_plc_d_m = $_POST['std_plc_d_m'];
	$std_paid = $_POST['std_paid'];
	$amt_paid = $_POST['amt_paid'];
	$sup_all_p = $_POST['sup_all_p'];
	$std_inv = $_POST['std_inv'];


	$std_eligable = $_POST['std_eligable'];
	
	$staff_info = "UPDATE siwes_matters SET month = '$rep_month', year = '$rep_year', part_inst = $part_inst, orien_d_month = $orien_d_month, zonal_meet = $zonal_meet, student_placed = $std_plc_d_m, student_eligable = $std_eligable, srudent_paid = $std_paid, amount_paid = $amt_paid, supv_allowance = $sup_all_p, students_inv = $std_inv where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_siwes_matters.php");
}
?>
<script type="text/javascript" src="old_assets/val_siwes_matters.js"></script>
</body>
</head>
</html>