<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#new_train input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#new_train  input.none{
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

#new_train input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#new_train select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#new_train p{
	margin-bottom: 15px;
}

#new_train p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#new_train p span.error{
	color: #e46c6e;
}
#new_train #send{

}

#new_train #send:hover{
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

$qu = "select * from new_training where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$mon = $ro['month'];
	$yer = $ro['year'];
	$target = $ro['target'];
	$pro = $ro['proposed'];
	$tes = $ro['test_runned'];
	$par = $ro['participants'];
	$org = $ro['organizations'];
	$caty = $ro['category'];
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
<h2 align="center">NEW TRAINING PROGRAMMES PROPOSAL </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="new_train" id="new_train">
<input type="hidden" value="<?php echo $repo; ?>" name="repo" />
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
<p class="ex" align="left">Target : &nbsp;&nbsp;<input class="only" type="text" size="25" name="target" id="target" value="<?php echo $target ?>" /></p><br />
<p align="left" class="ex">NO. proposed : &nbsp;&nbsp;<input class="only" type="text" size="25" name="proposed" id="proposed" value="<?php echo $pro ?>" /></p><br />
<p align="left" class="ex">NO. Test runned : &nbsp;&nbsp;<input class="only" type="text" size="25" name="test_runned" id="test_runned" value="<?php echo $tes ?>" /></p><br />
<p align="left" class="ex">NO. of participants: &nbsp;&nbsp;<input class="only" type="text" size="25" name="participants" id="participants" value="<?php echo $par ?>" /></p><br />
<p align="left" class="ex">NO. of Organizations: &nbsp;&nbsp;<input class="only" type="text" size="25" name="organizations" id="organizations" value="<?php echo $org ?>" /></p><br />
<p align="left" class="ex">Training Category: &nbsp;&nbsp;<select class="only" name="category" id="category">
<option value="<?php echo $caty; ?>"><?php echo $caty; ?></option>
<option value="admin & management"> Admin & Management </option>
<option value="banking finance & allied"> Banking Finance & Allied </option>
<option value="capacity building"> Capacity Building </option>
<option value="environment, safety, health & security"> Environment, Safety, Health & Security </option>
<option value="engineering, vocational and technical"> Engineering Vocational and Technical</option>
<option value="ict">ICT</option>
<option value="msme">MSME</option>
<option value="ppit">PPIT</option>
<!--option value="CFE"> CFE Trainings </option-->
</select>
</p><br />
</select>
<p align="center"><input class="none" type="submit" value="Submit" name="submit" id="send" /></p><br />
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
	$category = $_POST['category'];
	$target = $_POST['target'];
	$proposed = $_POST['proposed'];
	$test_runned = $_POST['test_runned'];
	$participants = $_POST['participants'];
	$organizations = $_POST['organizations'];
	
	$staff_info = "UPDATE new_training SET month = '$rep_month', year = '$rep_year', category = '$category', target = $target, proposed = $proposed, test_runned = $test_runned, participants = $participants, organizations = $organizations where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_new_training.php");
}
?>
<script type="text/javascript" src="old_assets/val_new_train.js"></script>
</body>
</head>
</html>