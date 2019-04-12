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
<fieldset><legend><span style="color:#F00">Add Department</span></legend>
<form name="add_dept" action="" method="post" id="add_dept">
<p>Department Name :<br />
<input type="text" name="dept" id="depart" size="50" />&nbsp;&nbsp;
<input type="submit" id="subm" value="Add" name="add_dept" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Edit Department</span></legend>
<form name="edit_dept" action="edit_adminlog.php" method="post" id="edit_dept">
<p class="lef">Department :<br />
<select name="dept_edit" id="dep_edit"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">New Department:<br />
<input type="text" class="dis" name="dept_titl" id="dept_titl" size="50" />&nbsp;&nbsp;
<input type="submit" id="edit" value="Edit" name="edit_department" />
<input type="submit" id="del_department" value="Delete" name="del_department" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Division</span></legend>
<form name="add_div" action="" method="post" id="add_div">
<p class="lef">Department :<br />
<select name="department" id="dep"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division Name :<br />
<input type="text" name="div" id="divis" size="50" />&nbsp;&nbsp;
<input type="submit" id="divs" value="Add" name="add_div" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Edit Division</span></legend>
<form name="edit_div" action="edit_adminlog.php" method="post" id="add_sect">
<p class="lef">Department :<br />
<select name="department1" id="dept1"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division1" id="div1">

</select></p>
<p class="lef">New Division :<br />
<input type="text" name="div_edit" id="div_edit" size="50" />&nbsp;&nbsp;
<input type="submit" id="edit_div" value="Edit" name="edit_division" />
<input type="submit" id="del_div" value="Delete" name="del_division" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Section</span></legend>
<form name="add_sect" action="" method="post" id="add_sect">
<p class="lef">Department :<br />
<select name="department" id="dept"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="div">

</select></p>
<p class="lef">Section :<br />
<input type="text" name="sect" id="sect" size="50" />&nbsp;&nbsp;
<input type="submit" id="sec" value="Add" name="add_sect" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Edit Section</span></legend>
<form name="edit_sect" action="edit_adminlog.php" method="post" id="edit_sect">
<p class="lef">Department :<br />
<select name="department" id="dept2"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="div2">

</select></p>
<p class="lef">Section :<br />
<select name="sect" id="sect2">

</select>&nbsp;&nbsp;
<p class="lef">New Section :<br />
<input type="text" name="sec_edit" id="sec_edit" size="50" />&nbsp;&nbsp;
<input type="submit" id="edit_div" value="Edit" name="edit_section" />
<input type="submit" id="del_div" value="Delete" name="del_section" />
</p>

</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Unit</span></legend>
<form action="" method="post" id="add_unit">
<p>Unit Name :<br />
<input type="text" name="unit" id="uni" size="50" />&nbsp;&nbsp;
<input type="submit" id="units" value="Add" name="add_unit" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Sub-Unit</span></legend>
<form action="" method="post" id="add_SubUnit">
<p class="lef"> Unit :<br /> <select id="ut" name="unt"><option>--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></p>&nbsp;&nbsp;
<p class="lef"> Sub-Unit :<br /> 
<input type="text" name="subUnit" id="subUnit" size="50" />&nbsp;&nbsp;
<input type="submit" id="subUnits" value="Add" name="add_subUnit" />
</p>
</form>
</fieldset>
<fieldset><legend><span style="color:#F00">Suspend Department</span></legend>
<form action="" method="post" id="sus_dept">
<p class="lef">Department :<br />
<select name="department" id="dept"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p><br />
<p><input type="submit" id="suspend" value="Suspend" name="sus_dept" /> &nbsp;&nbsp;&nbsp; <a href="release.php">Restore</a></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Suspend Division</span></legend>
<form action="" method="post" id="sus_div">
<p class="lef">Department :<br />
<select name="department" id="depts"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="divd">

</select></p>
<br />
<p><input type="submit" value="Suspend" name="sus_div" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Suspend Section</span></legend>
<form action="" method="post" id="sus_sec">
<p class="lef">Department :<br />
<select name="department" id="depm"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></p>
<p class="lef">Division :<br />
<select name="division" id="divn">

</select></p>
<p class="lef">Section :<br />
<select name="section" id="secti">

</select></p>
<br />
<p><input type="submit" value="Suspend" name="sus_sec" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Suspend Unit</span></legend>
<form action="" method="post" id="sus_dept">
<p class="lef">Unit :<br />
<select name="unit" id="ut"><option value=" ">--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></p><br />
<p><input type="submit" id="suspend" value="Suspend" name="sus_unit" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Suspend Sub-Unit</span></legend>
<form action="" method="post" id="sus_div">
<p class="lef">unit :<br />
<select name="unit" id="unit"><option value=" ">--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></p>
<p class="lef">Sub-Unit :<br />
<select name="sub_unit" id="sub_unit">

