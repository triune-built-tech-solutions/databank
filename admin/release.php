<?php
require_once("header.php");
?>
<style>
.lef {
	float:left;
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
<div id="itf_prog">
<fieldset><legend><span style="color:#F00">Restore Department</span></legend>
<form action="" method="post" id="sus_dept">
<p class="lef">Department :<br />
<select name="department" id="dept"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 0");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p><br />
<p><input type="submit" id="suspend" value="Restore" name="sus_dept" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Restore Division</span></legend>
<form action="" method="post" id="sus_div">
<p class="lef">Department :<br />
<select name="department" id="deptsr"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="divdr">

</select></p>
<br />
<p><input type="submit" value="Restore" name="sus_div" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Restore Section</span></legend>
<form action="" method="post" id="sus_sec">
<p class="lef">Department :<br />
<select name="department" id="depmr"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="divnr">

</select></p>
<p class="lef">Section :<br />
<select name="section" id="sectir">

</select></p>
<br />
<p><input type="submit" value="Restore" name="sus_sec" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Restore Unit</span></legend>
<form action="" method="post" id="sus_dept">
<p class="lef">Unit :<br />
<select name="unit" id="ut"><option value=" ">--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 0");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></p><br />
<p><input type="submit" id="suspend" value="Restore" name="sus_unit" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Restore Sub-Unit</span></legend>
<form action="" method="post" id="sus_div">
<p class="lef">unit :<br />
<select name="unit" id="unitr"><option value=" ">--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></p>
<p class="lef">Sub-Unit :<br />
<select name="sub_unit" id="sub_unitr">

</select></p>
<br />
<p><input type="submit" value="Restore" name="sus_sub" /></p>
</form>
</fieldset>
</div><!-- close itf_prog -->
</div><!-- close content -->
<?php
if(isset($_POST['sus_dept']) && !empty($_POST['department'])){
	$dept = $_POST['department'];
	
	$sus_q = "update department SET status = 1 where id = $dept";
	
	mysqli_query( $connect, $sus_q) or
	die("Error updating department ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_div']) && !empty($_POST['department']) && !empty($_POST['division'])){
	$dept = $_POST['department'];
	$div = $_POST['division'];
	
	$sus_qd = "update division SET status = 1 where id = $div";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating division ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_sec']) && !empty($_POST['division']) && !empty($_POST['section'])){
	$sect = $_POST['section'];
	$div = $_POST['division'];
	
	$sus_qs = "update section SET status = 1 where id = $sect";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating section ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_unit']) && !empty($_POST['unit'])){
	$unt = $_POST['unit'];
	
	$sus_qun = "update unit SET status = 1 where id = $unt";
	
	mysqli_query( $connect, $sus_qun) or
	die("Error updating department ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_sub']) && !empty($_POST['unit']) && !empty($_POST['sub_unit'])){
	$unit = $_POST['unit'];
	$subU = $_POST['sub_unit'];
	
	$sus_qd = "update sub_unit SET status = 1 where id = $subU";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating division ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}
?>
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript" src="old_assets/aja.js"></script>
</body>
</head>
</html>