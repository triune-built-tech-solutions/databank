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
		<div id="query_opt" class="table-responsive card shadow p-4 mb-5">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr>
						<th colspan="3"><h3>Query Report</h3></th>
					</tr>
					<tr>
						<td class="none" align="left">
							<input type="checkbox" name="" value=""/> Month : &nbsp;&nbsp;
							<select name="month">
								<option value=" ">-Month-</option>
								<?php
								$query_emonth = "Select * from emonth";
								$result_emonth = mysqli_query($connect, $query_emonth);

								while ($row_emonth = mysqli_fetch_array($result_emonth)) {
									echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
								}
								?>
							</select><br/>
							<input type="checkbox" name=""/> Year : &nbsp;&nbsp;
							<select name="year">
								<option value=" ">-Year-</option>
								<?php
								$query_eyear = "Select * from eyear";
								$result_eyear = mysqli_query($connect, $query_eyear);

								while ($row_eyear = mysqli_fetch_array($result_eyear)) {
									echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
								}
								?>
							</select><br/>
							<input type="checkbox" name=""/> Report Type : &nbsp;&nbsp;
							<select id="rep_type" name="rep_type">
								<option value=" ">-Report Type-</option>
								<?php
								$query_report_type = "Select * from report_type";
								$result_report_type = mysqli_query($connect, $query_report_type);

								while ($row_report_type = mysqli_fetch_array($result_report_type)) {
									echo "<option value='" . $row_report_type[1] . "'>" . $row_report_type[1] . "</option>";
								}

								?>
							</select><br/>
						</td>
						<td class="none"><input type="checkbox" name=""/> Office Type : &nbsp;&nbsp;
							<select name="office_type" id="office_t">
								<option value=" ">-Office_Type-</option>
								<?php
								$query_office_type = "Select * from office_type";
								$result_office_type = mysqli_query($connect, $query_office_type);

								while ($row_office_type = mysqli_fetch_array($result_office_type)) {
									echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
								}
								?>
							</select><br/>
							<input type="checkbox"/> Office Location : &nbsp;&nbsp;
							<select name="office_loc" id="office_loc">
								<option value=" "></option>
							</select><br/>
							<!-- input type="checkbox" name="" /> Department : &nbsp;&nbsp;
							<select name="department" id="dept"><option value=" ">--Department--</option>
							<!--?php
							$query_department = "Select * from department";
							$result_department = mysql_query($query_department, $connect);

							while($row_department = mysql_fetch_array($result_department)){
								echo "<option value='".$row_department[0]."'>". $row_department[1] . "</option>";
							}
							?>
							</select><br />
							<input type="checkbox" name="" value="" /> Division : &nbsp;&nbsp;
							<select name="division" id="div">
							<option value=" "> </option>

							</select><br />
							<input type="checkbox" name="" /> Section : &nbsp;&nbsp;
							<select name="section"><option value=" ">-Section-</option>
							<!-- ?php
							$query_section = "Select * from section";
							$result_section = mysql_query($query_section, $connect);

							while($row_section = mysql_fetch_array($result_section)){
								echo "<option value='".$row_section[0]."'>". $row_section[2] . "</option>";
							}
							?>
							</select -->
						</td>
						<td class="none"><input type="checkbox" name=""/> Activities : &nbsp;&nbsp;
							<textarea name="activities" rows="4" cols="15"></textarea>
							<br/>
							<input type="checkbox" name=""/> Achievements : &nbsp;&nbsp;
							<textarea name="archievements" rows="4" cols="15"></textarea>
							<br/>
							<input type="checkbox" name=""/> Constraint : &nbsp;&nbsp;
							<textarea name="constraint" rows="4" cols="15"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="3"><input type="submit" name="begin_query" value="Begin Query"/></td>
					</tr>
				</table>
			</form>
		</div>
		<div id="show_rep" class="card shadow p-4 mt-5">
			<?php
			if (isset($_POST['begin_query'])) {
				$month = $_POST['month'];
				$year = $_POST['year'];
				$rep_type = $_POST['rep_type'];
				$office_type = $_POST['office_type'];
				$office_location = $_POST['office_loc'];
				//$department = $_POST['department'];
				//$division = $_POST['division'];
				//$section = $_POST['section'];
				$activities = $_POST['activities'];
				$archievements = $_POST['archievements'];
				$constraint = $_POST['constraint'];

				if ($month !== " ") {
					$opt = "where month = " . $month;
				}
				if ($year !== " " && !isset($opt)) {
					$opt = "where year = '" . $year . "'";
				} else if ($year !== " " && isset($opt)) {
					$opt .= " and year = " . $year;
				}
				if ($rep_type !== " " && !isset($opt)) {
					$opt = "where report_type = '" . $rep_type . "'";
				} else if ($rep_type !== " " && isset($opt)) {
					$opt .= " and report_type = '" . $rep_type . "'";
				}

				if ($office_type !== " " && !isset($opt)) {
					$opt = "where office_type = " . $office_type;
				} else if ($office_type !== " " && isset($opt)) {
					$opt .= " and office_type = " . $office_type;
				}
				if ($office_location !== " ") {
					$opt .= " and office_location = " . $office_location;
				}
				/*
				if($department !== " " && !isset($opt)){
					$opt = " where department = ".$department;
				}
				if($division !== " "){
					$opt .= " and division = ".$division;
				}
				if($section !== " "){
					$opt .= " and section = ".$section;
				}
				*/
				if ($activities !== " " && !isset($opt)) {
					$opt = "where activities like '" . $activities . "%' ";
				} else if ($activities !== " " && isset($opt)) {
					$opt .= " and activities like '" . $activities . "%' ";
				}
				if ($archievements !== " " && !isset($opt)) {
					$opt = "where achievements like '" . $archievements . "%' ";
				} else if ($activities !== " " && isset($opt)) {
					$opt .= " and achievements like '" . $archievements . "%' ";
				}
				if ($constraint !== " " && !isset($opt)) {
					$opt = "where constraints like '" . $constraint . "%' ";
				} else if ($constraint !== " " && isset($opt)) {
					$opt .= " and constraints like '" . $constraint . "%' ";
				}
			}

			?>

			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<tr>
					<th colspan="9">View all reports</th>
				</tr>
				<tr>
					<th>S/N</th>
					<th>Office Type</th>
					<th>Office Location</th>
					<th>Department</th>
					<th>Month</th>
					<th>Year</th>
					<th>Added by</th>
				</tr>
				<?php
				if (isset($opt)) {
					$query_report_view = "select * from report_log GROUP BY month,id,year, office_location order by year desc, month desc, prog_no, sub_prog_no, obj_no limit 40";
				} else {
					$query_report_view = "select * from report_log GROUP BY month,id,year, office_location order by year desc, month desc, prog_no, sub_prog_no, obj_no limit 40";
				}

				$result_report_view = mysqli_query($connect, $query_report_view) or
				die ("Error Connecting to Server" . mysqli_error($GLOBALS["___mysqli_ston"]));
				$rest = mysqli_num_rows($result_report_view);

				$rws = count($rest);
				if ($rws == 0) {
					echo "<p>No match was found in the database.</p>";
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
		<td bgcolor="' . $bg_color . '">' . $io . '</td>
		<td bgcolor="' . $bg_color . '">' . $office_name . '</td>
		<td bgcolor="' . $bg_color . '">' . $office_location . '</td>
		<td bgcolor="' . $bg_color . '">' . $department . '</td>
		<td bgcolor="' . $bg_color . '">' . $month_row[1] . '</td>
		<td bgcolor="' . $bg_color . '">' . $year . '</td>
		<td bgcolor="' . $bg_color . '">' . $added_by . '</td>
		<td bgcolor="' . $bg_color . '"> <a href="each_rep.php?repId=' . $rep_id . '">view</a></td>
		</tr>';
					}
				}
				?>
			</table>
		</div>
	</div><!-- close content -->
	<div id="divi">

	</div><br/>

<?php require_once("../includes/footer.php"); ?>