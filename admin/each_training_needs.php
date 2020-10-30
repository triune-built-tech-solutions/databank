<?php
require_once("../includes/header.php");
?>
	<div id="content"><!-- open content -->
		<style type="text/css">
			#train_need input {
				padding: 6px;
				color: #949494;
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 13px;
				border: 1px solid #cecece;
			}

			#train_need input.none {
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

			#train_need input.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#train_need select.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#train_need p {
				margin-bottom: 15px;
			}

			#train_need p span {
				margin-left: 10px;
				color: #b1b1b1;
				font-size: 11px;
				font-style: italic;
			}

			#train_need p span.error {
				color: #e46c6e;
			}

			#train_need #send {

			}

			#train_need #send:hover {
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
			<div class="card-header">
				<h4>Training Needs Assessment</h4>
			</div>
			<div class="card-body">
				<table>
					<tr>
						<?php
						require_once("side_link.php");

						$repo = $_GET['id'];

						$qu = "select * from training_needs where id = $repo";
						$re = mysqli_query($connect, $qu);

						while ($ro = mysqli_fetch_assoc($re)) {
							$mon = $ro['month'];
							$yer = $ro['year'];
							$tar = $ro['target'];
							$suv = $ro['surveys'];
							$dev = $ro['train_inter_dev'];
							$imp = $ro['train_inter_imp'];
						}
						?>
						<?php
						$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
						$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
						$stateFetch1 = mysqli_fetch_assoc($stateResult1);
						$shwmon = $stateFetch1['emonth'];
						$shwmonid = $stateFetch1['emonth_id'];
						?>
						<td>
							<div id="exec">
								<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="train_need"
								      id="train_need">
									<input type="hidden" value="<?php echo $repo; ?>" name="repo"/>
									<div class="form-group form-inline">
										<label for="">Month :</label>
										<select class="form-control ml-3" name="rep_month" id="rep_month">
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
									<div class="form-group form-inline">
										<label for="">Year :</label>
										<select class="form-control ml-3" name="rep_year" id="rep_year">
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

									<div class="form-group form-inline">
										<label for="">Target :</label>
										<input class="form-control ml-3" type="text" size="25" name="target" id="target" value="<?php echo $tar ?>"/>
									</div>
									<div class="form-group form-inline">
										<label for="">NO. of Surveys carried out :</label>
										<input class="form-control ml-3" type="text" size="25" name="surv_c_o" id="surv_c_o" value="<?php echo $suv ?>"/>
									</div>

									<div class="form-group form-inline">
										<label for="">Training Intervention Developed :</label>
										<input class="form-control ml-3" type="text" size="25" name="train_int_dev" id="train_int_dev" value="<?php echo $dev ?>"/>
									</div>

									<div class="form-group form-inline">
										<label for="">Training Intervention Implemented:</label>
										<input class="form-control ml-3" type="text" size="25" name="train_int_imp" id="train_int_imp" value="<?php echo $imp ?>"/>
									</div>
									<div>
										<button class="btn-primary btn" type="submit" id="send" value="Change" name="submit">Submit</button>
									</div>
								</form>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>

	</div>

	<script>
        $('dd').filter('dd:nth-child(n+2)').hide();

        $('dt').click(function () {
            $(this).next().siblings('dd').hide();
            $(this).next().show();
        });
        //$('.subject').click(removeClass('li.page'));

	</script><!-- close content -->


<?php

require_once("../includes/footer.php");

$user_name = $_SESSION['user_name'];

if (isset($_POST['submit'])) {
	$repo = $_POST['repo'];
	$rep_month = $_POST['rep_month'];
	$rep_year = $_POST['rep_year'];
	$target = $_POST['target'];
	$surv_c_o = $_POST['surv_c_o'];
	$train_int_dev = $_POST['train_int_dev'];
	$train_int_imp = $_POST['train_int_imp'];

	$staff_info = "UPDATE training_needs SET month = $rep_month, year = $rep_year, target = $target, surveys = $surv_c_o, train_inter_dev = $train_int_dev, train_inter_imp = $train_int_imp where id = $repo";

	mysqli_query($connect, $staff_info) or
	die("Error connecting to server " . mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: view_training_needs.php");
}
?>