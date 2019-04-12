<?php
require_once("header.php");

if(isset($_GET['repId']))
	$repId = $_GET['repId'];
?>
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
<div id="trainee_det">
<?php
	$query_report = "select * from retired_staff where id = ".$repId." ";
	
	$result_report = mysqli_query( $connect, $query_report);
	
	for($i=0; $i<mysqli_num_rows($result_report); $i++){
		$rep_id = mysqli_result($result_report,  $i,  "id");
		$surname = mysqli_result($result_report,  $i,  "surname");
		$other_name = mysqli_result($result_report,  $i,  "other_name");
		$staff_no = mysqli_result($result_report,  $i,  "staff_no");
		$sex = mysqli_result($result_report,  $i,  "sex");
		$job_title = mysqli_result($result_report,  $i,  "job_title");
		$date_appt = mysqli_result($result_report,  $i,  "date_appt");
		$dob = mysqli_result($result_report,  $i,  "dob");
		$state = mysqli_result($result_report,  $i,  "state");
		$added_date = mysqli_result($result_report,  $i,  "added_date");
		$added_by = mysqli_result($result_report,  $i,  "added_by");
	}
	
	echo '
	<p><span style="color:#006; font-weight:600;">Name : </span>'.$surname.' '.$other_name.' </p>
	<p><span style="color:#006; font-weight:600;">Staff No. : </span>'.$staff_no.' </p>
	<p><span style="color:#006; font-weight:600;">Gender : </span>'.$sex.' </p>
	<p><span style="color:#006; font-weight:600;">Job Title : </span>'.$job_title.' </p>
	<p><span style="color:#006; font-weight:600;">Date of 1st Appointment : </span>'.$date_appt.' </p>
	<p><span style="color:#006; font-weight:600;">Date of Birth : </span>'.$dob.' </p>
	<p><span style="color:#006; font-weight:600;">State of Origin : </span>'.$state.' </p>
	
	';

?>
<div align="center">
<form action="<?php echo $_SERVER['PHP_SELF'].'?repId='.$repId; ?>" method="post" name="report_query">

<select name="prog_type" id="prog_type"><option value=" ">-Programme Type-</option>
<option value="short term"> Short term </option>
<option value="long term"> Long term </option>
</select> &nbsp;&nbsp;&nbsp;

<select name="type" id="type"><option value=" ">-Training Type-</option>
<option value="local"> Local training </option>
<option value="international"> International training </option>
</select>&nbsp;&nbsp;&nbsp;
consultant/Institution : <input type="text" name="consult" id="consult"  />&nbsp;&nbsp;&nbsp;
Location : <input type="text" name="loca" id="loca"  />&nbsp;&nbsp;&nbsp;
<input type="submit" name="begin_query" value="Begin Query" />
</form><br />
</div><br />
<?php
if(isset($_POST['begin_query'])){
	$prog_t = $_POST['prog_type'];
	$train_t = $_POST['type'];
	$consult = $_POST['consult'];
	$loca = $_POST['loca'];
	
	if($prog_t !== " "){
		$opt = "prog_type = '".$prog_t."' ";
	}
	
	if($train_t !== " " && !isset($opt)){
		$opt = "type = '".$train_t."' ";
	} else if($train_t !== " " && isset($opt)){
		$opt .= "and type = '".$train_t."' ";
	}
	
	if($consult !== " " && !isset($opt)){
		$opt = "consultant = '".$consult."' ";
	} else if($consult !== " " && isset($opt)){
		$opt .= "and consultant = '".$consult."' ";
	}
	
	if($loca !== " " && !isset($opt)){
		$opt = "location = '".$loca."' ";
	} else if($loca !== " " && isset($opt)){
		$opt .= "and location = '".$loca."' ";
	}

}
?>
<form action="del_each_prog.php" method="post">
<table>
<tr><th colspan="10">Training Details</th></tr>
<tr>
<th><input name="delete" value="Delete" type="submit" /></th>
<th>S/n</th>
<th>Prog. Type</th>
<th>Training Type</th>
<th>Training Category</th>
<th>Training Title</th>
<th>Training Period</th>
<th>Consultant/Institution</th>
<th>Location</th>
<th> </th>
</tr>
<?php
if(isset($opt)){
	$query_report_view = "select * from staff_prog where $opt and nom_id = ".$repId." ";
} else {
	$query_report_view = "select * from staff_prog where nom_id = ".$repId." ";
}


$result_report_view = mysqli_query( $connect, $query_report_view);

for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
	$rep_id = mysqli_result($result_report_view,  $i,  "id");
	$num_id = mysqli_result($result_report_view,  $i,  "nom_id");
	$type = mysqli_result($result_report_view,  $i,  "type");
	$prog_type = mysqli_result($result_report_view,  $i,  "prog_type");
	$category = mysqli_result($result_report_view,  $i,  "category");
	$title = mysqli_result($result_report_view,  $i,  "title");
	$sex = mysqli_result($result_report_view,  $i,  "train_date");
	$finish_date = mysqli_result($result_report_view,  $i,  "finish_date");
	$date_appt = mysqli_result($result_report_view,  $i,  "location");
	$consultant = mysqli_result($result_report_view,  $i,  "consultant");
	$added_date = mysqli_result($result_report_view,  $i,  "added_date");
	$added_by = mysqli_result($result_report_view,  $i,  "added_by");
	
		
		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}
		
		$sn = $i + 1;
		
	echo '<tr>
	<td bgcolor="'.$bg_color.'"><input name="del[]" type="checkbox" value="'.$rep_id.'" /></td>
	<td bgcolor="'.$bg_color.'">'.$sn .'</td>
	<td bgcolor="'.$bg_color.'">'.ucwords($prog_type) .'</td>
	<td bgcolor="'.$bg_color.'">'.ucwords($type) .'</td>
	<td bgcolor="'.$bg_color.'">'.ucwords($category) .'</td>
	<td bgcolor="'.$bg_color.'">'.$title .'</td>
	<td bgcolor="'.$bg_color.'">'.$sex.' - '.$finish_date.'</td>
	<td bgcolor="'.$bg_color.'">'.$consultant .'</td>
	<td bgcolor="'.$bg_color.'">'.$date_appt .'</td>
	<td bgcolor="'.$bg_color.'"><a href="edit_each_prog.php?nomId='.$repId.'&&repId='.$rep_id.'">Edit</a></td>
	</tr>';
	}
	
	?>
    <!--p>Training Type : '.$type.' </p>
	<p>Training Title : '.$title.' </p>
	<p>Training Date : '.$sex.' </p>
	<p>Training Duration : '.$job_title.' </p>
	<p>location : '.$date_appt.' </p -->
	</table>
    </form>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
</body>
</head>
</html>