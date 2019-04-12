<?php
require_once("header.php");
?>
<div id="content"><!-- open content -->
<style type="text/css">
#ind_app input{
	padding: 3px;
	color: #949494;
	font-family: Arial,  Verdana, Helvetica, sans-serif;
	font-size: 13px;
	border: 1px solid #cecece;
}

#ind_app input.none{
	font-family:Tahoma, Geneva, sans-serif;
	font-size: 20px;
	width: 150px;
	height: 30px;
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}


#ind_app input.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_app select.error{
	background: #f8dbdb;
	border-color: #e77776;
}

#ind_app p{
	margin-bottom: 15px;
}

#ind_app p span{
	margin-left: 10px;
	color: #b1b1b1;
	font-size: 11px;
	font-style: italic;
}

#ind_app p span.error{
	color: #e46c6e;
}
#ind_app #send{
	background: #6f9ff1;
	color: #fff;
	font-weight: 700;
	font-style: normal;
	border: 0;
	cursor: pointer;
}

#ind_app #send:hover{
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
//require_once("side_link.php");

$repo = $_GET['id'];

$qu = "select * from vehicles where sn = $repo";
$re = mysqli_query( $connect, $qu);

while($ro = mysqli_fetch_assoc($re)){
	$make = $ro['make'];
	$colour = $ro['colour'];
	$chassis = $ro['chassis'];
	$engine_no = $ro['engine_no'];
	$registration = $ro['registration'];
	$date_purchase = $ro['date_purchase'];
	$price = $ro['price'];
	$location = $ro['location'];
	$use_u = $ro['use_u'];
}

?>

<?php
				$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
				$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
				$stateFetch1 = mysqli_fetch_assoc($stateResult1);
				$shwmon =$stateFetch1['emonth'];
				$shwmonid =$stateFetch1['emonth_id'];
  				?>
<td>
<div id="exec">
<h2 align="center">Edit ITF UTILITY VEHICLE </h2><br />
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="c_approval" id="c_approval">
<input type="hidden" value="<?php echo $repo ?>" name="repo" />

<p align="left" class="ex">Make of Vehicle: &nbsp;&nbsp;<input class="only" type="text" size="25" name="make" id="participants" value="<?php echo $make ?>"/></p><br />
<p align="left" class="ex">Colour: &nbsp;&nbsp;<input class="only" type="text" size="25" name="colour" id="organization" value="<?php echo $colour ?>"/></p><br />
<p class="ex" align="left">Date of Purchase : &nbsp;&nbsp;<input class="only" type="text" size="25" name="date_purchase" id="email" value="<?php echo $date_purchase ?>"/></p><br />
<p class="ex" align="left">Price : &nbsp;&nbsp;<input class="only" type="text" size="25" name="price" id="address" value="<?php echo $price ?>"/></p><br />
<p align="left" class="ex">Chassis No. : &nbsp;&nbsp;<input class="only" type="text" size="25" name="chassis" id="phone" value="<?php echo $chassis ?>"/></p><br />
<p align="left" class="ex">Engine No. : &nbsp;&nbsp;<input class="only" type="text" size="25" name="engine" id="phone" value="<?php echo $engine_no ?>"/></p><br />
<p align="left" class="ex">Registration No.: &nbsp;&nbsp;<input class="only" type="text" size="25" name="registration" id="phone" value="<?php echo $registration ?>"/></p><br />
<p align="left" class="ex">Location: &nbsp;&nbsp;<input class="only" type="text" size="25" name="location" id="phone" value="<?php echo $location ?>"/></p><br />
<p align="left" class="ex">Use: &nbsp;&nbsp;<input class="only" type="text" size="25" name="use" id="phone" value="<?php echo $use_u ?>"/></p><br />

<p align="center"><input class="none" type="submit"  value="Submit" name="submit" id="send" /></p><br />
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

	$make = $_POST['make'];
	$colour = $_POST['colour'];
	$date_purchase = $_POST['date_purchase'];
	$price = $_POST['price'];
	$chassis = $_POST['chassis'];
	$engine = $_POST['engine'];
	$registration = $_POST['registration'];
	$location = $_POST['location'];
	$use = $_POST['use'];

	$vehnfo = "UPDATE vehicles SET make = '$make', colour = '$colour', date_purchase = '$date_purchase', price = '$price', chassis = '$chassis', engine_no = '$engine', registration = '$registration', location = '$location', use_u = '$use' where sn = $repo";
	
	mysqli_query( $connect, $vehnfo) or
	die("Error connecting to server ".mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("Location: view_vehicle.php");
}
?>
<script type="text/javascript" src="old_assets/val_ind_app.js"></script>
</body>
</head>
</html>