<?php require_once("../includes/header.php"); ?>
	<div id="content"><!-- open content -->
		<style type="text/css">
			#scheduled input {
				padding: 3px;
				color: #949494;
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 13px;
				border: 1px solid #cecece;
			}

			#scheduled input.none {
				font-family: Tahoma, Geneva, sans-serif;
				font-size: 20px;
				width: 150px;
				height: 30px;
				background: #6f9ff1;
				color: #fff;
				font-weight: 700;
				font-style: normal;
				border: 0;
				cursor: pointer;
			}

			#scheduled input.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#scheduled select.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#scheduled p {
				margin-bottom: 15px;
			}

			#scheduled p span {
				margin-left: 10px;
				color: #b1b1b1;
				font-size: 11px;
				font-style: italic;
			}

			#scheduled p span.error {
				color: #e46c6e;
			}

			#scheduled #send {
				background: #6f9ff1;
				color: #fff;
				font-weight: 700;
				font-style: normal;
				border: 0;
				cursor: pointer;
			}

			#scheduled #send:hover {
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

			$qu = "select * from scheduled_training where id = $repo";
			$re = mysqli_query($connect, $qu);

			while ($ro = mysqli_fetch_assoc($re)) {
				$mon = $ro['month'];
				$yer = $ro['year'];
				$pro = $ro['prog_title'];
				$tra = $ro['training'];
				$imp = $ro['implemented'];
				$par = $ro['participants'];
				$org = $ro['organizations'];
				$revc = $ro['Revenue_f_c'];
				$amc = $ro['revcors'];
				$amo = $ro['revout'];
			}
			?>
			<?php
			$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
			$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
			$stateFetch1 = mysqli_fetch_assoc($stateResult1);
			$shwmon = $stateFetch1['emonth'];
			$shwmonid = $stateFetch1['emonth_id'];
			?>


		</div>
		<div class="card shadow">
			<div class="card-header">
				<h4>Edit Scheduled Training Programme</h4>
			</div>
			<div class="card-body">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="scheduled" id="scheduled">
					<input type="hidden" value="<?php echo $repo; ?>" name="repo"/>
					<div class="form-inline form-group">
						<label for="">Month :</label>
						<select class="form-control ml-3" name="rep_month" id="rep_month">
							<option value="<?php echo $shwmonid; ?>">
							<?php echo $shwmon; ?></option>
							<?php
							$query_emonth = "Select * from emonth";
							$result_emonth = mysqli_query($connect, $query_emonth);

							while ($row_emonth = mysqli_fetch_array($result_emonth)) {
								echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
							}
							?>
						</select>
					</div>
					<br/>
					<p align="left" class="form-inline form-group">Year : &nbsp;&nbsp;&nbsp;&nbsp;
						<select class="form-control ml-3" name="rep_year" id="rep_year">
							<option value=" <?php echo $yer; ?>">
							<?php echo $yer; ?></option>
							<?php
							$query_eyear = "Select * from eyear";
							$result_eyear = mysqli_query($connect, $query_eyear);

							while ($row_eyear = mysqli_fetch_array($result_eyear)) {
								echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
							}
							?>
						</select>
					</p>

					<div class="form-inline form-group">
						<label for="">Programme title:</label>
						<input class="form-control ml-3" type="text" size="25" name="prog_title" id="prog_title" value="<?php echo $pro ?>"/>
					</div>
					<div class="form-inline form-group" align="left">
						<label for="">Training :</label>
						<input class="form-control ml-3" type="text" size="25" name="training" id="training" value="<?php echo $tra ?>"/>
					</div>

					<div class="form-inline form-group">
						<label for="">NO. implemented :</label>
						<input class="form-control ml-3" type="text" size="25" name="implemented" id="implemented" value="<?php echo $imp ?>"/>
					</div>
					<div class="form-inline form-group">NO. of participants: &nbsp;&nbsp;
						<input class="form-control ml-3" type="text" size="25" name="participants" id="participants" value="<?php echo $par ?>"/>
					</div>
					<div class="form-inline form-group">
						<label for="">NO. of Organization:</label>
						<input class="form-control ml-3" type="text" size="25" name="organization" id="organization" value="<?php echo $org ?>"/>
					</div>
					<div class="form-inline form-group">
						<label for="">Revenue from Course:</label>
						<input class="form-control ml-3" type="text" size="25" name="rev_c" id="rev_c"
						       value="<?php echo $amc ?>"/>
					</div>
					<p align="left" class="form-inline form-group">
						<label for="">Amount Collected:</label>
						<input class="form-control ml-3" type="text" size="25" name="revenue" id="revenue" value="<?php echo $revc ?>"/>
					</p>
					<div class="form-inline form-group">
						<label for="">Amount Outstanding:</label>
						<input class="form-control ml-3" type="text" size="25" name="rev_t" id="rev_t" value="<?php echo $amo ?>"/>
					</div>
					<div>
						<button class="btn btn-primary" type="submit" id="send" value="Submit" name="submit">Submit</button>
					</div>
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
	</div>

<?php
require_once("../includes/footer.php");

$user_name = $_SESSION['user_name'];

if (isset($_POST['submit'])) {
	$repo = $_POST['repo'];
	$prog_title = $_POST['prog_title'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$training = $_POST['training'];
	$implemented = $_POST['implemented'];
	$participants = $_POST['participants'];
	$organization = $_POST['organization'];
	$revenue = $_POST['revenue'];
	$rev_c = $_POST['rev_c'];
	$rev_t = $_POST['rev_t'];

	$staff_info = "UPDATE scheduled_training SET month = '$rep_month', year = '$rep_year', prog_title = '$prog_title', training = '$training', implemented = '$implemented', participants = '$participants', organizations = '$organization', Revenue_f_c = '$revenue', revcors = '$rev_c', revout = '$rev_t'  where id = $repo";

	mysqli_query($connect, $staff_info) or
	die("Error connecting to server " . mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: view_scheduled_training.php");
}
?>