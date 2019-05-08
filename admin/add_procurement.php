<?php require_once("../includes/header.php"); ?>
<style>
	p.sid a {
		font-size: 15px;
		padding: 10px;
		margin: 0;
		color: #F00;
		font-style: italic;
	}

	div#pag {
		padding: 0 500px;
		font: bold;
		font-size: 500px;
		color: #F00;
		font-style: italic;
	}

	div#page {
		float: left;
	}
</style>
<div id="content"><!-- open content -->
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
	<br>
	<div>
		<a class="btn btn-danger" href="view_procurement.php">View Procurement Progressive Reports</a>
	</div>
	<hr/>

	<div id="page" class="card shadow mb-5">
		<div class="card-header">
			<h2>Procurement Progressive Report</h2>
		</div>
		<div class="card-body">
			<form method="post" action="process_nisdp_part.php" name="scheduled" id="scheduled">
				<div class="form-group form-inline">
					<label for="">Office Type :</label>
					<select class="form-control ml-3"  name="off_type">
						<option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option>
					</select>
				</div>

				<div align="left" class="form-inline form-group">
					<label for="">Office Location :</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control ml-3" name="off_loc">
						<option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option>
					</select>
				</div>

				<div class="form-group form-inline">
					<label for="">Month :</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control ml-3"  name="rep_month" id="rep_month">
						<option value=" ">-Month-</option>
						<?php
						$query_emonth = "Select * from emonth";
						$result_emonth = mysqli_query($connect, $query_emonth);

						while ($row_emonth = mysqli_fetch_array($result_emonth)) {
							echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
						}
						?>
					</select>
				</div>

				<div class="form-group form-inline">Year : &nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control ml-3" name="rep_year" id="rep_year">
						<option value=" ">-Year-</option>
						<?php
						$query_eyear = "Select * from eyear";
						$result_eyear = mysqli_query($connect, $query_eyear);

						while ($row_eyear = mysqli_fetch_array($result_eyear)) {
							echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
						}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="">Activity:</label>&nbsp;&nbsp;
					<input class="form-control" type="text" name="participants" id="participants"/>
				</div>

				<div class="form-group"> &nbsp;&nbsp;
					<label for="">User Department:</label>
					<input class="form-control" type="text" name="organization" id="organization"/>
				</div>

				<div class="form-group"> &nbsp;&nbsp;
					<label for="">Value/Cost :</label>
					<input class="form-control" type="text" name="email" id="email"/>
				</div>
				<div class="form-group"> &nbsp;&nbsp;
					<label for="">Objective :</label>
					<input class="form-control" type="text" name="address" id="address"/>
				</div>
				<div class="form-group"> &nbsp;&nbsp;
					<label for="">Action Taken: </label>
					<input class="form-control" type="text" name="phone" id="phone"/>
				</div>
				<div class="d-flex justify-content-center">
					<button class="btn btn-success" type="submit" id="send" value="Submit" name="submit">Submit</button>
				</div>
			</form>
		</div>

	</div>
	<p class="both"/>
</div><!-- close content -->

<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
