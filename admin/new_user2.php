<?php
include "checkUser.php";
include("../includes/auto_logout.php");
require_once("header.php");
$user_name = $_SESSION['user_name'];
if(isset($_POST['submit_user']) && $_POST['office_location'] != ""){
	if(isset($_POST['department'])){
		$staff_no = $_POST['staff_no'];
		$title = $_POST['title'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$office_type = $_POST['office_type'];
		$office_location = $_POST['office_location'];
		$access_right = $_POST['access_right'];
		$department = $_POST['department'];
		$division = $_POST['division'];
		$section = $_POST['section'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conpassword = $_POST['conpassword'];
		$conpassword = md5($conpassword);
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
		if($department == " "){
			$department = 'null';
		}
		if($section == " "){
			$section = 'null';
		}
		if($division == " "){
			$division = 'null';
		}
	} else if(isset($_POST['unt'])){
		$staff_no = $_POST['staff_no'];
		$title = $_POST['title'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$office_type = $_POST['office_type'];
		$office_location = $_POST['office_location'];
		$access_right = $_POST['access_right'];
		$unit = $_POST['unt'];
		$sub_unit = $_POST['subUnit'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$conpassword = $_POST['conpassword'];
		$conpassword = md5($conpassword);
		$password = md5($password);
		$auto_date = time();
		$show_date = date("d/m/Y H:i", $auto_date);
		$added_by = $user_name;
	}
	if($middle_name == " "){
		$middle_name = 'null';

	}
	//$result = mysql_query("select * from staff_reg where username = '$username'");
	//$row = mysql_num_rows($result);
	//if($password == $conpassword && $row < 1 && $password !== " "){
	if(isset($department)){
		$query = "INSERT INTO staff_reg22 VALUES(null, '$staff_no', '$title', '$first_name', '$middle_name', '$last_name', '$gender', '$office_type', '$office_location', '$access_right', '$department', '$division', '$section', '$username', '$password', 0, '$added_by', '$show_date', null, null, 0)";
		} else if(isset($unit)) {
			$query = "INSERT INTO staff_reg22 VALUES(null, '$staff_no', $title, '$first_name', '$middle_name', '$last_name', $gender, $office_type, $office_location, $access_right, null, null, null, '$username', '$password', 0, '$added_by', '$show_date', $unit, $sub_unit)";
		}
		mysqli_query( $connect, $query) or
	die ("Error Inserting to Table staff_reg" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
	header("location: add_user2.php");
} else 
	header("location: add_user2.php");
//}
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
<form method="post" action="" name="add_user" id="add_user">
<fieldset><legend><fieldset><span style="color:#F00"><h3>Add new user</h3></span></fieldset></legend>
<td height="20" colspan="4"><?php if(isset($_GET['Data']) && $_GET['msg']){
			 // $messag = $_GET['&'];
        echo "<tr>
          <td height='29' colspan='3' bgcolor='#99CC33'><font color='#fff'>Data Saved Succesufully</font></td>
          </tr>";
          }
		  
		  ?>
              </td>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Staff N<u>o</u></span> : <input type="text" size="35" name="staff_no" id="staff_no" /><span id="staffInfo">What's your staff number?</span></div>
<p><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Title</span> : <select name="title" id="title"><option value=" ">--Title--</option>

<?php
$result_title = mysqli_query( $connect, "select * from title");
while($row_title_name = mysqli_fetch_array($result_title)){
	echo "<option value='".$row_title_name[0]."'>".$row_title_name[1]."</option>";
}

?>
</select></p>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Firstname</span> : <input type="text" name="first_name" id="first_name" size="35" /><span id="nameInfo">What's your firstname?</span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Middlename</span> : <input type="text" name="middle_name" id="middle_name" size="35" /><span id="mnameInfo">What's your middlename?</span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Surname</span> : <input type="text" name="last_name" id="last_name" size="35" /><span id="lnameInfo">What's your surname name?</span></div>

<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Gender</span> : <select id="gender" name="gender"><option value=" ">--Gender--</option>
<?php
$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender");
while($row_gender = mysqli_fetch_array($result_gender)){
	echo "<option value='".$row_gender[0]."'>".$row_gender[1]."</option>";
}

?>
</select></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Office Type</span> : 
<select name="office_type" id="office_t"><option value=" ">--Office type--</option>
<?php
$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
while($row_office_type = mysqli_fetch_array($result_office_type)){
	echo "<option value='".$row_office_type[0]."'>".$row_office_type[1]."</option>";
}
?>
</select></div>
<div id="opti" class="notVisible">
<span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Dept/Unit</span> :
<select name="opti" id="optio">
<option value=" ">-Select-</option>
<option value="1">Department</option>
<option value="2">Unit</option>
</select>
</div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Office Location</span> : <select name="office_location" id="office_loc">

</select></div>
<div>
<span id="d_op"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Department</span> : <select name="department" id="dept"><option value=" ">--Department--</option>
<?php
$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
while($row_dept = mysqli_fetch_array($result_dept)){
	echo "<option value='".$row_dept[0]."'>".$row_dept[1]."</option>";
}
?>
</select></span>&nbsp;&nbsp;
<span id="un" class="notVisible"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Unit</span> : <select id="unit" name="unt"><option value=" ">--Unit--</option>
<?php

$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
while($row_unit = mysqli_fetch_array($result_unit)){
	echo "<option value='".$row_unit[0]."'>".$row_unit[1]."</option>";
}
?>
</select></span>
</div>
<div><span id="di_op"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Division</span> : <select name="division" id="div"><option value=" "> </option>

</select></span>&nbsp;&nbsp;
<span id="s_un" class="notVisible"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Sub-unit</span> : <select name="subUnit" id="sub_unit">

</select></span>
</div>
<div id="s_op"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Section</span> : <select name="section" id="sect">
<option value=" "> </option>

</select></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Username</span> : <input type="text" size="35" id="username" name="username" /><span id="unameInfo">Remember your username, you will need it to log in! </span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Password</span> : <input type="password" size="35" id="pass1" name="password" /><span id="pass1Info">At least 5 characters: letters, numbers and '_'</span></div>
<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Confirm Password</span> : <input type="password" size="35" id="pass2" name="conpassword" /><span id="pass2Info">Confirm password</span></div>

<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Access Right</span> : <select name="access_right" id="access_right"><option value=" ">--Access right--</option>
<?php
$result_access = mysqli_query($GLOBALS["___mysqli_ston"], "select * from assess_right order by right_id");
while($row_access = mysqli_fetch_array($result_access)){
	echo "<option value='".$row_access[0]."'>".$row_access[1]."</option>";
}

?>
</select></div>


<div align="center"><input id="send" type="submit" value="Add user" name="submit_user" /></div>
</fieldset>
</form>
</div>
</div><!-- close content -->
<div id="divi">

</div><br />
<?php
include("../includes/footer.php");
?>