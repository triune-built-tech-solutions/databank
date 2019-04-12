<?php
require_once("header.php");

if(isset($_GET['repId'])){
	$tak_id = $_GET['repId'];
	$nom_id = $_GET['nomId'];
}
?>
<style>
p.sid a{
	font-size:15px;
	padding:10px;
	margin:0;
	color:#F00;
	font-style:italic;
}

div#pag {
	float:left;
	width:10%;
	padding:0 50px;
}

div#page {
	float:left;
}

.not_visible {
	display:none;
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
<hr />
<div id="pag">
<p class="sid"><a href="view_nominal.php">View Nominal</a></p>
</div>
<div id="page">
<?php
$query_nom = "SELECT * FROM nominal where id = $nom_id";
$result_nom = mysqli_query( $connect, $query_nom);
	while($row_nom = mysqli_fetch_array($result_nom)){
		$surname = $row_nom[1];
		$other_name = $row_nom[2];
		$staff_id = $row_nom[3];
	}

$name = $surname." ".$other_name;

$query_report_view = "select * from staff_prog where id = ".$tak_id." ";


$result_report_view = mysqli_query( $connect, $query_report_view);

for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
	$rep_id = mysqli_result($result_report_view,  $i,  "id");
	$num_id = mysqli_result($result_report_view,  $i,  "nom_id");
	$type = mysqli_result($result_report_view,  $i,  "type");
	$prog_type = mysqli_result($result_report_view,  $i,  "prog_type");
	$title = mysqli_result($result_report_view,  $i,  "title");
	$sex = mysqli_result($result_report_view,  $i,  "train_date");
	$finish_date = mysqli_result($result_report_view,  $i,  "finish_date");
	$date_appt = mysqli_result($result_report_view,  $i,  "location");
	$added_date = mysqli_result($result_report_view,  $i,  "added_date");
	$added_by = mysqli_result($result_report_view,  $i,  "added_by");
}
?>
<h2 align="center">ADD TRAINING PROGRAMMES</h2><br />
<form method="post" action="process_edit_prog.php" enctype="multipart/form-data" id="meet">
<p class="ex" align="left">Name : <input class="only" type="text" size="40" name="name" id="name" value="<?php echo $name; ?>" readonly="readonly" /></p><br />
<p class="ex" align="left">Staff Number : <input class="only" type="text" size="40" name="staff_no" id="staff_no" value="<?php echo $staff_id; ?>" readonly="readonly" /></p><br />
<p class="ex" align="left">Programme Type : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="prog_type" id="prog_type"><option value=" ">-Programme Type-</option>
<?php
if($prog_type == 'short term'){
	echo '<option value="short term" selected="selected"> Short term </option>
	<option value="long term"> Long term </option>';
} else if($prog_type == 'long term'){
	echo '<option value="short term"> Short term </option>
	<option value="long term" selected="selected"> Long term </option>';
}
?>
</select>
</p><br />
<p class="ex" align="left">Training Type : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="type" id="type"><option value=" ">-Training Type-</option>
<?php
if($type == 'local'){
	echo '<option value="local" selected> Local training </option>
	<option value="international"> International training </option>
	<option value="CFE"> Centre CFE Trainings </option>';
} else if($type == 'international'){
	echo '<option value="local"> Local training </option>
	<option value="international" selected> International training </option>
	<option value="CFE"> Centre CFE Trainings </option>';
} else if($type == 'CFE'){
	echo '<option value="local"> Local training </option>
	<option value="international"> International training </option>
	<option value="CFE" selected> Centre CFE Trainings </option>';
}

?>
</select>
</p><br />
<p class="ex" align="left">Training Title : <input class="only" type="text" size="40" name="title" id="title" value="<?php echo $title; ?>" /></p><br />
<p class="ex" align="left">Start Date : <input class="only" type="text" size="40" name="t_date" id="t_date" value="<?php echo $sex; ?>" /></p><br />
<p class="ex" align="left">Finish Date : <input class="only" type="text" size="40" name="t_date_f" id="t_date_f" value="<?php echo $finish_date; ?>" /></p><br />
<p class="ex" align="left">Location : <input class="only" type="text" size="40" name="location" id="location" value="<?php echo $date_appt; ?>" /></p><br />
<input type="text" name="nom_id" id="nom_id" value="<?php echo	$rep_id; ?>" class="not_visible"  />
<p align="center"><input class="none" type="submit" id="send" value="Submit" name="submit" />
</form>
</div>
<p class="both" />
</div><!-- close content -->

<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>