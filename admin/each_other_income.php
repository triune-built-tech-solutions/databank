<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#other_inc input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#other_inc input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#other_inc input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#other_inc select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#other_inc p{
	margin-bottom: 15px;
}

#other_inc p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#other_inc p span.error{
	color: #e46c6e;
}
#other_inc #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#other_inc #send:hover{
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

$qu = "select * from other_inc where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$targ = $ro['target'];
	$amou = $ro['amount_gen'];
	$tota = $ro['total_amt_gen'];
}
?>
<td>
<div id="exec">
<h2 align="center">OTHER INCOME GENERATED </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="other_inc" id="other_inc">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p class="ex" align="left">Target for the year : &nbsp;&nbsp;<input class="only" type="text" size="25" name="target" id="target" value="<?php echo $targ ?>" /></p><br />
<p align="left" class="ex">Amount Generated for the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_gen" id="amt_gen" value="<?php echo $amou ?>" /></p><br />
<p align="left" class="ex">Total Amount Generated : &nbsp;&nbsp;<input class="only" type="text" size="25" name="tt_amt_gen" id="tt_amt_gen" value="<?php echo $tota ?>" /></p><br />
<p align="center"><input type="submit" id="send" value="Change" name="submit" /></p><br />
</form>
</div>
</td>
</tr>
</table>
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
	$target = $_POST['target'];
	$amt_gen = $_POST['amt_gen'];
	$tt_amt_gen = $_POST['tt_amt_gen'];
	
	$staff_info = "UPDATE other_inc SET target = $target, amount_gen = $amt_gen, total_amt_gen = $tt_amt_gen where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_other_income.php");
}
?>
<script type="text/javascript" src="old_assets/val_other_inc.js"></script>
</body>
</head>
</html>