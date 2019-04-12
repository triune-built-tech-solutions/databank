<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#scheduled input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#scheduled input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#scheduled input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#scheduled select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#scheduled p{
	margin-bottom: 15px;
}

#scheduled p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#scheduled p span.error{
	color: #e46c6e;
}
#scheduled #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#scheduled #send:hover{
	background: #79a7f1;
}

#error{
	margin-bottom: 20px;
	border: 1px solid #efefef;
}
</style>
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
<table>
<tr>
<td>
<div id="exec">
<?php
$links = '
<dl>
<dt class="subject"><a href="staff_info.php"> Staff Information</a></dt>
<dt><a href="training_needs.php" title="Training Needs Assessment"> Training Needs...</a></dt>
<dt><a href="scheduled_training.php"> Scheduled Training</a></dt>
<dt><a href="unscheduled_training.php"> Unscheduled Training</a></dt>
<dt><a href="new_training.php" title="New Training Package Developed and Test-runned"> New Training Package...</a></dt>
<dt><a href="peit.php"> PPIT</a></dt>
<dt><a href="industrial_training.php"> Apprenticeship </a></dt>
<dt><a href="course_approval.php"> Course Approval</a></dt>
<dt><a href="in-company.php"> In-Company Safety</a></dt>
<dt><a href="siwes_matters.php"> Siwes Matters</a></dt>
<dt><a href="reimbursement.php"> Reimbursement</a></dt>
<dt><a href="emp_stat.php"> Employers Statistics</a></dt>
<dt><a href="training_contribution.php"> Training Contribution</a></dt>
<dt><a href="verification_of_acct.php" title="Verification of Company Accounts"> Verification of Company...</a></dt>
<dt><a href="revenue_gen.php"> Revenue From Course</a></dt>
<dt><a href="outstanding_course.php" title="Outstanding Course Fee from Previous Years"> Outstanding Course...</a></dt>
<dt><a href="other_income.php" title="Other Income Generated"> Other Income...</a></dt>
<dt><a href="nisdp_participant.php"> NISDP...</a></dt>
<dt><a href="tsdp_participant.php"> TSDP...</a></dt>
<dt><a href="itf_collaboration.php"> Collaborations</a></dt>
<dt><a href="entrepreneurship.php" title="Entrepreneurship Development Programme"> Entrepreneurship Dev...</a></dt>
</dl>';
echo $links;

?>
</div>
</td>
</tr></table>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?> &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script>
$('dd').filter('dd:nth-child(n+2)').hide();

$('dt').click( function() {
		$(this).next().siblings('dd').hide();
		$(this).next().show();
							 });
//$('.subject').click(removeClass('li.page'));

</script>
</body>
</head>
</html>