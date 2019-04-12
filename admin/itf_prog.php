<?php
require_once("header.php");
?>
<style>
.lef {
	float:left;
}
.notVisible {
	visibility:hidden;
}

#add_prog input.dis{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#add_prog input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#add_prog input.error{
	background: #f8dbdb;
	border-color: #e77776;
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
<fieldset><legend><span style="color:#F00">Copy program</span></legend>
<form name="copy_prog" action="merge_prog.php" method="post" id="copy_prog">
<p>
<select name="year_copy" id="year_copy"><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p>
<p>
<select name="year_copy1" id="year_copy1"><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p>

<p class="lef">
<input type="submit" id="migrate" value="migrate" name="migrate_prog" />
</p>
</form>
</fieldset>
<br />

<fieldset><legend><span style="color:#F00">Add Program</span></legend>
<form name="add_prog" action="add_prog.php" method="post" id="add_prog">
<p>
<select name="year" id="year"><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p>
<p class="lef">Prog N<u>o</u><br />
<select name="prog_no" id="prog_n">

</select></p>
<p class="lef">Prog. Tittle:<br />
<input type="text" class="dis" name="prog_titl" id="prog_titl" size="50" />&nbsp;&nbsp;
<input type="submit" id="subm" disabled="disabled" value="Add" name="add_prog" />&nbsp;&nbsp;
<input type="submit" id="edit" disabled="disabled" value="Edit" name="edit_prog" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Sub Program</span></legend>
<form name="add_sub_prog" action="add_sub_prog.php" method="post" id="add_sub_prog">
<p>
<select name="syear" id="syear"><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p>
<p>Prog N<u>o</u><br />
<select name="sprog_n" id="prog_no">
</select></p>
<p>Sub Prog N<u>o</u><br />
<select name="sub_prog_no" id="sub_prog">

</select>&nbsp;&nbsp;&nbsp;</p>
<p class="lef">Sub Prog. N<u>o</u><br />
<input class="notVisible" type="text" name="sub_no" id="add_no" size="10"/></p>
<p class="lef">Sub Prog. Tittle<br />
<input type="text" name="sub_prog_title" id="sub_prog_titl" size="100" />&nbsp;&nbsp;
<input type="submit" id="subm_sub" disabled="disabled" value="Add" name="add_sub" />&nbsp;&nbsp;
<input type="submit" id="edit_sub" disabled="disabled" value="Edit" name="edit_sub" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Objective</span></legend>
<form name="obj_add" action="add-obj.php" method="post" id="obj_add">
<p>
<select name="oyear" id="oyear"><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option value='".$row_eyear[1]."'>". $row_eyear[1] . "</option>";
}
?>
</select></p>
<p>Prog N<u>o</u><br />
<select name="oprog_n" id="oprog_no">
</select></p>
<p>Sub Prog N<u>o</u><br />
<select name="sub_oprog_no" id="sub_oprog_no">

</select></p>
<p>Objective N<u>o</u><br />
<select name="obj_ono" id="obj_ono">

</select></p>
<p class="lef">Obj. N<u>o</u><br />
<input class="notVisible" type="text" name="obj_no" id="add_obj" size="10"/></p>
<p class="lef">Objective Tittle:<br /><textarea name="obj_title" id="obj_t"> </textarea>&nbsp;&nbsp;
<input type="submit" id="subm_obj" disabled="disabled" value="Add" name="adding_obj" />&nbsp;&nbsp;
<input type="submit" id="edit_obj" disabled="disabled" value="Edit" name="edit_obj" />
</p>
</form>
</fieldset>
<br />
<fieldset><legend><span style="color:#F00">Add Home News</span></legend>
<form method="post" action="add_home.php" id="add_homeP">
<p>Heading : <input type="text" size="70" name="headings" id="heading" /></p>
<p>Text :<br /> <textarea name="homeP" id="homeP" cols="100" rows="5"> </textarea></p>
<input type="submit" name="submit" value="Submit" id="homePage" />
</form>
</fieldset>
</div>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript" src="old_assets/val_add.js"></script>
</body>
</head>
</html>