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
	<div>
		<?= require_once ("side_link.php"); ?>
	</div>
	<div class="card shadow">
		<div class="card-header">
			<h4>Scheduled Training Programmes</h4>
		</div>
		<div class="card-body">
			<table class="table table-hover table-responsive">
				<thead>
				<tr>
					<th>#</th>
					<th>Office Type</th>
					<th>Office Location</th>
					<th>Training</th>
					<th>Implemented</th>
					<th>participants</th>
					<th>Organization</th>
					<th>month</th>
					<th>Year</th>
					<th>Date added</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>

				<?php
				if ($access_right == 4) {
					$query_report_view = "select * from scheduled_training order by year desc, month desc limit 80";
				} else {
					$query_report_view = "select * from scheduled_training where added_by = '" . $_SESSION['user_name'] . "' order by year desc, month desc limit 80";
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
					$training = mysqli_result($result_report_view, $i, "training");
					$implemented = mysqli_result($result_report_view, $i, "implemented");
					$participants = mysqli_result($result_report_view, $i, "participants");
					$organization = mysqli_result($result_report_view, $i, "organizations");

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
<td >' . $training . '</td>
<td >' . $implemented . '</td>
<td >' . $participants . '</td>
<td >' . $organization . '</td>
<td >' . $month_row[1] . '</td>
<td >' . $year . '</td>
<td >' . $auto_date . '</td>
<td ><a href="each_scheduled_training.php?id=' . $rep_id . '">Edit</a></td>
<td ><a href="#" id=' . $rep_id . ' class="delbutton">Delete</a></td>
</tr>';
				}

				?>
			</table>
		</div>
	</div>

</div><!-- close content -->
<div id="divi">

	<script type="text/javascript">
        $(function () {


            $(".delbutton").click(function () {

//Save the link in a variable called element
                var element = $(this);

//Find the id of the link that was clicked
                var del_id = element.attr("id");

//Built a url to send
                var info = 'id=' + del_id;
                if (confirm("Sure you want to delete this record? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "delete_scheduled.php",
                        data: info,
                        success: function () {

                        }
                    });
                    $(this).parents(".record").animate({backgroundColor: "#fbc7c7"}, "fast")
                        .animate({opacity: "hide"}, "slow");

                }

                return false;

            });

        });
	</script>

</div>

<?php require_once("../includes/footer.php"); ?>
