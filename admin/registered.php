<?php
require_once("header.php");
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
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p align="center">Username: &nbsp;&nbsp;<input type="text" name="usern" size="30" />
    <input type="submit" name="lim" value="search" />&nbsp;&nbsp;&nbsp;&nbsp; 
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Show All</a>
</p>
</form>
<table>
<tr><th colspan="12">View all Users</th></tr>
<tr>
<th>Id</th>
<th>Staff N<u>o</u></th>
<th>Name </th>
<th>Gender</th>
<th>Office Type</th>
<th>Office Location</th>
<th>Username</th>
<th>Department</th>
<th>Added by</th>
<th>Date added </th>
<th>Status </th>
</tr>
<?php
$rowp = 30;
$sql = "SELECT * FROM staff_reg";
$result = mysqli_query( $connect, $sql);
$total_records = mysqli_num_rows($result);
$pages = ceil($total_records / $rowp);
((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);

if(!isset($_GET['stat'])){
	$stat = 1;
} else {
	$stat = $_GET['stat'];
}

$stt = (($stat * $rowp) - $rowp);

if(isset($_POST['lim'])){
	$lim = $_POST['usern'];
}

if(isset($lim)){
	$query_staff_info = "select * from staff_reg where username ='".$lim."' order by first_name";
}else {
	$query_staff_info = "select * from staff_reg order by first_name LIMIT $stt, $rowp";
}

$result_staff_info = mysqli_query( $connect, $query_staff_info);



for($i=0; $i<mysqli_num_rows($result_staff_info); $i++){
	$id = mysqli_result($result_staff_info,  $i,  "id");
	$staff_no = mysqli_result($result_staff_info,  $i,  "staff_no");
	$title_id = mysqli_result($result_staff_info,  $i,  "title_id");
	$first_name = mysqli_result($result_staff_info,  $i,  "first_name");
	$middle_name = mysqli_result($result_staff_info,  $i,  "middle_name");
	$last_name = mysqli_result($result_staff_info,  $i,  "last_name");
	$gender = mysqli_result($result_staff_info,  $i,  "gender_id");
	$office_type = mysqli_result($result_staff_info,  $i,  "office_type");
	$office_loc = mysqli_result($result_staff_info,  $i,  "office_location");
	$username = mysqli_result($result_staff_info,  $i,  "username");
	$department = mysqli_result($result_staff_info,  $i,  "department");
	$unit = mysqli_result($result_staff_info,  $i,  "unit");
	$added_by = mysqli_result($result_staff_info,  $i,  "added_by");
	$date_added = mysqli_result($result_staff_info,  $i,  "date_added");
	$freeze_id = mysqli_result($result_staff_info,  $i,  "freeze_id");

		if($freeze_id == 0){
			$freeze = "<a href='freeze.php?user_id=$id & fr_id=$freeze_id'>Freeze</a>";
		} else {
			$freeze = "<a href='freeze.php?user_id=$id & fr_id=$freeze_id'>Release</a>";
		}


		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}

$query_title = "SELECT * FROM title where title_id = $title_id";
	$result_title = mysqli_query( $connect, $query_title);
	
	while($row_title = mysqli_fetch_array($result_title)){
		$title = $row_title[1];
	}
if(isset($department)){
	$query_depart = "SELECT * FROM department where id = $department";
	$result_depart = mysqli_query( $connect, $query_depart);
		
		while($row_depart = mysqli_fetch_array($result_depart)){
			$department = $row_depart[1];
		}
} else {
	$query_unit = "SELECT * FROM unit where id = $unit";
	$result_unit = mysqli_query( $connect, $query_unit);
		
		while($row_unit = mysqli_fetch_array($result_unit)){
			$department = $row_unit[1];
		}
}
$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type where id = $office_type");
while($row_office_type = mysqli_fetch_array($result_office_type)){
	$office_type_row =  $row_office_type[1];
}

$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_loc";
$result_office = mysqli_query( $connect, $query_office);
	
while($row_office = mysqli_fetch_array($result_office)){
	$office_loc = $row_office['2'];
}

$result_off_location = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender where gender_id = $gender");
while($row_off_location = mysqli_fetch_array($result_off_location)){
	$gender = $row_off_location[1];
}

echo '<tr>
<td bgcolor="'.$bg_color.'">'.$id .'</td>
<td bgcolor="'.$bg_color.'">'. $staff_no .'</td>
<td bgcolor="'.$bg_color.'">'.$title.' '.$first_name.' '.$middle_name.' '.$last_name.'</td>
<td bgcolor="'.$bg_color.'">'.$gender.'</td>
<td bgcolor="'.$bg_color.'">'.$office_type_row.'</td>
<td bgcolor="'.$bg_color.'">'.$office_loc.'</td>
<td bgcolor="'.$bg_color.'">'.$username .'</td>
<td bgcolor="'.$bg_color.'">'.$department.'</td>
<td bgcolor="'.$bg_color.'">'.$added_by.'</td>
<td bgcolor="'.$bg_color.'">'.$date_added.'</td>
<td bgcolor="'.$bg_color.'">'.$freeze.'</td>
</tr>';
}

?>
</table>
<div align="center" id="page_num">
<?php
$next = ($stat+1);
// let's create the dynamic links now
if ($stat > 1) {
	 $url = $_SERVER['PHP_SELF']."?stat=".--$stat;
	 echo "<a href=\"$url\">Previous</a>";
}
// page numbering links now
for ($i = 1; $i <= $pages; $i++) {
	if($i == 50)
			break;
	 $url = $_SERVER['PHP_SELF']."?stat=".$i;
	 echo "  <a href=\"$url\">$i</a>  ";
}
if (isset($_GET['stat']) && $_GET['stat'] < $pages) {
  	$url = $_SERVER['PHP_SELF']."?stat=$next";
  	echo "<a href=\"$url\">Next</a>";
}

?>
</div>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>