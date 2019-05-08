<?php
error_reporting(E_ALL);
error_reporting(1);
		$hostname = "localhost";
		$username = "itfdataba";
		$password = "474YdKl6bw";
		$database = "itfdatab_itfdatabank";
		$connect = ($GLOBALS["___mysqli_ston"] = mysqli_connect($hostname,  $username,  $password)) or die (mysqli_error($GLOBALS["___mysqli_ston"]));
		$siteName = "ITF";
		mysqli_select_db( $connect, $database);
		$db = new mysqli($hostname, $username, $password, $database);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
    }

	function mysqli_result($res,$row=0,$col=0){ 
		$numrows = mysqli_num_rows($res); 
		if ($numrows && $row <= ($numrows-1) && $row >=0){
			mysqli_data_seek($res,$row);
			$resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
			if (isset($resrow[$col])){
				return $resrow[$col];
			}
		}
		return false;
	}


?>