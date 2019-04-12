<?php
include("../includes/connections.php");

if ($_GET['m']) {
	$fid = $_GET['m'];
	//$fid = base64_decode(urldecode($m));
	// Update Count


	$query_path = "SELECT * FROM excel_tbl WHERE rep_id='$fid'";
	$result_path = mysqli_query($GLOBALS["___mysqli_ston"], $query_path) or die(mysqli_error($GLOBALS["___mysqli_ston"]));
	$row_path = mysqli_fetch_assoc($result_path);
	//$gf = 'statics';
		//$no_of_click = $row_path['no_of_downloads']+1;
		//$query_c = "UPDATE uploads SET no_of_downloads='$no_of_click' WHERE id='$fid'";
		//mysql_query($query_c) or die(mysql_error());

		$file = $row_path['report'];
		if ($file != ""){
			if (file_exists($file)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
			}
			else{
				echo "File does not Exist";
			}
				echo '<script type="text/javascript">window.location="add_unscheduled_part.php";</script>';
		}
	}
	else{
		echo '<script type="text/javascript">window.location="add_unscheduled_part.php";</script>';
	}
?>

