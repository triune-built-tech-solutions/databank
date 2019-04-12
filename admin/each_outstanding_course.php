<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#outs_cour input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#outs_cour input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#outs_cour input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#outs_cour select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#outs_cour p{
	margin-bottom: 15px;
}

#outs_cour p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#outs_cour p span.error{
	color: #e46c6e;
}
#outs_cour #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#outs_cour #send:hover{
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

$qu = "select * from outs_c_f_prev_y where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$gros = $ro['gross_amount'];
	$amou = $ro['amount_coll'];
}
?>
<td>
<div id="exec">
<h2 align="center">OUTSTANDING COURSE FEE FROM PREVIOUS YEARS </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="outs_cour" id="outs_cour">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p class="ex" align="left">Gross Amount: &nbsp;&nbsp;<input class="only" type="text" size="25" name="gross_amt" id="gross_amt" value="<?php echo $gros ?>" /></p><br />
<p align="left" class="ex">Amounth Collected : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_coll" id="amt_coll" value="<?php echo $amou ?>" /></p><br />
<p align="center"><input type="submit" value="Change" name="submit" id="send" /></p><br />
</form>
</div>
</td>
</tr></table>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?>  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
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
	$gross_amt = $_POST['gross_amt'];
	$amt_coll = $_POST['amt_coll'];
	
	$staff_info = "UPDATE outs_c_f_prev_y SET gross_amount = $gross_amt, amount_coll = $amt_coll where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_outstanding_course.php");
}
?>
<script type="text/javascript" src="old_assets/val_outs_c_f.js"></script>
</body>
</head>
</html>