<?php require_once("../includes/header.php"); ?>
<form id="content"><!-- open content -->
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
	<div align="center">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query">

			<label>Name : </label><input type="text" name="surname" id="surname"/>&nbsp;
			<label>Staff No. : </label><input type="text" name="staff_no" id="staff_no"/>&nbsp;&nbsp;&nbsp;
			<select name="gender">
				<option value=" ">-Gender-</option>
				<option value="F"> Female</option>
				<option value="M"> Male</option>
			</select>&nbsp;&nbsp;&nbsp;

			<button class="btn btn-success" type="submit" name="begin_query" value="Begin Query">Begin Query</button>


		</form>
	</div>
	<br/>
	<div class="card shadow mb-5">
		<div class="card-header">
			<h4>Staff Information Reports</h4>
		</div>
		<form class="card-body" action="del_nominal.php" method="post" id="form_del">
			<table class="table table-bordered table-hover table-striped table-responsive-md" id="dataTable" width="100%" cellspacing="0">
				<tr>
					<th>
						<button class="btn btn-danger btn-sm" name="delete" value="Delete" type="submit" onClick="return confirm('User detail will be sent to archive?');">Delete</button>
					</th>
					<th>S/N</th>
					<th>Surname</th>
					<th>Other Names</th>
					<th>Staff No.</th>
					<th>Sex</th>
					<th></th>
					<th></th>
				</tr>
				<?php
				if (isset($_GET['err']) && $_GET['err'] == 'exist') {
					echo '<script>
			alert("Report for specified office and date already exist");
			</script>';
				}

				if (isset($_POST['begin_query'])) {
					$year = $_POST['surname'];
					$office_type = $_POST['staff_no'];
					$office_location = $_POST['gender'];

					if ($year !== "") {
						$opt = "where surname like '" . $year . "%' or other_name like '%" . $year . "%' ";
					}
					if ($office_type !== "" && !isset($opt)) {
						$opt = "where staff_no = " . $office_type;
					} else if ($office_type !== "" && isset($opt)) {
						$opt .= " and staff_no = " . $office_type;
					}
					if ($office_location !== " " && !isset($opt)) {
						$opt = "where sex = '" . $office_location . "'";
					} else if ($office_location !== " " && isset($opt)) {
						$opt .= " and sex = '" . $office_location . "'";
					}
				}

				if (isset($opt)) {
					$query_report_view = "select * from nominal $opt order by surname limit 80";
				} else {
					$query_report_view = "select * from nominal order by surname limit 80";
				}

				$result_report_view = mysqli_query($connect, $query_report_view);

				for ($i = 0; $i < mysqli_num_rows($result_report_view); $i++) {
					$rep_id = mysqli_result($result_report_view, $i, "id");
					$surname = mysqli_result($result_report_view, $i, "surname");
					$other_name = mysqli_result($result_report_view, $i, "other_name");
					$staff_no = mysqli_result($result_report_view, $i, "staff_no");
					$sex = mysqli_result($result_report_view, $i, "sex");
					$job_title = mysqli_result($result_report_view, $i, "job_title");
					$date_appt = mysqli_result($result_report_view, $i, "date_appt");
					$dob = mysqli_result($result_report_view, $i, "dob");
					$state = mysqli_result($result_report_view, $i, "state");
					$added_date = mysqli_result($result_report_view, $i, "added_date");
					$added_by = mysqli_result($result_report_view, $i, "added_by");


					if ($i % 2) {
						$bg_color = "#a8c2f7";
					} else {
						$bg_color = "#f0f9f0";
					}

					$ij = $i + 1;

					echo '<tr>
	<td><input name="del[]" type="checkbox" value="' . $rep_id . '" /></td>
	<td><a href="edit_nominal.php?repId=' . $rep_id . '">' . $ij . '</a></td>
	<td>' . $surname . '</td>
	<td>' . $other_name . '</td>
	<td>' . $staff_no . '</td>
	<td>' . $sex . '</td>
	<td> <a href="add_staff_prog.php?repId=' . $rep_id . '">Add</a></td>
	<td> <a href="each_staff_prog.php?repId=' . $rep_id . '">View</a></td>
	</tr>';

				}

				?>
			</table>
		</form>

</div><!-- close content -->
<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
