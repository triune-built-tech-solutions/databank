<?php
require_once("../includes/header.php");
?>
<div id="content"><!-- open content -->
	<style type="text/css">
		#ind_train input {
			padding: 3px;
			color: #949494;
			font-family: Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			border: 1px solid #cecece;
		}

		#ind_train input.none {
			background: #9FF;
			color: #666;
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 15px;
		}

		#ind_train input.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#ind_train select.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#ind_train p {
			margin-bottom: 15px;
		}

		#ind_train p span {
			margin-left: 10px;
			color: #b1b1b1;
			font-size: 11px;
			font-style: italic;
		}

		#ind_train p span.error {
			color: #e46c6e;
		}

		#ind_train #send {
			background: #6f9ff1;
			color: #fff;
			font-weight: 700;
			font-style: normal;
			border: 0;
			cursor: pointer;
		}

		#ind_train #send:hover {
			background: #79a7f1;
		}

		#error {
			margin-bottom: 20px;
			border: 1px solid #efefef;
		}
	</style>
	<div id="depart">
		<?php
		if (isset($department)) {
			$query_dept = "SELECT * FROM department where id = $department";
			$result_dept = mysqli_query($connect, $query_dept);

			while ($row_dept = mysqli_fetch_array($result_dept)) {
				$department = $row_dept[1];
				echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
			}
		} else {
			$query_unit = "SELECT * FROM unit where id = $unit";
			$result_unit = mysqli_query($connect, $query_unit);

			while ($row_unit = mysqli_fetch_array($result_unit)) {
				$department = $row_unit[1];
				echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> UNIT:</span> " . $row_unit[1] . ".&nbsp;&nbsp;&nbsp;";
			}
		}
		if (isset($division)) {
			$query_div = "SELECT * FROM division where id = $division";
			$result_div = mysqli_query($connect, $query_div);

			while ($row_div = mysqli_fetch_array($result_div)) {
				echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> DIVISION:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
			}
		} else {
			$query_div = "SELECT * FROM sub_unit where id = $sub_unit";
			$result_div = mysqli_query($connect, $query_div);

			while ($row_div = mysqli_fetch_array($result_div)) {
				$division = $row_div[2];
				echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SUB UNIT:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
			}
		}
		if (isset($section)) {
			$query_section = "SELECT * FROM section where section_id = $section";
			$result_section = mysqli_query($connect, $query_section);

			while ($row_section = mysqli_fetch_array($result_section)) {
				echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SECTION:</span> " . $row_section[2] . ".</p>";
			}
		}
		?>
	</div>
	<div class="card shadow">
		<div>
			<?php
			require_once("side_link.php");

			$repo = $_GET['id'];

			$qu = "select * from industrial_training where id = $repo";
			$re = mysqli_query($connect, $qu);

			while ($ro = mysqli_fetch_assoc($re)) {
				$prom = $ro['prom_visits'];
				$appr = $ro['appraisal'];
				$inst = $ro['install_harmonized'];
				$moni = $ro['monitored'];
			}

			?>
		</div>
		<div class="card-header">
			<h4>Register Industrial Training and Development Programme</h4>
		</div>
		<div id="exec" class="card-body ml-5">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="ind_train" id="ind_train">
				<input type="hidden" value="<?php echo $repo ?>" name="repo"/>
				<p class="form-inline form-group">No. of Promotional visits :
					<input class="form-control ml-3" type="text" size="25" name="prom_vis" id="prom_vis" value="<?php echo $prom ?>"/>
				</p>
				<br/>

				<p class="form-inline form-group">No. of Appraisal :
					<input class="form-control ml-3" type="text" size="25" name="appraisal" id="appraisal" value="<?php echo $appr ?>"/>
				</p>
				<br/>

				<p class="form-inline form-group">No. of installed/Harmonized :
					<input class="form-control ml-3" type="text" size="25" name="inst_harm" id="inst_harm" value="<?php echo $inst ?>"/>
				</p>
				<br/>

				<p class="form-inline form-group">No. Monitured:
					<input class="form-control ml-3" type="text" size="25" name="monitored" id="monitored" value="<?php echo $moni ?>"/>
				</p>
				<br/>

				<div>
					<button class="btn btn-primary" type="submit" value="Submit" name="submit" id="send">Submit</button>
				</div>
				<br/>
			</form>
		</div>
	</div>
</div><!-- close content -->
<div id="divi">
	<script>
        $('dd').filter('dd:nth-child(n+2)').hide();

        $('dt').click(function () {
            $(this).next().siblings('dd').hide();
            $(this).next().show();
        });
        //$('.subject').click(removeClass('li.page'));

	</script>
</div><br/>

<?php
require_once ("../includes/footer.php") ;
$user_name = $_SESSION['user_name'];

if (isset($_POST['submit'])) {
	$repo = $_POST['repo'];
	$prom_vis = $_POST['prom_vis'];
	$appraisal = $_POST['appraisal'];
	$inst_harm = $_POST['inst_harm'];
	$monitored = $_POST['monitored'];

	$staff_info = "UPDATE industrial_training SET prom_visits = $prom_vis, appraisal = $appraisal, install_harmonized = $inst_harm, monitored = $monitored where id = $repo";

	mysqli_query($connect, $staff_info) or
	die("Error connecting to server " . mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: view_industrial_training.php");
}
?>
