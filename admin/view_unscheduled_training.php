<?php
require_once("../includes/header.php");
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
	<div class="none">
		<?php require_once  ("side_link.php")?>
	</div>
	<div>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query" class="d-flex justify-content-center form-inline form-group">

			<select class="form-control ml-3" name="month">
				<option value=" ">-Month-</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select> &nbsp;&nbsp;&nbsp;

			<select class="form-control ml-3" name="year">
				<option value=" ">-Year-</option>
				<?php
				$query_eyear = "Select * from eyear";
				$result_eyear = mysqli_query($connect, $query_eyear);

				while ($row_eyear = mysqli_fetch_array($result_eyear)) {
					echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;

			<select class="form-control ml-3" name="office_type" id="office_t">
				<option value=" ">-office_type-</option>
				<?php
				$query_office_type = "Select * from office_type";
				$result_office_type = mysqli_query($connect, $query_office_type);

				while ($row_office_type = mysqli_fetch_array($result_office_type)) {
					echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;

			<select class="form-control ml-3" name="office_loc" id="office_loc">
				<option value=" "></option>
			</select>&nbsp;&nbsp;&nbsp;
			<button class="btn btn-success ml-3" type="submit" name="begin_query" value="Begin Query">Begin Query</button>
		</form>
		<br/>

		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="period_query" class="d-flex justify-content-center form-inline form-group">
			<label for="">Periodic Query : </label>
			<select class="form-control ml-3" name="month_f" id="month_f">
				<option value=" ">--From--</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select>
			<label for="" class="ml-3">||</label>
			<select class="form-control ml-3" name="month_t" id="month_t">
				<option value=" ">--To--</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			<select class="form-control ml-3" name="p_year">
				<option value=" ">-Year-</option>
				<?php
				$query_eyear = "Select * from eyear";
				$result_eyear = mysqli_query($connect, $query_eyear);

				while ($row_eyear = mysqli_fetch_array($result_eyear)) {
					echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;
			<button class="btn btn-primary ml-3" type="submit" name="begin_period" value="Query">Query</button>
		</form>
	</div>
	<br/>
	<div class="card shadow">
		<div class="card-header">
			<h4>Unscheduled Training Programmes</h4>
		</div>
		<div class="card-body">
			<table class="table-responsive table table-hover">
				<thead>
				<tr>
					<th>#</th>
					<th>Office Type</th>
					<th>Office Location</th>
					<th>Prog. Title</th>
					<th>Target</th>
					<th>Implemented</th>
					<th>Participants</th>
					<th>Organizations</th>
					<th>Revenue</th>
					<th>Duration</th>
					<th>Added by</th>
					<th>Month</th>
					<th>Year</th>
					<th>Date Added</th>
				</tr>
				</thead>

				<?php
				if (isset($_GET['err']) && $_GET['err'] == 'exist') {
					echo '<script>
			alert("Report for specified office and date already exist");
		</script>';
				}

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

				if (isset($_POST['begin_period'])) {
					$month_f = $_POST['month_f'];
					$month_t = $_POST['month_t'];
					$p_year = $_POST['p_year'];

					if ($month_f !== " " && $month_t !== " " && $p_year !== " ") {
						$opt = "where month between " . $month_f . " and " . $month_t . " and year = " . $p_year . " ";
					} else if ($month_f !== " " && $month_t !== " ") {
						$opt = "where month between " . $month_f . " and " . $month_t . " ";
					}

					if ($p_year !== " " && isset($opt)) {
						$opt .= "and year = '" . $p_year . "'";
					}
				}

				if (empty($opt)) {
					$opt = " ";
				}

				if ($access_right == 4) {
					$query_report_view = "select * from unscheduled_training $opt order by year desc, month desc limit 80";
				} else if ($access_right == 3 || $access_right == 1) {
					$query_report_view = "select * from unscheduled_training where office_location = '" . $office_location . "' order by year desc, month desc limit 80";
				} else {
					$query_report_view = "select * from unscheduled_training where added_by = '" . $_SESSION['user_name'] . "' order by year desc, month desc limit 80";
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
					$training = mysqli_result($result_report_view, $i, "target");
					$implemented = mysqli_result($result_report_view, $i, "implemented");
					$participants = mysqli_result($result_report_view, $i, "participants");
					$organization = mysqli_result($result_report_view, $i, "organizations");
					$prog_title = mysqli_result($result_report_view, $i, "prog_title");
					$duration = mysqli_result($result_report_view, $i, "duration");
					$rev_f_c = mysqli_result($result_report_view, $i, "revenue_f_c");

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

					$ih = $i + 1;

					echo '<tr>
<td >' . $i . '</td>
<td >' . $office_name . '</td>
<td >' . $office_location . '</td>
<td >' . $prog_title . '</td>
<td >' . $training . '</td>
<td >' . $implemented . '</td>
<td ><a href="add_unscheduled_part.php?id=' . $rep_id . '">' . $participants . '</a></td>
<td >' . $organization . '</td>
<td >' . $rev_f_c . '</td>
<td >' . $duration . '</td>
<td >' . $added_by . '</td>
<td >' . $month_row[1] . '</td>
<td >' . $year . '</td>
<td >' . $auto_date . '</td>
<td ><a href="add_unscheduled_part.php?id=' . $rep_id . '">Add Participant</a></td>

</tr>';

					$over_total = mysqli_query($connect, "select sum(target), sum(implemented),  sum(participants), sum(organizations), sum(revenue_f_c) from unscheduled_training $opt");
					$result_sum = mysqli_fetch_array($over_total);
				}

				echo
					'<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td >' . $result_sum[0] . '</td>
<td >' . $result_sum[1] . '</td>
<td >' . $result_sum[2] . '</td>
<td >' . $result_sum[3] . '</td>
<td >' . $result_sum[4] . '</td>
</tr>';

				?>
			</table>
		</div>
	</div>

</div><!-- close content -->
<div id="divi">

</div><br/>

<?php
require_once("../includes/footer.php");
?>