<?php
session_start();
error_reporting(1);
$id = $_SESSION['user_id'];

require_once("../functions/function.php");
require_once("../includes/connections.php");
require_once('../includes/orm.php');


if(isset($_POST['submit'])){

	extract($_POST);

	//$date = time();
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);

	$_POST['auto_date'] = $auto_date;
	$_POST['status'] = 1;
	
	$query = "SELECT * FROM staff_reg where id = $id";
	$result = mysqli_query( $connect, $query);

	$row = mysqli_fetch_assoc($result);

	if ($result->num_rows > 0) {
		$_POST = array_merge($_POST, $row);
	}

	$sent = false;

	if($row['department'] == ""){
		$sent = ORM::insertData($_POST, 'report_log', $connect, [
			'username' => 'added_by',
			'div_id' => 'division',
			'constraint' => 'constraints'
		], ['section_id', 'id']);

	} else {
		$sent = ORM::insertData($_POST, 'report_log', $connect, [
			'username' => 'added_by',
			'section_id' => 'section',
			'div_id' => 'division',
			'constraint' => 'constraints'
		], ['id'], ['added_by' => 'username']);
	}
	
}
$type = $sent ? "success" : "failed";
header("location: report.php?msg={$type}");
?>