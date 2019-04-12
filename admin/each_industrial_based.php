<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#ind_based input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#ind_based input.none{
	background:#9FF;
	color:#666;
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 15px;
}

#ind_based input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_based select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_based p{
	margin-bottom: 15px;
}

#ind_based p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#ind_based p span.error{
	color: #e46c6e;
}
#ind_based #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#ind_based #send:hover{
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

$qu = "select * from industrial_based where id = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$target = $ro['target'];
	$suv = $ro['surveys'];
	$imp = $ro['train_interv_imp'];
}
?>
<td>
<div id="exec">
<h2 align="center">INDUSTRIAL BASED RESEARCH PROPOSAL </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="ind_based" id="ind_based">
<input type="hidden" value="<?php echo $repo; ?>" name="repo" />
<p class="ex" align="left">Target : &nbsp;&nbsp;<input class="only" type="text" size="25" name="target" id="target" value="<?php echo $target ?>" /></p><br />
<p align="left" class="ex">NO. of Surveys carried out : &nbsp;&nbsp;<input class="only" type="text" size="25" name="surveys" id="surveys" value="<?php echo $suv ?>" /></p><br />
<p align="left" class="ex">Training Interview Implemented: &nbsp;&nbsp;<input class="only" type="text" size="25" name="training" id="training" value="<?php echo $imp ?>" /></p><br />
<p align="center"><input type="submit" id="send" value="Submit" name="submit" /></p><br />
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
	$target = $_POST['target'];
	$surveys = $_POST['surveys'];
	$training = $_POST['training'];
	
	$staff_info = "UPDATE industrial_based SET target = $target, surveys = $surveys, train_interv_imp = $training where id = $repo";
	
	mysqli_query( $connect, $staff_info) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_industrial_based.php");
}
?>
<script type="text/javascript" src="old_assets/val_ind_based.js"></script>
</body>
</head>
</html>