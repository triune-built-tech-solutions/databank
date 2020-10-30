<?php
require_once("../includes/header.php");
?>
	<style>
		#none {
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

		<?php require_once("side_link.php") ?>

		<div class="d-flex justify-content-center">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query">

				<div class="form-group form-inline">
					<select class="form-control mr-3" name="month">
						<option value=" ">-Month-</option>
						<?php
						$query_emonth = "Select * from emonth";
						$result_emonth = mysqli_query($connect, $query_emonth);

						while ($row_emonth = mysqli_fetch_array($result_emonth)) {
							echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
						}
						?>
					</select>

					<select class="form-control mr-3" name="year">
						<option value=" ">-Year-</option>
						<?php
						$query_eyear = "Select * from eyear";
						$result_eyear = mysqli_query($connect, $query_eyear);

						while ($row_eyear = mysqli_fetch_array($result_eyear)) {
							echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
						}
						?>
					</select>

					<select class="form-control mr-3" name="office_type" id="office_t">
						<option value=" ">-office_type-</option>
						<?php
						$query_office_type = "Select * from office_type";
						$result_office_type = mysqli_query($connect, $query_office_type);

						while ($row_office_type = mysqli_fetch_array($result_office_type)) {
							echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
						}
						?>
					</select>

					<select class="form-control mr-3" name="office_loc" id="office_loc">
						<option value=" "></option>
					</select>
					<button class="btn btn-success" type="submit" name="begin_query" value="Begin Query">Begin Query</button>
				</div>

			</form>
		</div>

		<div class="card shadow">
			<div class="card-header">
				<h4>Staff Information Reports</h4>
			</div>
			<div class="card-body">
				<table class="table table-hover table-responsive" cellspacing="0">
					<thead>
					<tr>
						<th>S/N</th>
						<th>Office Type</th>
						<th>Office Location</th>
						<th>Senior staff</th>
						<th>Junior staff</th>
						<th>Non-staff</th>
						<th>Total staff</th>
						<th>Staff discipline</th>
						<th>month</th>
						<th>Year</th>
						<th>Date added</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
					</thead>

					<?php
					if (isset($_POST['begin_query'])) {
						$month = $_POST['month'];
						$year = $_POST['year'];
						$office_type = $_POST['office_type'];
						$office_location = $_POST['office_loc'];

						if ($month !== " ") {
							$opt = "where month = " . $month;
						}
						if ($year !== " " && !isset($opt)) {
							$opt = "where year = '" . $year . "'";
						} else if ($year !== " " && isset($opt)) {
							$opt .= " and year = " . $year;
						}
						if ($office_type !== " " && !isset($opt)) {
							$opt = "where office_type = " . $office_type;
						} else if ($office_type !== " " && isset($opt)) {
							$opt .= " and office_type = " . $office_type;
						}
						if ($office_location !== " ") {
							$opt .= " and office_location = " . $office_location;
						}
					}

					if (empty($opt)) {
						$opt = " ";
					}

					if ($access_right == 4) {
						$query_report_view = "select * from staff_info $opt order by year desc, month desc limit 80";
					} else {
						$query_report_view = "select * from staff_info where added_by = '" . $_SESSION['user_name'] . "' order by year desc, month desc limit 80";
					}

					$result_report_view = mysqli_query($connect, $query_report_view);

					for ($i = 0; $i < mysqli_num_rows($result_report_view); $i++) {
						$rep_id = mysqli_result($result_report_view, $i, "id");
						$office_type = mysqli_result($result_report_view, $i, "office_type");
						$office_location = mysqli_result($result_report_view, $i, "office_location");
						$month = mysqli_result($result_report_view, $i, "month");
						$year = mysqli_result($result_report_view, $i, "year");
						$auto_date = mysqli_result($result_report_view, $i, "auto_date");
						$added_by = mysqli_result($result_report_view, $i, "added_by");
						$senior_staff = mysqli_result($result_report_view, $i, "senior_staff");
						$junior_staff = mysqli_result($result_report_view, $i, "junior_staff");
						$non_staff = mysqli_result($result_report_view, $i, "non_staff");
						$staff_dis = mysqli_result($result_report_view, $i, "staff_dis");

						$total_staff = $senior_staff + $junior_staff + $non_staff;

						$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
						$result_office = mysqli_query($connect, $query_office);

						while ($row_office = mysqli_fetch_array($result_office)) {
							$office_location = $row_office['2'];
						}

						if ($i % 2) {
							$bg_color = "#a8c2f7";
						} else {
							$bg_color = "#f0f9f0";
						}

						$query_office = "SELECT type FROM office_type where id = $office_type";
						$result_office = mysqli_query($connect, $query_office);

						while ($row_office = mysqli_fetch_assoc($result_office)) {
							$office_name = $row_office['type'];
						}
						$month_query = mysqli_query($connect, "select * from emonth where emonth_id = $month");
						$month_row = mysqli_fetch_array($month_query);
						echo '<tr  class="record">
<td >' . $i . '</td>
<td >' . $office_name . '</td>
<td >' . $office_location . '</td>
<td >' . $senior_staff . '</td>
<td >' . $junior_staff . '</td>
<td >' . $non_staff . '</td>
<td >' . $total_staff . '</td>
<td >' . $staff_dis . '</td>
<td >' . $month_row[1] . '</td>
<td >' . $year . '</td>
<td >' . $auto_date . '</td>
<td ><a href="each_staff_info.php?id=' . $rep_id . '">Edit</a></td>
<td ><a href="#" id=' . $rep_id . ' class="staffdelbutton">Delete</a></td>
</tr>';
					}
					//<td bgcolor="'.$bg_color.'"><a href="#" id='.$rep_id.' class="delbutton">Delete</a></td>
					?>
				</table>
			</div>
		</div>


	</div><!-- close content -->

<?= require_once("../includes/footer.php");