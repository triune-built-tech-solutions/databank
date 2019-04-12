<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#rev_gen input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#rev_gen input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#rev_gen input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#rev_gen select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#rev_gen p{
	margin-bottom: 15px;
}

#rev_gen p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#rev_gen p span.error{
	color: #e46c6e;
}
#rev_gen #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#rev_gen #send:hover{
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

$qu = "select * from rev_fr_course where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$prog = $ro['prog_imp'];
	$gro = $ro['gro_rev_gen'];
	$amt = $ro['amt_budg_exp'];
	$net = $ro['net_rev'];
	$amou = $ro['amount_coll'];
	$outs = $ro['amount_outs'];
}
?>
<td>
<div id="exec">
<h2 align="center">REVENUE FROM COURSE FEES </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="rev_gen" id="rev_gen">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />
<p class="ex" align="left">Programme implemented during the month : &nbsp;&nbsp;<input class="only" type="text" size="25" name="prog_imp" id="prog_imp" value="<?php echo $prog ?>" /></p><br />
<p align="left" class="ex">Gross Revenue Generated : &nbsp;&nbsp;<input class="only" type="text" size="25" name="gross_rev" id="gross_rev" value="<?php echo $gro ?>" /></p><br />
<p align="left" class="ex">Amount Budgeted and Expended : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_budg" id="amt_budg" value="<?php echo $amt ?>" /></p><br />
<p align="left" class="ex">Net Revenue  : &nbsp;&nbsp;<input class="only" type="text" size="25" name="net_rev" id="net_rev" value="<?php echo $net ?>" /></p><br />
<p align="left" class="ex">Amount Collected : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_coll" id="amt_coll"  value="<?php echo $amou ?>" /></p><br />
<p align="left" class="ex">Amount Outstanding : &nbsp;&nbsp;<input class="only" type="text" size="25" name="amt_outs" id="amt_outs" value="<?php echo $outs ?>" /></p><br />
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
	$prog_imp = $_POST['prog_imp'];
	$gross_rev = $_POST['gross_rev'];
	$amt_budg = $_POST['amt_budg'];
	$net_rev = $_POST['net_rev'];
	$amt_coll = $_POST['amt_coll'];
	$amt_outs = $_POST['amt_outs'];
	
	$staff_info = "UPDATE rev_fr_course SET prog_imp = $prog_imp, gro_rev_gen = $gross_rev, amt_budg_exp = $amt_budg, net_rev = $net_rev, amount_coll = $amt_coll, amount_outs = $amt_outs where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_revenue_gen.php");
}
?>
<script type="text/javascript" src="old_assets/val_rev_gen.js"></script>
</body>
</head>
</html>