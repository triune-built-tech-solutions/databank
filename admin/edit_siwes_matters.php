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
<div class="none"> 
<a href='arearep.php' >Go Back</a>
</div>
<table>
<tr><th colspan="17">Siwes Matters</th></tr>
<tr><th>S/n</th>
<th>Office Type</th>
<th>Office Location</th>
<th>Participating inst.</th>
<th>Orien. during the month</th>
<th>Zonal meeting</th>
<th>Students Placed</th>
<th>Students Paid</th>
<th>Amount Paid</th>
<th>Supv. Allowance Paid</th>
<th>Students Involved</th>
<th>month</th>
<th>Year </th>
<th>Date added</th>
<th>Edit</th>
<th>Delete </th>
</tr>
<?php
if($access_right == 4){
	$query_report_view = "select * from siwes_matters order by year desc, month desc limit 80";
} else {
	$query_report_view = "select * from siwes_matters where added_by = '".$_SESSION['user_name']."' order by year desc, month desc limit 80";
}

$result_report_view = mysqli_query( $connect, $query_report_view);

for($i=0; $i<mysqli_num_rows($result_report_view); $i++){
	$rep_id = mysqli_result($result_report_view,  $i,  "id");
	$office_type = mysqli_result($result_report_view,  $i,  "office_type");
	$office_location = mysqli_result($result_report_view,  $i,  "office_location");
	$month = mysqli_result($result_report_view,  $i,  "month");
	$year = mysqli_result($result_report_view,  $i,  "year");
	$auto_date = mysqli_result($result_report_view,  $i,  "auto_date");
	$added_by = mysqli_result($result_report_view,  $i,  "added_by");
	$part_inst = mysqli_result($result_report_view,  $i,  "part_inst");
	$orien_d_month = mysqli_result($result_report_view,  $i,  "orien_d_month");
	$zonal_meet = mysqli_result($result_report_view,  $i,  "zonal_meet");
	$student_placed = mysqli_result($result_report_view,  $i,  "student_placed");
	$student_paid = mysqli_result($result_report_view,  $i,  "srudent_paid");
	$amount_paid = mysqli_result($result_report_view,  $i,  "amount_paid");
	$supv_allowance = mysqli_result($result_report_view,  $i,  "supv_allowance");
	$students_inv = mysqli_result($result_report_view,  $i,  "students_inv");
	
	$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_array($result_office)){
		$office_location = $row_office['2'];
	}
	
		if ($i % 2){
			$bg_color = "#a8c2f7"; 	
		}
		else{
			$bg_color = "#f0f9f0";
		}

$query_office = "SELECT type FROM office_type where id = $office_type";
	$result_office = mysqli_query( $connect, $query_office);
	
	while($row_office = mysqli_fetch_assoc($result_office)){
		$office_name = $row_office['type'];
	}
$month_query = mysqli_query( $connect, "select * from emonth where emonth_id = $month"); $month_row = mysqli_fetch_array($month_query);
echo '<tr  class="record">
<td bgcolor="'.$bg_color.'">'.$i .'</td>
<td bgcolor="'.$bg_color.'">'. $office_name .'</td>
<td bgcolor="'.$bg_color.'">'. $office_location .'</td>
<td bgcolor="'.$bg_color.'">'.$part_inst.'</td>
<td bgcolor="'.$bg_color.'">'.$orien_d_month.'</td>
<td bgcolor="'.$bg_color.'">'.$zonal_meet.'</td>
<td bgcolor="'.$bg_color.'">'.$student_placed.'</td>
<td bgcolor="'.$bg_color.'">'.$student_paid.'</td>
<td bgcolor="'.$bg_color.'">'.$amount_paid.'</td>
<td bgcolor="'.$bg_color.'">'.$supv_allowance.'</td>
<td bgcolor="'.$bg_color.'">'.$students_inv.'</td>
<td bgcolor="'.$bg_color.'">'.$month_row[1] .'</td>
<td bgcolor="'.$bg_color.'">'.$year .'</td>
<td bgcolor="'.$bg_color.'">'.$auto_date .'</td>
<td bgcolor="'.$bg_color.'"><a href="each_siwes_matters.php?id='.$rep_id.'">Edit</a></td>
<td bgcolor="'.$bg_color.'"><a href="#" id='.$rep_id.' class="delbutton">Delete</a></td>
</tr>';
}

?>
</table>
</div><!-- close content -->

<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript">
$(function() {


$(".delbutton").click(function(){

//Save the link in a variable called element
var element = $(this);

//Find the id of the link that was clicked
var del_id = element.attr("id");

//Built a url to send
var info = 'id=' + del_id;
 if(confirm("Sure you want to delete this record? There is NO undo!"))
		  {

 $.ajax({
   type: "GET",
   url: "delete_siwes.php",
   data: info,
   success: function(){
   
   }
 });
         $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow");

 }

return false;

});

});
</script>
</body>
</head>
</html>