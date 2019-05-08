<?php require_once("../includes/header.php"); ?>

<style>
	p.sid a {
		font-size: 15px;
		padding: 10px;
		margin: 0;
		color: #F00;
		font-style: italic;
	}

	div#pag {
		padding: 0 500px;
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
	<br>
	<div>
		<a class="btn btn-danger" href="view_nominal.php">View List Of All Staff</a>
	</div>
	<hr/>


	<div id="page" class="card shadow mb-5">
		<div class="card-header">
			<h4>Create Staff Record</h4>
		</div>
		<form class="card-body" method="post" action="process_nominal.php" enctype="multipart/form-data" id="meet">
			<p class="ex input-group" align="left">Surname : <input class="form-control" type="text" size="40" name="surname" id="surname"/>
			</p><br/>
			<p class="ex input-group" align="left">Other Names: <input class="form-control" type="text" size="40" name="other_name" id="other_name"/></p><br/>
			<p class="ex input-group" align="left">Staff Number : <input class="form-control" type="text" size="40" name="staff_no" id="staff_no"/></p><br/>
			<p class="ex" align="left">Sex : &nbsp;&nbsp;&nbsp;&nbsp;
				<select class="only" name="sex" id="sex">
					<option value=" ">-Gender-</option>
					<option value="F"> Female</option>
					<option value="M"> Male</option>
				</select>
			</p>
			<br/>
			<p class="ex input-group" align="left">Job Title : <input class="form-control" type="text" size="40" name="job_title" id="job_title"/></p><br/>
			<p class="ex input-group" align="left">Date of first Appt : <input class="form-control" type="text" size="40" name="doa" id="doa"/></p><br/>
			<p class="ex input-group" align="left">Date of Birth : <input class="form-control" type="text" size="40" name="dob" id="dob"/>
			</p><br/>
			<p align="left" class="ex">State of Origin : &nbsp;&nbsp;&nbsp;&nbsp;
				<select class="only" name="state" id="state">
					<option value=" ">-State-</option>
					<?php
					$query_emonth = "Select * from states";
					$result_emonth = mysqli_query($connect, $query_emonth);

					while ($row_emonth = mysqli_fetch_array($result_emonth)) {
						echo "<option value='" . $row_emonth[1] . "'>" . $row_emonth[1] . "</option>";
					}
					?>
				</select>
			</p>
			<br/>
			<p class="ex input-group" align="left">Upload Passport &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input class="form-control-file form-control" name="passport" type="file"/>
			<p align="center">
				<button class="btn btn-success" type="submit" id="send" value="Submit" name="submit">Submit</button>
			</p><br/>
		</form>
	</div>
	<p class="both"/>
</div><!-- close content -->

<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
