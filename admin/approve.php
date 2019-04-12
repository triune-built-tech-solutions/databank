<?php
require_once("../includes/connections.php");

if(isset($_GET['id']) && isset($_GET['satus'])){
	$id = $_GET['id'];
	$fr_id = $_GET['satus'];
	
	if($fr_id == 0){
		$val = 1;
	}else {
		$val = 0;
	}
	
	$query_f = "UPDATE report_log SET status =".$val." where id = $id";
	mysqli_query( $connect, $query_f)or
		die ("Error Connecting to Server" .mysqli_error($GLOBALS["___mysqli_ston"]));
	
		echo "<script type=\"text/javascript\">
			alert(\"report Approved\");
			window.location = \"view_report.php\"
		</script>";
}
?>