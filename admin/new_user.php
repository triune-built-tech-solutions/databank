<?php require_once("../includes/header.php"); ?>
<style>
	.notVisible {
		visibility: hidden;
		display: none;
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
	<div id="data_show" class="card shadow">
		<div class="card-header">
			<h4>Add new user</h4>
		</div>
		<form class="card-body form" method="post" action="add_user.php" name="add_user" id="add_user">
			<fieldset>
				<div class="form-group form-inline">
					<label for="staff_no">Staff No:</label>
					<input class="form-control ml-3" size="35" type="text" name="staff_no" id="staff_no"
					       placeholder="What's your staff number?"/>
				</div>
				<p class="form-group form-inline">
					<label>Title: </label>
					<select class="form-control ml-3" name="title" id="title">
						<option value=" ">--Title--</option>

						<?php
						$result_title = mysqli_query($connect, "select * from title");
						while ($row_title_name = mysqli_fetch_array($result_title)) {
							echo "<option value='" . $row_title_name[0] . "'>" . $row_title_name[1] . "</option>";
						}

						?>
					</select></p>
				<div class="form-group form-inline">
					<label for="" class="">First Name: </label>
					<input class="form-control ml-3" type="text" name="first_name" id="first_name" size="35"
					       placeholder="What's your first name?"/>
				</div>
				<div class="form-group form-inline">
					<label>Middle Name: </label>
					<input class="form-control ml-3" type="text" name="middle_name" id="middle_name" size="35"
					       placeholder="What's your middle name?"/>
				</div>
				<div class="form-group form-inline">
					<label>Surname: </label>
					<input class="form-control ml-3" type="text" name="last_name" id="last_name" size="35"
					       placeholder="What's your surname?"/>
				</div>

				<div class="form-group form-inline">
					<label>Gender: </label>
					<select class="form-control ml-3" id="gender" name="gender">
						<option value=" ">--Gender--</option>
						<?php
						$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender");
						while ($row_gender = mysqli_fetch_array($result_gender)) {
							echo "<option value='" . $row_gender[0] . "'>" . $row_gender[1] . "</option>";
						}

						?>
					</select></div>
				<div class="form-group form-inline">
					<label>Office Type: </label>
					<select class="form-control ml-3" name="office_type" id="office_t">
						<option value=" ">--Office type--</option>
						<?php
						$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
						while ($row_office_type = mysqli_fetch_array($result_office_type)) {
							echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
						}
						?>
					</select>
					<div id="opti" class="ml-3 mr-3 notVisible form-group form-inline">
						<label>Dept/Unit</label> :
						<select class="form-control ml-3"  name="opti" id="optio">
							<option value=" ">-Select-</option>
							<option value="1">Department</option>
							<option value="2">Unit</option>
						</select>
					</div>
				</div>
				<!---->
				<div class="form-group form-inline">
					<label>Office Location: </label>
					<select class="form-control ml-3" name="office_location" id="office_loc">

					</select>
				</div>
				<div class="form-group form-inline">
					<span id="d_op" class="form-group form-inline"><label class="">Department: </label>
						<select class="form-control ml-3" name="department" id="dept"><option
									value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</span>&nbsp;&nbsp;
				</div>

				<div>
					<div id="un" class="notVisible form-group form-inline">
						<label >Unit</label> :
						<select class="form-control ml-3" id="unit" name="unit"><option value=" ">--Unit--</option>
							<?php

							$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
							while ($row_unit = mysqli_fetch_array($result_unit)) {
								echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div id="s_un" class="notVisible form-group form-inline">
						<label>Sub-unit: </label>
						<select class="form-control ml-3"  name="sub_unit" id="sub_unit">

						</select>
					</div>

				<div class="form-group form-inline">
					<span id="di_op" class="form-group form-inline">
						<label>Division: </label>
						<select class="form-control ml-3" name="division" id="div">
							<option value=" "> </option>

						</select>
					</span>&nbsp;&nbsp;
				</div>
				</div>
				<div id="s_op" class="form-inline form-group">
					<label>Section</label> :
					<select class="form-control ml-3" name="section" id="sect">
						<option value=" "></option>

					</select>
				</div>
				<div class="form-inline form-group">
					<label>Username</label> :
					<input class="form-control ml-3 mr-3" type="text" size="35" id="username" name="username" placeholder=""/>
					<span id="unameInfo">Remember your username, you will need it to log in! </span>
				</div>
				<div class="form-inline form-group">
					<label>Password: </label>
					<input class="form-control ml-3 mr-3" type="password" size="35" id="pass1" name="password"/>
					<span id="pass1Info">At least 5 characters: letters, numbers and '_'</span>
				</div>
				<div class="form-inline form-group">
					<label>Confirm Password</label>
					<input class="form-control ml-3 mr-3" type="password" size="35" id="pass2" name="conpassword"/>
					<span id="pass2Info">Confirm password</span>
				</div>

				<div class="form-inline form-group">
					<label>Access Right: </label>
					<select class="form-control ml-3" name="access_right" id="access_right">
						<option value=" ">--Access right--</option>
						<?php
						$result_access = mysqli_query($GLOBALS["___mysqli_ston"], "select * from assess_right order by right_id");
						while ($row_access = mysqli_fetch_array($result_access)) {
							echo "<option value='" . $row_access[0] . "'>" . $row_access[1] . "</option>";
						}

						?>
					</select></div>
				<div align="center">
					<button class="btn btn-success" id="send" type="submit" value="Add user" name="submit_user">Add User</button>
				</div>
			</fieldset>
		</form>
	</div>
</div><!-- close content -->
<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