</select></p>
<br />
<p><input type="submit" value="Suspend" name="sus_sub" /></p>
</form>
</fieldset>

<fieldset><legend><span style="color:#F00">Add Office</span></legend>
<form action="" method="post" id="sus_div">
<p class="lef">Office Type :<br />
<select name="off_type" id="off_ty"><option value=" ">--Office Type--</option>
<?php
$result_ty = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
while($row_ty = mysqli_fetch_array($result_ty)){
	echo "<option value='".$row_ty[0]."'>".$row_ty[1]."</option>";
}
?>
</select></p>
<p class="lef">Office Location :<br /> 
<input type="text" name="locate" id="locat" size="30" /></p>
<br />
<p><input type="submit" value="Add" name="add_off" /></p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Edit Office</span></legend>
<form action="edit_adminlog.php" method="post" id="edit_off">
<p class="lef">Office Type :<br />
<select name="off_type" id="office_t"><option value=" ">--Office Type--</option>
<?php
$result_ty = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
while($row_ty = mysqli_fetch_array($result_ty)){
	echo "<option value='".$row_ty[0]."'>".$row_ty[1]."</option>";
}
?>
</select></p>
<p class="lef">Office Location :<br /> 
<select name="office_location" id="office_loc">

</select></p>
<p class="lef">New Location :<br />
<input type="text" name="loc_edit" id="loc_edit" size="50" />&nbsp;&nbsp;
</p>
<br />
<p><input type="submit" value="edit" name="edit_off" /></p>
</form>
</fieldset>
</div><!-- close itf_prog -->
</div><!-- close content -->
<?php
if(isset($_POST['add_dept']) && !empty($_POST['dept'])){
	$dept = $_POST['dept'];
	
	$query = "INSERT INTO department VALUES (null, '$dept', 1)";
	
	mysqli_query( $connect, $query) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));

}

if(isset($_POST['add_div']) && !empty($_POST['div'])){
	$dept = $_POST['department'];
	$div = $_POST['div'];
	
	$que = "INSERT INTO division VALUES (null, $dept, '$div', 1)";
	
	mysqli_query( $connect, $que) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['add_sect']) && !empty($_POST['sect'])){
	$dept = $_POST['department'];
	$div = $_POST['division'];
	$sect = $_POST['sect'];
	
	$quer = "INSERT INTO section VALUES (null, $div, '$sect', 1)";
	
	mysqli_query( $connect, $quer) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['add_unit']) && !empty($_POST['unit'])){
	$unit = $_POST['unit'];
	
	$qury = "INSERT INTO unit VALUES (null, '$unit', 1)";
	
	mysqli_query( $connect, $qury) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['add_subUnit']) && !empty($_POST['subUnit'])){
	$unit = $_POST['unt'];
	$sub = $_POST['subUnit'];
	
	$qur = "INSERT INTO sub_unit VALUES (null, $unit, '$sub', 1)";
	
	mysqli_query( $connect, $qur) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_dept']) && !empty($_POST['department'])){
	$dept = $_POST['department'];
	
	$sus_q = "update department SET status = 0 where id = $dept";
	
	mysqli_query( $connect, $sus_q) or
	die("Error updating department ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_div']) && !empty($_POST['department']) && !empty($_POST['division'])){
	$dept = $_POST['department'];
	$div = $_POST['division'];
	
	$sus_qd = "update division SET status = 0 where id = $div";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating division ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_sec']) && !empty($_POST['division']) && !empty($_POST['section'])){
	$sect = $_POST['section'];
	$div = $_POST['division'];
	
	$sus_qs = "update section SET status = 0 where id = $sect";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating section ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_unit']) && !empty($_POST['unit'])){
	$unt = $_POST['unit'];
	
	$sus_qun = "update unit SET status = 0 where id = $unt";
	
	mysqli_query( $connect, $sus_qun) or
	die("Error updating department ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['sus_sub']) && !empty($_POST['unit']) && !empty($_POST['sub_unit'])){
	$unit = $_POST['unit'];
	$subU = $_POST['sub_unit'];
	
	$sus_qd = "update sub_unit SET status = 0 where id = $subU";
	
	mysqli_query( $connect, $sus_qd) or
	die("Error updating division ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}

if(isset($_POST['add_off']) && !empty($_POST['locate'])){
	$typ = $_POST['off_type'];
	$loc = $_POST['locate'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);
	
	$loca = "INSERT INTO area_office VALUES (null, $typ, '$loc', '$show_date')";
	
	mysqli_query( $connect, $loca) or
	die("error inserting to database ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
}
?>
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
</body>
</head>
</html>