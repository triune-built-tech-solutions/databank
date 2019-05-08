<?php
require_once("../includes/header.php");
?>
	<div id="content"><!-- open content -->
		<style type="text/css">
			#rep input {
				padding: 3px;
				color: #949494;
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 13px;
				border: 1px solid #cecece;
			}

			#rep input.none {
				background: #9FF;
				color: #666;
				font-family: Tahoma, Geneva, sans-serif;
				font-size: 15px;
			}

			#rep input.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#rep select.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#rep textarea.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#rep p {
				margin-bottom: 15px;
			}

			#rep p span {
				margin-left: 10px;
				color: #b1b1b1;
				font-size: 11px;
				font-style: italic;
			}

			#rep p span.error {
				color: #e46c6e;
			}

			#rep #send {
				background: #6f9ff1;
				color: #fff;
				font-weight: 700;
				font-style: normal;
				border: 0;
				cursor: pointer;
			}

			#rep #send:hover {
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
					$division = $row_div[2];
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

			if (isset($_GET['msg']))
			{
				echo Alert::message($_GET['msg'], ['success' => "Record Inserted", 'failed' => "Error inserting Record"], 'modal');
			}

		?>

		<div class="card shadow">
			<div class="card-header">
				<h4>Add Your Report</h4>
			</div>
			<form class="card-body" name="report" action="log_query.php" method="post" id="rep">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr>
						<th>Report Type <br/>
							<select name="report_type" id="rep_type">
								<option value=" ">-report type-</option>
								<?php
								$query_report_type = "Select * from report_type";
								$result_report_type = mysqli_query($connect, $query_report_type);

								while ($row_report_type = mysqli_fetch_array($result_report_type)) {
									echo "<option value='" . $row_report_type[1] . "'>" . $row_report_type[1] . "</option>";
								}

								?>
							</select>
						</th>
						<th>Month<br/>
							<select name="month" id="rep_m">
								<option value=" ">-Month-</option>
								<?php
								$query_emonth = "Select * from emonth";
								$result_emonth = mysqli_query($connect, $query_emonth);

								while ($row_emonth = mysqli_fetch_array($result_emonth)) {
									echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
								}
								?>
							</select>
						</th>
						<th colspan="2">Year<br/>
							<select name="year" id="prog_year">
								<option value=" ">-Year-</option>
								<?php
								$query_eyear = "Select * from eyear";
								$result_eyear = mysqli_query($connect, $query_eyear);

								while ($row_eyear = mysqli_fetch_array($result_eyear)) {
									echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
								}
								?>
							</select>
						</th>
						<th colspan="2">Annual Target<br/>
							<select name="annual_target" id="ann_targ">
								<option value=" ">--SELECT--</option>
								<option value="1">Continues</option>
								<option value="2">Periodic</option>
							</select><br/>
							<select name="month_f" id="month_f">
								<option value=" ">--From--</option>
								<?php
								$query_emonth = "Select * from emonth";
								$result_emonth = mysqli_query($connect, $query_emonth);

								while ($row_emonth = mysqli_fetch_array($result_emonth)) {
									echo "<option value='" . $row_emonth[1] . "'>" . $row_emonth[1] . "</option>";
								}
								?>
							</select> &nbsp;&nbsp;||&nbsp;&nbsp;
							<select name="month_t" id="month_t">
								<option value=" ">--To--</option>
								<?php
								$query_emonth = "Select * from emonth";
								$result_emonth = mysqli_query($connect, $query_emonth);

								while ($row_emonth = mysqli_fetch_array($result_emonth)) {
									echo "<option value='" . $row_emonth[1] . "'>" . $row_emonth[1] . "</option>";
								}
								?>
							</select>
						</th>
					</tr>
					<tr>
						<th>Prog N<u>o</u><br/>
							<select name="prog_no" id="prog_no">

							</select>
						</th>
						<th>Prog Title <br/><span style="font-weight:normal" id="prog_title"> </span></th>
						<th>Sub Prog N<u>o</u><br/>
							<select name="sub_prog_no" id="sub_prog_no">

							</select></th>
						<th>Sub Prog Title <br/><span style="font-weight:normal" id="sub_prog_title"> </span></th>
						<th>Objective N<u>o</u><br/>
							<select name="obj_no" id="obj_no">

							</select>
						</th>
					</tr>
					<tr>
						<th colspan="6">Objectives <br/><span style="font-weight:normal" id="obj_title"> </span></th>
					</tr>
					</tr>
					<tr>
						<th colspan="6">ACTIVITIES CARRIED OUT</th>
					</tr>
					<tr>
						<td colspan="6">
<textarea name="activities" id="act" class="w-100 form-control">
</textarea>
						</td>
					</tr>
					<tr>
						<th colspan="6">ACHIEVEMENTS</th>
					</tr>
					<tr>
						<td colspan="6">
<textarea name="achievements" id="arch" class="w-100 form-control">
</textarea>
						</td>
					</tr>
					<tr>
						<th colspan="6">CONSTRAINT</th>
					</tr>
					<tr>
						<td colspan="6">
<textarea name="constraint" id="cons" class="w-100 form-control">
</textarea>
						</td>
					</tr>
				</table>
				<hr/>
				<p align="center">
					<button type="reset" value="Clear" class="btn btn-dark btn-sm" name="clear">Clear</button>&nbsp;&nbsp;&nbsp;&nbsp;
					<button class="btn btn-success btn-sm" type="submit" value="Submit" name="submit">Submit</button>&nbsp;
					<a class="btn btn-danger btn-sm" href="home.php">Exit</a>
				</p>
			</form>
		</div>

	</div><!-- close content -->
	<div id="divi">

	</div><br/>

<?php require_once("../includes/footer.php"); ?>