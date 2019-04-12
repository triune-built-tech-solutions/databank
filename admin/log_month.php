<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<div id="depart">
<?php
	$query_dept = "SELECT * FROM department where id = $department";
	$result_dept = mysqli_query( $connect, $query_dept);
	
	while($row_dept = mysqli_fetch_array($result_dept)){
		$department = $row_dept[1];
		echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
	}
	
	$query_div = "SELECT * FROM division where id = $division";
	$result_div = mysqli_query( $connect, $query_div);
	
	while($row_div = mysqli_fetch_array($result_div)){
		$division = $row_div[2];
		echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> DIVISION:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
	}
	
	$query_section = "SELECT * FROM section where section_id = $section";
	$result_section = mysqli_query( $connect, $query_section);
	
	while($row_section = mysqli_fetch_array($result_section)){
		$section = $row_section[2];
		echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SECTION:</span> " . $row_section[2] . ".</p>";
	}
?>
</div>
<table>
<tr><th colspan="5">select the year and month to view</th></tr>
<tr>
<td colspan="1">Year : &nbsp;
<select><option>-Year-</option>
<?php
$query_eyear = "Select * from eyear";
$result_eyear = mysqli_query( $connect, $query_eyear);

while($row_eyear = mysqli_fetch_array($result_eyear)){
	echo "<option>". $row_eyear[1] . "</option>";
}
?>
</select>
</td>
<td colspan="1">Month : &nbsp;
<select><option>-Month-</option>
<?php
$query_emonth = "Select * from emonth";
$result_emonth = mysqli_query( $connect, $query_emonth);

while($row_emonth = mysqli_fetch_array($result_emonth)){
	echo "<option>". $row_emonth[1] . "</option>";
}
?>
</select>
</td>
</tr>
<?php
$query_log = "SELECT * FROM login_logger ORDER BY id desc LIMIT 40 ";

$result_set = mysqli_query( $connect, $query_log);

for($i=0; $i<mysqli_num_rows($result_set); $i++){
	$id = mysqli_result($result_set,  $i,  "id");
	$log_name = mysqli_result($result_set,  $i,  "log_name");
	$log_time = mysqli_result($result_set,  $i,  "log_time");
	$office_type = mysqli_result($result_set,  $i,  "office_type");
	$office_loc = mysqli_result($result_set,  $i,  "office_location");
	$access = mysqli_result($result_set,  $i,  "access_right");
	$dept = mysqli_result($result_set,  $i,  "department");
	$division = mysqli_result($result_set,  $i,  "div_id");
	$section = mysqli_result($result_set,  $i,  "section_id");
	$ip_add = mysqli_result($result_set,  $i,  "ip_add");
	$protocol = mysqli_result($result_set,  $i,  "proto");
	$port = mysqli_result($result_set,  $i,  "port");
	$io = $i + 1;

		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}
		
		echo '<tr>
		<td bgcolor="'.$bg_color.'"><p class="much">'.$io.'</p></td><td bgcolor="'.$bg_color.'"><p class="much">User Account ' . $log_name .' from '. $office_loc .' | '.$office_type.' | '. $dept .' department | ' . $division .' division | '. $section .' section. On the '. $log_time .' with '. $ip_add .' ip address : '. $port .' '. $protocol .'</p></td>
		</tr>';
}
?>
</table>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
</body>
</head>
</html>