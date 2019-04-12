<?php
require_once("header.php");


function getdepartment($id){
	$t="select department from department where id='$id'";	
	$q=mysqli_query($GLOBALS["___mysqli_ston"], $t);
	if(!$q){
		print mysqli_error($GLOBALS["___mysqli_ston"]);
		exit;	
	}
	list($dept)=mysqli_fetch_row($q);
	
	return $dept;
}
if($_POST){
	
	if(isset($_FILES['passport'])){
      $errors= array();
      $file_name = $_FILES['doc']['name'];
//      $file_size =$_FILES['doc']['size'];
      $file_tmp =$_FILES['doc']['tmp_name'];
      $file_type=$_FILES['doc']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['doc']['name'])));
      
      $expensions= array("jpeg","jpg","png","pdf","doc","docx,xls,xlsx");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a PDF, DOC, DOCX, JPEG, PNG file.";
      }
      
     // if($file_size > 2097152){
       //  $errors[]='File size must be excately 2 MB';
      //}
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"special_rpt/".$file_name);
         echo "Success";
		 $target_file="special_rpt/".$file_name;
      }else{
         print_r($errors);
      }
   }

	
	
$in="insert into special_rpt values(null,'$_POST[title]','$_POST[desc]','$_POST[programmestart]','$link')";


$q=mysqli_query($GLOBALS["___mysqli_ston"], $in);
if(!$q){
	print mysqli_error($GLOBALS["___mysqli_ston"]);
	exit;	
}

//header_remove();
//header("location:special_rpt.php?rpt=Special Report Added Successfully");
}
?>
<div id="content"><!-- open content -->
<div id="depart">
<?php
if(isset($department)){
	$query_dept = "SELECT * FROM department where id = $department";
	$result_dept = mysqli_query( $connect, $query_dept);
	
	while($row_dept = mysqli_fetch_array($result_dept)){
		$department = $row_dept[1];
		$idp = $row_dept[0];
		echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
	}
} else {
	$query_unit = "SELECT * FROM unit where id = $unit";
	$result_unit = mysqli_query( $connect, $query_unit);
		
		while($row_unit = mysqli_fetch_array($result_unit)){
			$department = $row_unit[1];
			$idps = $row_unit[0];
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



if(!empty($_GET['rpt'])){
    switch($_GET['rpt']){
        case 'Special Report Added Successfully':
            $statusMsgClass = 'alert-success';
            $statusMsg = 'Special Report Added successfully.';
            break;
        case 'err':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusMsgClass = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusMsgClass = '';
            $statusMsg = '';
    }
}
?>
</div>
<div id="query_opt">
	 <?php if(!empty($statusMsg)){
        echo '<div class="alert '.$statusMsgClass.'">'.$statusMsg.'</div>';
    } ?>
<form action="submit_specialrpt.php" method="post" enctype="multipart/form-data" name="report_query">
<table style="width:100%; border:1px solid #ccc; height:200px;" align="left">
<tr>
<td width="31%" height="41">Programme/Activity Title
</td>
<td align="left"><input type="text" name="title" class="form-control" style="width:250px;">
</td>
</tr>

<tr>
<td height="50">Description </td>
<td><input type="text" name="desc" class="form-control" style="width:250px;"> 
</td>
</tr>
<tr>
<td width="31%" height="41">Date</td>
<td width="69%"><input type="text" name="programmestart" class="form-control" style="width:250px;">
</td>
</tr>
<tr>
  <td>Department</td>
  <td>
  <?php
  if($access_right == 4){
	  $s="select * from department ";
} elseif ($access_right == 10){
	  $s="select * from unit where id='$idps'";
} else {
  $s="select * from department where id='$idp'";
}
  $q=mysqli_query($GLOBALS["___mysqli_ston"], $s);
  if(!$q){
		print mysqli_error($GLOBALS["___mysqli_ston"]);
		exit ; 
  }
  ?>
  <select name="dept" class="form-control" style="width:250px;">
  <?php
  while($r=mysqli_fetch_array($q)){
  ?>
 
  <option value="<?php print $r['id'] ?>"> <?php print $r['department'] ?> <?php print $r['unit'] ?></option>
  <?php
  }
  ?>

  </select>
  </td>
</tr>
<tr>
  <td>Upload Document   (Please choose a PDF, DOC, DOCX, JPEG, PNG file.) </td>
  <td><input type="file" name="doc" id="doc" /></td>
</tr>
<tr> <td height="47" colspan="2"> <input type="submit" value="Submit Report" class="btn btn-danger"></td></tr>
</table>


</form>
</div>
<p>
<table width="100%"> <tr> <td width="25%">Search </td><td colspan="2"><input type="text" name="search" class="form-control" style="width:400px;" placeholder="Search by Activity, Department of Unit"> </td><td> <input type="button" value="Search" class="btn btn-primary"></td></tr></table>
</p>
<div id="show_rep">
<table>
<tr style="background-color:#ccc; height:30px;">
<td>SN
</td>
<td>Activity Title
</td>
<td>Description
</td>
<td>Date
</td>
<td>Department/Unit
</td>
<td>Download Report
</td>
<td>Delete Report
</td>
</tr>
<?php
if($access_right == 4){
	$st="select * from special_rpt  order by programeestart desc limit 0,30";
} elseif ($access_right == 10){
	 $st="select * from special_rpt where departmentid='$idps' order by programeestart desc limit 0,30";
} else {
$st="select * from special_rpt where departmentid='$idp' order by programeestart desc limit 0,30";
}
$qr=mysqli_query($GLOBALS["___mysqli_ston"], $st);
if(!$qr){
	print mysqli_error($GLOBALS["___mysqli_ston"]);
	exit;	
}
while($re=mysqli_fetch_array($qr)){
?>
<tr style="height:30px;" class="record">
<td><?php  print $re['id'] ?>
</td>
<td><?php  print $re['title'] ?>
</td>
<td><?php  print $re['description'] ?>
</td>
<td><?php  print $re['programeestart'] ?>
</td>
<td><?php  print getdepartment($re['departmentid']) ?>
</td>
<td><a href="<?php print $re['link']; ?>" class="btn btn-warning">Download</a>
</td>
<td><a href="#" id="<?php print $re['id']; ?>" class="delbutton">Delete</a></td>
</tr>

<?php
}
?>
</table>

</div>
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
   url: "delete_spc.php",
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