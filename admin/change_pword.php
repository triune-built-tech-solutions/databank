<?php
require_once("header.php");
?>
<?php
if(isset($_POST['pw_change'])){
	$corr = mysqli_query( $connect, "select * from staff_reg where id = $id");
	$oldpword = mysqli_fetch_assoc($corr);
	$oldp = $oldpword['password'];
	
	$oldpassword = $_POST['oldpassword'];
	$newpassword = $_POST['newpassword'];
	$conpassword = $_POST['conpassword'];
	$conpassword = md5($conpassword);
	$oldpassword = md5($oldpassword);
	$newpassword = md5($newpassword);
	
	if($oldp == $oldpassword && $newpassword == $conpassword){
		mysqli_query( $connect, "UPDATE staff_reg SET password = '{$newpassword}' WHERE id = {$id}") or
		die;
	}	
	header("location: change_pword.php");
}


?>
<style>
.notVisible {
	visibility:hidden;
}
</style>
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
<div id="data_show">
<?php

$query_acct = "SELECT * from staff_reg where id = $id";
$result_acct = mysqli_query( $connect, $query_acct);

$row_acct = mysqli_fetch_array($result_acct);

?>
<form name="add_use" method="post" action="" id="add_user">
<fieldset><legend><fieldset><span style="color:#F00"><h3>Change Password</h3></span></fieldset></legend>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'> Username </span> : &nbsp;&nbsp;&nbsp;<?php echo $row_acct[13]; ?></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Old Password</span> : <input type="password" size="50" name="oldpassword" id="oldp" /><span id="oldInfo">Former Password you use to login...</span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>New Password</span> : <input type="password" size="50" id="pass1" name="newpassword"  /><span id="pass1Info">At least 5 characters: letters, numbers and '_'</span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Confirm Password</span> : <input type="password" size="50" name="conpassword" id="pass2"  /><span id="pass2Info">Confirm password</span></div>
<div align="center"><input type="submit" name="pw_change" id="send" value="Save" /></div>
</fieldset>
</form>
</div>
</div><!-- close content -->
<div id="divi">

</div><br />
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 2018  &nbsp; &nbsp;<span style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript" src="old_assets/valid.js"></script>

</body>
</head>
</html>