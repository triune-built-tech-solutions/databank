<?php
require_once("../includes/connections.php");

if(isset($_GET['user_id'])){
	$user_id = $_GET['user_id'];
	$fr_id = $_GET['fr_id'];
	
	if($fr_id == 0){
		$val = 1;
	}else {
		$val = 0;
	}
	
	$query_f = "UPDATE staff_reg SET freeze_id =".$val." where id = $user_id";
	mysqli_query( $connect, $query_f)or
		die ("Error Connecting to Server" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
	if($val == 0){
		echo "<script type=\"text/javascript\">
			alert(\"Account Released\");
			window.location = \"registered.php\"
		</script>";
	} else {
		echo "<script type=\"text/javascript\">
			alert(\"Account freezed\");
			window.location = \"registered.php\"
		</script>";
	}
}
?>