<?php require_once("../includes/header.php");

if (isset($_GET['id']))
	$taker = $_GET['id'];
$user_name = $_SESSION['user_name'];
$added_by1 = $user_name;
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
		<?= require_once ("side_link.php")?>
	</div>
	<div class="card shadow">
		<div class="card-header">
			<h4>Scheduled Training Participant</h4>
		</div>
		<div class="card-body">
			<table class="table-hover table table-responsive">
				<thead>
				<tr>
					<th>#</th>
					<th>Office Type</th>
					<th>Office Location</th>
					<th>Prog. Title</th>
					<th>Participant</th>
					<th>Organization</th>
					<th>Gender</th>
					<th>Email</th>
					<th>Address</th>
					<th>Phone No.</th>
					<th>Qualification</th>
					<th>Designation</th>
					<th>Added by</th>
					<th>Month</th>
					<th>Year</th>
					<th>Date Added</th>
					<th>View</th>
					<th>Delete</th>
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

				if (empty($opt)) {
					$opt = " ";
				}

				$query_report_view = "select * from scheduled_training where id = '" . $taker . "' order by year desc, month desc limit 80";

				$result_report_view = mysqli_query($connect, $query_report_view);

				for ($i = 0; $i < mysqli_num_rows($result_report_view); $i++) {
					$rep_id = mysqli_result($result_report_view, $i, "id");
					$office_type = mysqli_result($result_report_view, $i, "office_type");
					$office_location = mysqli_result($result_report_view, $i, "office_location");
					$prog_title = mysqli_result($result_report_view, $i, "prog_title");
					$month = mysqli_result($result_report_view, $i, "month");
					$year = mysqli_result($result_report_view, $i, "year");
					$auto_date = mysqli_result($result_report_view, $i, "auto_date");
					$added_by = mysqli_result($result_report_view, $i, "added_by");
					$training = mysqli_result($result_report_view, $i, "training");
					$implemented = mysqli_result($result_report_view, $i, "implemented");
					$participants = mysqli_result($result_report_view, $i, "participants");
					$organization = mysqli_result($result_report_view, $i, "organizations");
				}
				//echo "$added_by1";
				$query_part = "select * from scheduled_part where added_by = '$added_by1' order by name limit 80";

				$result_part = mysqli_query($connect, $query_part);

				for ($i = 0; $i < mysqli_num_rows($result_part); $i++) {
					$rep_id = mysqli_result($result_part, $i, "id");
					$office_type = mysqli_result($result_part, $i, "office_type");
					$office_location = mysqli_result($result_part, $i, "office_loc");
					$prog_title = mysqli_result($result_part, $i, "prog_title");
					$month = mysqli_result($result_part, $i, "month");
					$year = mysqli_result($result_part, $i, "year");
					$name = mysqli_result($result_part, $i, "name");
					$org = mysqli_result($result_part, $i, "org");
					$sex = mysqli_result($result_part, $i, "gender");
					$email = mysqli_result($result_part, $i, "email");
					$address = mysqli_result($result_part, $i, "address");
					$phone = mysqli_result($result_part, $i, "phone");
					$qualification = mysqli_result($result_part, $i, "qualification");
					$designation = mysqli_result($result_part, $i, "designation");
					$auto_date = mysqli_result($result_part, $i, "added_date");
					$added_by = mysqli_result($result_part, $i, "added_by");


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

					echo '<tr  class="record">
<td >' . $ih . '</td>
<td >' . $office_name . '</td>
<td >' . $office_location . '</td>
<td >' . $prog_title . '</td>
<td >' . $name . '</td>
<td >' . $org . '</td>
<td >' . $sex . '</td>
<td >' . $email . '</td>
<td >' . $address . '</td>
<td >' . $phone . '</td>
<td >' . $qualification . '</td>
<td >' . $designation . '</td>
<td >' . $added_by . '</td>
<td >' . $month_row[1] . '</td>
<td >' . $year . '</td>
<td >' . $auto_date . '</td>
<td ><a href="each_part.php?repId=' . $rep_id . '">View</a></td>
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
                        url: "delete_part.php",
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

</div><br/>

<?php require_once("../includes/footer.php"); ?>