<?php
require_once("../includes/header.php");
?>
	<style>
		p.sid a {
			font-size: 15px;
			padding: 10px;
			margin: 0;
			color: #F00;
			font-style: italic;
		}

		div#pag {
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
		<div>
			<a class=" btn btn-danger" href="../admin/view_meeting.php">View All Minutes</a>
		</div>
		<hr/>

		<div id="page" class="card shadow">
			<div class="card-header">
				<h4>Create Minute</h4>
			</div>
			<form class="card-body" method="post" action="add_meeting.php" enctype="multipart/form-data" id="meet">
				<div class="form-group form-inline">
					<label for="">Office Type :</label>
					<select class="form-control ml-3" name="off_type">
						<option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option>
					</select>
				</div>

				<div class="form-inline form-group">
					<label for="">Office Location :</label> &nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control" id="off_lo" name="off_loc">
						<option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option>
					</select></div>

				<div class="form-inline form-group">
					<label for="">Month :</label> &nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control" name="rep_month" id="rep_month">
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

				<div class="form-group form-inline">
					<label for="">Year :</label>&nbsp;&nbsp;&nbsp;&nbsp;
					<select class="form-control" name="rep_year" id="rep_year">
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
					<label for="">Meeting Title :</label>
					<input class="form-control" type="text" name="heading" id="heading"/>
				</div>
				<div class="form-group">
					<label for="">Minute Of Meeting :</label> &nbsp;&nbsp;
					<input class="form-control" type="file" name="m_file"/>
				</div><br/>
				<div class="col-md-12 d-flex justify-content-center">
					<button class="btn btn-success" type="submit" id="send" value="Submit" name="submit">Create</button>
				</div>
			</form>
		</div>
	</div><!-- close content -->

	<div id="divi">

	</div><br/>

<?php
require_once("../includes/footer.php");
?>