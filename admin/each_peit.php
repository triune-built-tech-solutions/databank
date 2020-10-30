<?php
require_once("../includes/header.php");
?>
<div id="content"><!-- open content -->
	<style type="text/css">
		#peit input {
			padding: 3px;
			color: #949494;
			font-family: Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			border: 1px solid #cecece;
		}

		#peit input.none {
			background: #9FF;
			color: #666;
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 15px;
		}

		#peit input.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#peit select.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#peit p {
			margin-bottom: 15px;
		}

		#peit #send {
			background: #6f9ff1;
			color: #fff;
			font-weight: 700;
			font-style: normal;
			border: 0;
			cursor: pointer;
		}

		#peit #send:hover {
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
	
	<div>
		<?php
		require_once("side_link.php");

		$repo = $_GET['id'];

		$qu = "select * from peit where id = $repo";
		$re = mysqli_query($connect, $qu);

		while ($ro = mysqli_fetch_assoc($re)) {
			$target = $ro['target'];
			$sur = $ro['surveys'];
			$pac = $ro['packages'];
			$imp = $ro['implemented'];
			$par = $ro['participants'];
		}
		?>
	</div>
	
	<div class="card shadow">
		<div class="card-header">
			<h4>Edit Training Packages (PPIT) Details</h4>
		</div>
		<div id="exec" class="card-body">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="peit" id="peit">
				<input type="hidden" value="<?php echo $repo; ?>" name="repo"/>
				<p class="form-group form-inline">Target :
					<input class="form-control ml-3" type="text" size="25" name="target" id="target" value="<?php echo $target ?>"/>
				</p>
				<br/>

				<p class="form-group form-inline">No. of Surveys carried out :
					<input class="form-control ml-3" type="text" size="25" name="surv_c_o" id="surv_c_o" value="<?php echo $sur ?>"/>
				</p>
				<br/>

				<p class="form-group form-inline">No. of packages developed :
					<input class="form-control ml-3" type="text" size="25" name="packages_dev" id="packages_dev" value="<?php echo $pac ?>"/>
				</p>
				<br/>

				<p class="form-group form-inline">No. implemented:
					<input class="form-control ml-3" type="text" size="25" name="implemented" id="implemented" value="<?php echo $imp ?>"/>
				</p>
				<br/>

				<p class="form-group form-inline">No. of participants:
					<input class="form-control ml-3" type="text" size="25" name="participants" id="participants" value="<?php echo $par ?>"/>
				</p>
				<br/>

				<div>
					<button class="btn btn-primary " type="submit" value="Change" name="submit" id="send">Submit</button>
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
$user_name = $_SESSION['user_name'];

if (isset($_POST['submit'])) {
	$repo = $_POST['repo'];
	$target = $_POST['target'];
	$surv_c_o = $_POST['surv_c_o'];
	$packages_dev = $_POST['packages_dev'];
	$implemented = $_POST['implemented'];
	$participants = $_POST['participants'];

	$staff_info = "UPDATE peit SET target = $target, surveys = $surv_c_o, packages = $packages_dev, implemented = $implemented, participants = $participants where id = $repo";

	mysqli_query($connect, $staff_info) or
	die("Error connecting to server " . mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: view_peit.php");

}
?>


<?php
require_once("../includes/footer.php");
?>