<?php
require_once("header.php");
$sn = $_GET['repId'];
?>
<link rel="stylesheet" href="../old_assets/css/print.css" media="print" />
<style>
.print {
	padding:10px 30px;
	float:right;
	font-size:14px;
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
		$division = $row_div[2];
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
<?php
$query_report = "SELECT * from scheduled_part where id = $sn";

//get off_loc, month, year 

//select * where off_loc == && month == && year ==

$result_rep = mysqli_query( $connect, $query_report);
while($row_rep = mysqli_fetch_array($result_rep)){
	$of_ty = $row_rep['office_type'];
	$of_lo = $row_rep['office_loc'];
	$month = $row_rep['month'];
	$year = $row_rep['year'];
	$name = $row_rep['name'];
	$org = $row_rep['org'];
	$gen = $row_rep['gender'];
	$email = $row_rep['email'];
	$address = $row_rep['address'];
	$phone = $row_rep['phone'];
	$qualification = $row_rep['qualification'];
	$designation = $row_rep['designation'];
	$sector = $row_rep['sector'];
	$prog_title = $row_rep['prog_title'];
	$added_date = $row_rep['added_date'];
	$added_by = $row_rep['added_by'];
}



	$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$month'";
				$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
				$stateFetch1 = mysqli_fetch_assoc($stateResult1);
				$shwmon =$stateFetch1['emonth'];

		$stateSql12 = "SELECT * FROM office_type WHERE id='$of_ty'";
				$stateResult12 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql12);
				$stateFetch12 = mysqli_fetch_assoc($stateResult12);
				$shwmon2 =$stateFetch12['type'];

		$stateSql13 = "SELECT * FROM area_office WHERE id='$of_lo'";
				$stateResult13 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql13);
				$stateFetch13 = mysqli_fetch_assoc($stateResult13);
				$shwmon3 =$stateFetch13['area_office_name'];
			
?>





<table style="font-weight: bold; align-content: center; font-size: ">

<div >
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="staff_inf" id="staff_inf">
<input type="hidden" value="<?php echo $repo; ?>" name="repo" />

<tr><td >Office Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shwmon2; ?></td></tr>
<tr><td >Office Location: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shwmon3; ?></td></tr>
<tr><td >Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $year; ?></td></tr>
<tr><td >Month: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shwmon; ?></td></tr>
<tr><td >Program Title :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $prog_title; ?></td></tr>
<tr><td >Participant Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name; ?></td></tr>
<tr><td >Organization :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $org; ?></td></tr>
<tr><td >Designation :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $designation; ?></td></tr>
<tr><td >Sector :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sector; ?></td></tr>
<tr><td >Qualification :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $qualification; ?></td></tr>
<tr><td >Gender :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $gen; ?></td></tr>
<tr><td >Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $email; ?></td></tr>
<tr><td >Address :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $address; ?></td></tr>
<tr><td >Phone :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $phone; ?></td></tr>
</form>
</div>
</table>




















<div align="center" id="page_num">
<?php
$next = ($stat+1);
// let's create the dynamic links now
if ($stat > 1) {
	 $url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=".--$stat;
	 echo "<a href=\"$url\">Previous</a>";
}
// page numbering links now
for ($i = 1; $i <= $pages; $i++) {
	if($i == 50)
			break;
	 $url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=".$i;
	 echo "  <a href=\"$url\">$i</a>  ";
}
if (isset($_GET['stat']) && $_GET['stat'] < $pages) {
  	$url = $_SERVER['PHP_SELF']."?repId=".$sn."&stat=$next";
  	echo "<a href=\"$url\">Next</a>";
}

?>
</div>
<div>

</div>

</div><!-- close content --><A class="print" HREF="javascript:window.print()">Print This Page</A>
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>