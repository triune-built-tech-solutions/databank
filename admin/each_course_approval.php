<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#c_approval input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#c_approval input.none{
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

#c_approval input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#c_approval select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#c_approval p{
	margin-bottom: 15px;
}

#c_approval p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#c_approval p span.error{
	color: #e46c6e;
}
#c_approval #send{

}

#c_approval #send:hover{
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

$qu = "select * from course_approvals where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$mon = $ro['month'];
	$yer = $ro['year'];
	$requ = $ro['comp_request'];
	$cour = $ro['courses_appr'];
	$trai = $ro['trainees'];
	$appr = $ro['appr_prog'];
	$traf = $ro['trainees_f_c'];
	$invl = $ro['comp_invl'];

	$cappr = $ro['courses_app_over'];
	$rtraf = $ro['courses_rej'];
	$crinvl = $ro['courses_rej_over'];
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
<h2 align="center">COURSES APPROVAL</h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="c_approval" id="c_approval">
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
<p class="ex" align="left">NO. of companies requesting for approvals : &nbsp;&nbsp;<input class="only" type="text" size="25" name="comp_req" id="comp_req" value="<?php echo $requ ?>" /></p><br />


<p align="left" class="ex">NO. of courses approved (Local): &nbsp;&nbsp;<input class="only" type="text" size="25" name="cous_app" id="cous_app" value="<?php echo $cour ?>" /></p><br />
<p align="left" class="ex">NO. of courses approved (Oversea): &nbsp;&nbsp;<input class="only" type="text" size="25" name="cous_app_over" id="cous_app_over" value="<?php echo $cappr ?>" /></p><br />

<p align="left" class="ex">NO. of courses rejected (Local): &nbsp;&nbsp;<input class="only" type="text" size="25" name="cous_rej" id="cous_rej" value="<?php echo $rtraf ?>" /></p><br />
<p align="left" class="ex">NO. of courses rejected (Oversea): &nbsp;&nbsp;<input class="only" type="text" size="25" name="cous_rej_over" id="cous_rej_over" value="<?php echo $crinvl ?>" /></p><br />

<p align="left" class="ex">NO. of trainees for the course : &nbsp;&nbsp;<input class="only" type="text" size="25" name="trainees" id="trainees" value="<?php echo $trai ?>" /></p><br />
<p align="left" class="ex">NO. of approved programmes monitored : &nbsp;&nbsp;<input class="only" type="text" size="25" name="app_prog" id="app_prog" value="<?php echo $appr ?>" /></p><br />
<p align="left" class="ex">NO. of trainees for the course : &nbsp;&nbsp;<input class="only" type="text" size="25" name="trainees_f_c" id="trainees_f_c" value="<?php echo $traf ?>" /></p><br />
<p align="left" class="ex">NO. of companies involved : &nbsp;&nbsp;<input class="only" type="text" size="25" name="comp_invl" id="comp_invl" value="<?php echo $invl ?>" /></p><br />
<p align="center"><input class="none" type="submit" value="Submit" name="submit" id="send" />
</p><br />
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
	$comp_req = $_POST['comp_req'];
	$cous_app = $_POST['cous_app'];
	$trainees = $_POST['trainees'];
	$app_prog = $_POST['app_prog'];
	$trainees_f_c = $_POST['trainees_f_c'];
	$comp_invl = $_POST['comp_invl'];
		$cous_app_over = $_POST['cous_app_over'];

		$cous_rej = $_POST['cous_rej'];
	$cous_rej_over = $_POST['cous_rej_over'];
	
	$staff_info = "UPDATE course_approvals SET month = '$rep_month', year = '$rep_year', comp_request = $comp_req, courses_appr = $cous_app, trainees = $trainees, appr_prog = $app_prog, trainees_f_c = $trainees_f_c, comp_invl = $comp_invl, courses_app_over = $cous_app_over, courses_rej = $cous_rej, courses_rej_over = $cous_rej_over where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_course_approval.php");
}
?>
<script type="text/javascript" src="old_assets/val_c_approval.js"></script>
</body>
</head>
</html>