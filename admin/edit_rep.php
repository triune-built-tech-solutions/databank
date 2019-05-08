<?php require_once("../includes/header.php");


if (isset($_GET['repId'])) {
	$sn = $_GET['repId'];

}

require_once("../functions/function.php");

if (isset($_POST['edit_rep']) && !empty($_POST['activities'])) {
	$activities = $_POST['activities'];
	$archievements = $_POST['archievements'];
	$constraints = $_POST['constraints'];

	$activities = mysql_prep($activities);
	$archievements = mysql_prep($archievements);
	$constraints = mysql_prep($constraints);

	$edit = "UPDATE report_log SET activities = '$activities', achievements = '$archievements', constraints = '$constraints' WHERE id = $sn";

	mysqli_query($connect, $edit) or
	die("Error connecting to server" . mysqli_error($GLOBALS["___mysqli_ston"]));

	header("Location: vet_report.php");
} else {
	header("location: vet_report.php");
}

require_once("../functions/function.php");
?>
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
		$query_report = "SELECT * from report_log where id = $sn";
		$result_rep = mysqli_query($connect, $query_report);
		while ($row_rep = mysqli_fetch_array($result_rep)) {
			$prog = $row_rep['prog_no'];
			$obj = $row_rep['obj_no'];
			$sub_prog = $row_rep['sub_prog_no'];
			$report_type = $row_rep['report_type'];
			$department = $row_rep['department'];
			$added_by = $row_rep['added_by'];
			$month = $row_rep['month'];
			$year = $row_rep['year'];
			$activity = $row_rep['activities'];
			$achievement = $row_rep['achievements'];
			$constraints = $row_rep['constraints'];

			$prog_res = mysqli_query($connect, "select * from prog_no where prog_no = $prog and prog_year = $year");
			$prog_row = mysqli_fetch_array($prog_res);
		}
		if (isset($department)) {
			$query_depart = "SELECT * FROM department where id = $department";
			$result_depart = mysqli_query($connect, $query_depart);

			while ($row_depart = mysqli_fetch_array($result_depart)) {
				$department = $row_depart[1];
			}
		} else {
			$query_unit = "SELECT * FROM unit where id = $unit";
			$result_unit = mysqli_query($connect, $query_unit);

			while ($row_unit = mysqli_fetch_array($result_unit)) {
				$department = $row_unit[1];
			}
		}
		$month_query = mysqli_query($connect, "select * from emonth where emonth_id = $month");
		$month_row = mysqli_fetch_array($month_query);
		?>
		<div class="card shadow">
			<div class="card-header">
				<h4>Edit Report</h4>
			</div>
			<div class="card-body">
				<table class="table table-responsive">
					<tr>
						<td><b>Report Type</b></td>
						<td><b>Programme N<u>o</u></b></td>
						<td><b>Programme</b><br></td>
						<td><b>Sub Prog. N<u>o</u></b></td>
						<td><b>Objective N<u>o</u></b></td>
						<td><b>Department</b></td>
						<td><b>Month</b></td>
						<td><b>Year</b></td>
					</tr>
					<tr>
						<td><?php echo $report_type ?></td>
						<td><?php echo $prog ?></td>
						<td><?php echo $prog_row[2] ?></td>
						<td><?php echo $sub_prog ?></td>
						<td><?php echo $obj ?></td>
						<td><?php echo $department ?></td>
						<td><?php echo $month_row[1] ?></td>
						<td><?php echo $year ?></td>
					</tr>
				</table>

				<hr>

				<form class="row mt-5" action="" method="post" name="edit_report">
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Activities</b></label>
							<textarea class="form-control" rows="10" cols="145" name="activities"><?php echo $activity ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Achievements</b></label>
							<textarea class="form-control" rows="10" cols="145" name="archievements"><?php echo $achievement ?></textarea>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label><b>Constraints</b></label>
							<textarea class="form-control" rows="10" cols="145" name="constraints"><?php echo $constraints ?></textarea>
						</div>
					</div>
					<div class="col-md-12 d-flex justify-content-center form-group">
						<button class="btn btn-success" type="submit" name="edit_rep" value="Save Changes">Save Changes`</button>
					</div>
				</form>
			</div>
		</div>
		<?php


		?>
	</div><!-- close content -->

<?php require_once("../includes/footer.php") ?>