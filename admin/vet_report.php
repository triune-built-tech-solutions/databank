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
		<div id="query_opt" class="table-responsive card shadow mb-5">
			<div class="card-header">
				<h4>Query Report</h4>
			</div>
			<div class="card-body">
				<form class="row" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="col-md-6">
						<div class="form-group form-inline">
							<label for="">Month : &nbsp;</label> &nbsp;
							<select class="form-control ml-3" name="month">
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
						<div class="form-inline form-group">
							<label for="">Year :</label>
							<select class="form-control ml-3" name="year">
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
						<div class="form-group form-inline">
							<label for="">Report Type : </label>
							<select class="form-control ml-3" id="rep_type" name="rep_type">
								<option value=" ">-Report Type-</option>
								<?php
								$query_report_type = "Select * from report_type";
								$result_report_type = mysqli_query($connect, $query_report_type);

								while ($row_report_type = mysqli_fetch_array($result_report_type)) {
									echo "<option value='" . $row_report_type[1] . "'>" . $row_report_type[1] . "</option>";
								}

								?>
							</select>
						</div>

						<div class="form-group form-inline">
							<label for="">Office Type :</label> &nbsp;&nbsp;
							<select class="form-control ml-3" name="office_type">
								<option> <?php echo $office_name ?></option>

							</select>
						</div>
						<div class="form-group form-inline">
							<label>Office Location :</label>
							<select class="form-control ml-3" name="office_loc">
								<option><?php echo $office_loc ?></option>

							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Activities :</label>
							<textarea class="form-control" name="activities"></textarea>
						</div>
						<div class="form-group">
							<label for="">Achievements :</label>
							<textarea class="form-control" name="archievements"></textarea>

						</div>
						<div class="form-group">
							<label for="">Constraint :</label>
							<textarea class="form-control" name="constraint"></textarea>
						</div>
					</div>

					<div class="mt-5 col-md-12 form-group form-inline d-flex justify-content-center">
						<button class="btn btn-success" type="submit" name="begin_query" value="Begin Query">Begin Query</button>
					</div>

				</form>

			</div>

		</div>
		<div id="show_rep" class="card shadow">
			<?php
			if (isset($_POST['begin_query'])) {
				$month = $_POST['month'];
				$year = $_POST['year'];
				$rep_type = $_POST['rep_type'];
				$office_type = $_POST['office_type'];
				$office_location = $_POST['office_loc'];
				$activities = $_POST['activities'];
				$archievements = $_POST['archievements'];
				$constraint = $_POST['constraint'];

				if ($month !== " ") {
					$opt = " and month = " . $month;
				}
				if ($year !== " " && !isset($opt)) {
					$opt = " and year = '" . $year . "'";
				} else if ($year !== " " && isset($opt)) {
					$opt .= " and year = " . $year;
				}
				if ($rep_type !== " " && !isset($opt)) {
					$opt = " and report_type = '" . $rep_type . "'";
				} else if ($rep_type !== " " && isset($opt)) {
					$opt .= " and report_type = '" . $rep_type . "'";
				}

				if ($activities !== " " && !isset($opt)) {
					$opt = " and activities like '" . $activities . "%' ";
				} else if ($activities !== " " && isset($opt)) {
					$opt .= " and activities like '" . $activities . "%' ";
				}
				if ($archievements !== " " && !isset($opt)) {
					$opt = " and achievements like '" . $archievements . "%' ";
				} else if ($activities !== " " && isset($opt)) {
					$opt .= " and achievements like '" . $archievements . "%' ";
				}
				if ($constraint !== " " && !isset($opt)) {
					$opt = "and constraints like '" . $constraint . "%' ";
				} else if ($constraint !== " " && isset($opt)) {
					$opt .= " and constraints like '" . $constraint . "%' ";
				}
			}

			?>

			<div class="card-header">
				<h4>View all reports</h4>
			</div>

			<div class="card-body">
				<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">

					<tr>
						<th>S/N</th>
						<th>Office Type</th>
						<th>Office Location</th>
						<th>Department</th>
						<th>Prog. N<u>o</u></th>
						<th>Sub-Prog N<u>o</u></th>
						<th>Obj. N<u>o</u></th>
						<th>Month</th>
						<th>Year</th>
						<th>Added by</th>
					</tr>
					<?php
					$rowp = 40;
					$sql = "SELECT * FROM report_log";
					$result = mysqli_query($connect, $sql);
					$total_records = mysqli_num_rows($result);
					$pages = ceil($total_records / $rowp);
					((mysqli_free_result($result) || (is_object($result) && (get_class($result) == "mysqli_result"))) ? true : false);
					if (!isset($_GET['stat'])) {
						$stat = 1;
					} else {
						$stat = $_GET['stat'];
					}

					$stt = (($stat * $rowp) - $rowp);

					if (isset($opt)) {
						$query_report_view = "select * from report_log where added_by = '" . $_SESSION['user_name'] . "' " . $opt . " order by year desc, month desc, prog_no, sub_prog_no, obj_no limit $stt, $rowp";
					} else {
						$query_report_view = "select * from report_log where added_by = '" . $_SESSION['user_name'] . "' order by year desc, month desc, prog_no, sub_prog_no, obj_no limit $stt, $rowp";
					}

					$result_report_view = mysqli_query($connect, $query_report_view) or
					die ("Error Connecting to Server" . mysqli_error($GLOBALS["___mysqli_ston"]));
					$rest = mysqli_num_rows($result_report_view);

					$rws = count($rest);
					if ($rws == 0) {
						echo "No match was found in the database.";
					} else {

						for ($i = 0; $i < mysqli_num_rows($result_report_view); $i++) {
							$rep_id = mysqli_result($result_report_view, $i, "id");
							$office_type = mysqli_result($result_report_view, $i, "office_type");
							$office_location = mysqli_result($result_report_view, $i, "office_location");
							$prog_no = mysqli_result($result_report_view, $i, "prog_no");
							$sub_prog_no = mysqli_result($result_report_view, $i, "sub_prog_no");
							$obj_no = mysqli_result($result_report_view, $i, "obj_no");
							$rep_type = mysqli_result($result_report_view, $i, "report_type");
							$department = mysqli_result($result_report_view, $i, "department");
							$unit = mysqli_result($result_report_view, $i, "unit");
							$added_by = mysqli_result($result_report_view, $i, "added_by");
							$month = mysqli_result($result_report_view, $i, "month");
							$year = mysqli_result($result_report_view, $i, "year");
							$added_date = mysqli_result($result_report_view, $i, "auto_date");
							$io = $i + 1;

							$query_office = "SELECT * FROM area_office where office_type_id = $office_type and id = $office_location";
							$result_office = mysqli_query($connect, $query_office);

							while ($row_office = mysqli_fetch_array($result_office)) {
								$office_location = $row_office['2'];
							}

							if ($department == "") {
								$query_unit = "SELECT * FROM unit where id = $unit";
								$result_unit = mysqli_query($connect, $query_unit);

								while ($row_unit = mysqli_fetch_array($result_unit)) {
									$department = $row_unit[1];
								}
							} else {
								$query_dept = "SELECT * FROM department where id = $department";
								$result_dept = mysqli_query($connect, $query_dept);

								while ($row_dept = mysqli_fetch_array($result_dept)) {
									$department = $row_dept[1];
								}
							}

							$today = time();

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
							echo '<tr>
		<td >' . $io . '</td>
		<td >' . $office_name . '</td>
		<td >' . $office_location . '</td>
		<td >' . $department . '</td>
		<td >' . $prog_no . '</td>
		<td >' . $sub_prog_no . '</td>
		<td >' . $obj_no . '</td>
		<td >' . $month_row[1] . '</td>
		<td >' . $year . '</td>
		<td >' . $added_by . '</td>
		
		<td > <a href="edit_rep.php?repId=' . $rep_id . '">edit</a></td>
		</tr>';
						}
					}
					?>
				</table>
			</div>

			<div align="center" id="page_num">
				<?php
				$next = ($stat + 1);
				// let's create the dynamic links now
				if ($stat > 1) {
					$url = $_SERVER['PHP_SELF'] . "?stat=" . --$stat;
					echo "<a href=\"$url\">Previous</a>";
				}
				// page numbering links now
				for ($i = 1; $i <= $pages; $i++) {
					if ($i == 50)
						break;
					$url = $_SERVER['PHP_SELF'] . "?stat=" . $i;
					echo "  <a href=\"$url\">$i</a>  ";
				}
				if (isset($_GET['stat']) && $_GET['stat'] < $pages) {
					$url = $_SERVER['PHP_SELF'] . "?stat=$next";
					echo "<a href=\"$url\">Next</a>";
				}

				?>
			</div>
		</div>
	</div><!-- close content -->

<?php require_once("../includes/footer.php"); ?>