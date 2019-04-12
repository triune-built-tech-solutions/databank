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
<table class="no_bodder">
<tr>
<th colspan="2">Users Login Activities</th>
</tr>
<?php
if(isset($_POST['lim'])){
	$lim = $_POST['usern'];
}

$rowp = 30;
$sql = "SELECT * FROM login_logger";
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

if(isset($lim)){
	$query_log = "SELECT * FROM login_logger where log_name ='".$lim."' ORDER BY id desc LIMIT $stt, $rowp";
} else {
	$query_log = "SELECT * FROM login_logger ORDER BY id desc LIMIT $stt, $rowp";
}

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