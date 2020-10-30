<?php
require_once("../includes/header.php");

require_once("../functions/function.php");
?>

	<div id="content"><!-- open content -->
		<style type="text/css">
			#staff_inf input {
				padding: 3px;
				color: #949494;
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 13px;
				border: 1px solid #cecece;
			}

			#staff_inf input.none {
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

			#staff_inf input.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#staff_inf select.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#staff_inf p {
				margin-bottom: 15px;
			}

			#staff_inf p span {
				margin-left: 10px;
				color: #b1b1b1;
				font-size: 11px;
				font-style: italic;
			}

			#staff_inf p span.error {
				color: #e46c6e;
			}

			#staff_inf #send {

			}

			#staff_inf #send:hover {
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
		<?php
		require_once("side_link.php");

		$repo = $_GET['id'];

		$qu = "select * from staff_info where id = $repo";
		$re = mysqli_query($connect, $qu);

		while ($ro = mysqli_fetch_assoc($re)) {
			$mon = $ro['month'];
			$yer = $ro['year'];
			$sen = $ro['senior_staff'];
			$jun = $ro['junior_staff'];
			$non = $ro['non_staff'];
			$dis = $ro['staff_dis'];
		}
		?>
		<?php
		$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
		$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
		$stateFetch1 = mysqli_fetch_assoc($stateResult1);
		$shwmon = $stateFetch1['emonth'];
		$shwmonid = $stateFetch1['emonth_id'];
		?>
		<div class="card shadow">
			<div class="card-header">
				<h4>Staff Information</h4>
			</div>
			<div id="exec" class="card-body">
				<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="staff_inf"
				      id="staff_inf">
					<input type="hidden" value="<?php echo $repo; ?>" name="repo"/>
					<div align="left" class="form-group form-inline">
						<label for="">Month :</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<select class="form-control" name="rep_month" id="rep_month">
							<option value=" <?php echo $shwmonid; ?>"/>
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
					<div align="left" class="form-group form-inline">
						<label for="">Year :</label>&nbsp;&nbsp;&nbsp;&nbsp;
						<select class="form-control" name="rep_year" id="rep_year">
							<option value=" <?php echo $yer; ?>"/>
							<?php echo $yer; ?></option>
							<?php
							$query_eyear = "Select * from eyear";
							$result_eyear = mysqli_query($connect, $query_eyear);

							while ($row_eyear = mysqli_fetch_array($result_eyear)) {
								echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
							}
							?>
						</select>
					</div>

					<div class="form-inline form-group" align="left">
						<label for="">No. of Senior Staff :</label>
						<input class="form-control ml-3" type="text" size="25" name="sen_staff" id="sen_staff" value="<?php echo $sen; ?>"/>
					</div>
					<div class="form-inline form-group"> &nbsp;&nbsp;
						<label for="">No. of Junior Staff :</label>
						<input class="form-control ml-3" type="text" size="25" name="jun_staff" id="jun_staff" value="<?php echo $jun; ?>"/>
					</div>
					<div align="left" class="form-group form-inline">
						<label for="">Other Non-Staff (IT NYSC etc) :</label>
						<input class="form-control ml-3" type="text" name="oth_staff" id="oth_staff" value="<?php echo $non; ?>"/>
					</div>
					<div align="left" class="form-group form-inline">
						<label for="">Staff disciplinary action during the month :</label>
						&nbsp;&nbsp;<textarea class="form-control" type="text" name="staff_dis" id="staff_dis" value="<?php echo $dis; ?>"></textarea>
					</div>
					<button class="btn btn-primary" type="submit" id="send" value="Change" name="submit">Submit</button>
				</form>
			</div>
		</div>
		<script>
            $('dd').filter('dd:nth-child(n+2)').hide();

            $('dt').click(function () {
                $(this).next().siblings('dd').hide();
                $(this).next().show();
            });
            //$('.subject').click(removeClass('li.page'));

		</script>
		<?php
		if (isset($_POST['submit'])) {
			$repo = $_POST['repo'];
			$rep_month = $_POST['rep_month'];
			$rep_year = $_POST['rep_year'];
			$sen_staff = $_POST['sen_staff'];
			$jun_staff = $_POST['jun_staff'];
			$oth_staff = $_POST['oth_staff'];
			$staff_dis = $_POST['staff_dis'];

			//if(intval($rep_month) & intval($rep_year) & intval($sen_staff) & intval($jun_staff) & intval($oth_staff) & intval($staff_dis)){

			$staff_info = "UPDATE staff_info SET month = $rep_month, year = $rep_year, senior_staff = $sen_staff, junior_staff = $jun_staff, non_staff = $oth_staff, staff_dis = $staff_dis where id = $repo";

			mysqli_query($connect, $staff_info) or
			die("Error connecting to server" . mysqli_error($GLOBALS["___mysqli_ston"]));
		}

		header("Location: view_staff_info.php");
		//}
		?>
	</div><!-- close content -->

<?= require_once("../includes/footer.php") ?>