<?php require_once("../includes/header.php"); ?>
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
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<div align="center" class="form-group form-inline d-flex justify-content-center">
			<label>Username: &nbsp;</label>
			<input class="form-control ml-3 mr-3" type="text" name="usern" size="30"/>
			<button class="btn btn-primary mr-3" type="submit" name="lim" value="search">Search</button>
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>">Show All</a>
		</div>
	</form>

	<div class="card shadow">
		<div class="card-header">
			<h4>Reset User Account Password</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">

				<thead>
					<tr>
						<th>id</th>
						<th>staff N<u>o</u></th>
						<th>Name</th>
						<th>Gender</th>
						<th>Office Type</th>
						<th>Office Location</th>
						<th>Username</th>
						<th>Department</th>
						<th>Added by</th>
						<th>Date added</th>
						<th>Edit</th>
					</tr>
				</thead>

				<?php
				if (isset($_POST['lim'])) {
					$lim = $_POST['usern'];
				}

				if (isset($lim)) {
					$query_staff_info = "select * from staff_reg where username ='" . $lim . "' order by first_name";
				} else {
					$query_staff_info = "select * from staff_reg order by first_name limit 60";
				}

				$result_staff_info = mysqli_query($connect, $query_staff_info);


				for ($i = 0; $i < mysqli_num_rows($result_staff_info); $i++) {
					$id = mysqli_result($result_staff_info, $i, "id");
					$staff_no = mysqli_result($result_staff_info, $i, "staff_no");
					$title_id = mysqli_result($result_staff_info, $i, "title_id");
					$first_name = mysqli_result($result_staff_info, $i, "first_name");
					$middle_name = mysqli_result($result_staff_info, $i, "middle_name");
					$last_name = mysqli_result($result_staff_info, $i, "last_name");
					$gender = mysqli_result($result_staff_info, $i, "gender_id");
					$office_type = mysqli_result($result_staff_info, $i, "office_type");
					$office_loc = mysqli_result($result_staff_info, $i, "office_location");
					$username = mysqli_result($result_staff_info, $i, "username");
					$department = mysqli_result($result_staff_info, $i, "department");
					$unit = mysqli_result($result_staff_info, $i, "unit");
					$added_by = mysqli_result($result_staff_info, $i, "added_by");
					$date_added = mysqli_result($result_staff_info, $i, "date_added");

					if ($i % 2) {
						$bg_color = "#a8c2f7";
					} else {
						$bg_color = "#f0f9f0";
					}

					$query_title = "SELECT * FROM title where title_id = $title_id";
					$result_title = mysqli_query($connect, $query_title);

					while ($row_title = mysqli_fetch_array($result_title)) {
						$title = $row_title[1];
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
					$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type where id = $office_type");
					while ($row_office_type = mysqli_fetch_array($result_office_type)) {
						$office_type_row = $row_office_type[1];
					}
					$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_loc";
					$result_office = mysqli_query($connect, $query_office);

					while ($row_office = mysqli_fetch_array($result_office)) {
						$office_loc = $row_office['2'];
					}
					$result_off_location = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender where gender_id = $gender");
					while ($row_off_location = mysqli_fetch_array($result_off_location)) {
						$gender = $row_off_location[1];
					}
					echo '<tr>
<td >' . $id . '</td>
<td >' . $staff_no . '</td>
<td >' . $title . ' ' . $first_name . ' ' . $middle_name . ' ' . $last_name . '</td>
<td >' . $gender . '</td>
<td >' . $office_type_row . '</td>
<td >' . $office_loc . '</td>
<td >' . $username . '</td>
<td >' . $department . '</td>
<td >' . $added_by . '</td>
<td >' . $date_added . '</td>
<td > <a href="reset_password.php?reset=' . $id . '">Reset</a></td>
</tr>';
				}

				?>
			</table>
		</div>
	</div>

</div><!-- close content -->
<div id="divi">

</div><br/>


<?php require_once("../includes/footer.php"); ?>
