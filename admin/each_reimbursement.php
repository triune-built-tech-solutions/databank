<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#reimburse input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#reimburse input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#reimburse input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#reimburse select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#reimburse p{
	margin-bottom: 15px;
}

#reimburse p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#reimburse p span.error{
	color: #e46c6e;
}
#reimburse #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#reimburse #send:hover{
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
<?php
require_once("side_link.php");

$repo = $_GET['id'];

$qu = "select * from reimbursement where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$c_rec = $ro['claims_rec'];
	$c_pro = $ro['claims_proc'];
	$c_p_d = $ro['claims_proc_date'];
	$c_pai = $ro['claims_paid'];
	$amoun = $ro['amount_paid'];
}
?>
<td>
<div id="exec">
<h2 align="center">REIMBURSEMENT</h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="reimburse" id="reimburse">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p class="ex" align="left">NO. of claims received during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="claims" id="claims" value="<?php echo $c_rec ?>" /></p><br />
<p align="left" class="ex">NO. of claims processed to Headquaters during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="claims_pro" id="claims_pro" value="<?php echo $c_pro ?>" /></p><br />
<p align="left" class="ex">NO. of claims processed to Headquaters to date : &nbsp;&nbsp;<input class="only" type="text" size="25" name="cl_pro_date" id="cl_pro_date" value="<?php echo $c_p_d ?>" /></p><br />
<p align="left" class="ex">NO. of claims paid during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="claims_paid" id="claims_paid" value="<?php echo $c_pai ?>" /></p><br />
<p align="left" class="ex">Amount paid : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amount_paid" id="amount_paid" value="<?php echo $amoun ?>" /></p><br />
<p align="center"><input type="submit" value="Change" name="submit" id="send" /></p><br />
</form>
</div>
</td>
</tr></table>
<script>
$('dd').filter('dd:nth-child(n+2)').hide();

$('dt').click( function() {
		$(this).next().siblings('dd').hide();
		$(this).next().show();
							 });
//$('.subject').click(removeClass('li.page'));

</script>
<?php
$user_name = $_SESSION['user_name'];

if(isset($_POST['submit'])){
	$repo = $_POST['repo'];
	$claims = $_POST['claims'];
	$claims_pro = $_POST['claims_pro'];
	$cl_pro_date = $_POST['cl_pro_date'];
	$claims_paid = $_POST['claims_paid'];
	$amount_paid = $_POST['amount_paid'];
	
	$staff_info = "UPDATE reimbursement SET claims_rec = $claims, claims_proc = $claims_pro, claims_proc_date = $cl_pro_date, claims_paid = $claims_paid, amount_paid = $amount_paid where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_reimbursement.php");
}
?>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/val_reimbursement.js"></script>
</body>
</head>
</html>