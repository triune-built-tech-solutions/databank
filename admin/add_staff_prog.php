<?php
require_once("header.php");

if(isset($_GET['repId']))
	$tak_id = $_GET['repId'];

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
padding:0 500px;
	font: bold;
font-size:500px;
	color:#F00;
	font-style:italic;
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



if(!empty($_GET['rpt'])){
    switch($_GET['rpt']){
        case 'Successfully':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'inserted successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please Fill All Fields to Continue.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
</div>
<div id="pag">
<p class=" btn btn-danger"><a href="view_nominal.php">View Staff</a></p>
</div>
<hr />
<div id="page">
<?php
$query_nom = "SELECT * FROM nominal where id = $tak_id";
$result_nom = mysqli_query( $connect, $query_nom);
	while($row_nom = mysqli_fetch_array($result_nom)){
		$surname = $row_nom[1];
		$other_name = $row_nom[2];
		$staff_id = $row_nom[3];
	}

$name = $surname." ".$other_name;
?>
	 <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
<h2 align="center">ADD TRAINING PROGRAMMES</h2><br />
<form method="post" action="process_staff_prog.php" enctype="multipart/form-data" id="meet">
<p class="ex" align="left">Name : <input class="only" type="text" size="40" name="name" id="name" value="<?php echo $name; ?>" readonly="readonly" /></p><br />
<p class="ex" align="left">Staff Number : <input class="only" type="text" size="40" name="staff_no" id="staff_no" value="<?php echo $staff_id; ?>" readonly="readonly" /></p><br />
<p class="ex" align="left">Programme Type : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="prog_type" id="prog_type" required><option value=" ">-Programme Type-</option>
<option value="short term"> Short term </option>
<option value="long term"> Long term </option>
</select>
</p><br />
<p class="ex" align="left">Training Type : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="type" id="type" required><option value=" ">-Training Type-</option>
<option value="local"> Local training </option>
<option value="international"> International training </option>
<!--option value="CFE"> CFE Trainings </option-->
</select>
</p><br />
<p class="ex" align="left">Training Category : &nbsp;&nbsp;&nbsp;&nbsp;
<select class="only" name="category" id="category" required><option value=" ">-Training Type-</option>
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
<p class="ex" align="left">Programme Title : <input class="only" type="text" size="40" name="title" id="title" required/></p><br />
<p class="ex" align="left">Date :&emsp; From - <input class="only" type="text" size="20" name="t_date" id="popupDatepicker" placeholder="DD/MM/YYYY" required/> <br /><br />
&emsp;&emsp;&emsp;&emsp; TO - <input class="only" type="text" size="20" name="t_date_f" id="popupDatepicker1" placeholder="DD/MM/YYYY" required/></p><br />
<p class="ex" align="left">Consultant/Institution : <input class="only" type="text" size="40" name="consult" id="consult" required/></p><br />
<p class="ex" align="left">Location : <input class="only" type="text" size="40" name="location" id="location" required/></p><br />
<input type="text" name="nom_id" id="nom_id" value="<?php echo	$tak_id; ?>" class="not_visible"  required/>
<p align="center"><input class="none" type="submit" id="send" value="Submit" name="submit" />&nbsp;&nbsp;&nbsp;
<input class="none" type="submit" id="next" value="Add more" name="next" /></p><br />
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