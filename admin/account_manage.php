<?php require_once("../includes/header.php");

if (isset($_GET['id'])) {
	$acct_id = $_GET['id'];
}
?>
	<style>
		.notVisible {
			visibility: hidden;
			display: none;
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
					echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> Unit:</span> " . $row_unit[1] . ".&nbsp;&nbsp;&nbsp;";
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
					echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> Sub-Unit:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
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
		<div id="page" class="card shadow">
			<div class="card-header">
				<h4>Edit personal Info</h4>
			</div>
			<form class="card-body" name="add_use" method="post" action="acct_man_save.php" id="add_user">
				<fieldset>
					<?php

						$query_acct = "SELECT * from staff_reg where id = $acct_id";
						$result_acct = mysqli_query($connect, $query_acct);

						$row_acct = mysqli_fetch_array($result_acct);

					?>
					<div class="input-group">
						Staff No:
						<input class="ml-3 form-control" type="text" id="staff_no" name="staff_no" value="<?php echo $row_acct[1]; ?>" placeholder="What is your staff No."/>
					</div>
					<div class="form-group form-inline mt-3">
						<label>Title: </label>
						<select class="ml-3 form-control" name="title" id="title">
							<option value=" ">--Title--</option>

							<?php
							$result_title = mysqli_query($connect, "select * from title");
							while ($row_title_name = mysqli_fetch_array($result_title)) {
								echo "<option value='" . $row_title_name[0] . "'>" . $row_title_name[1] . "</option>";
							}
							?>
						</select></div>
					<div class="input-group">
						First Name:
						<input class="ml-3 form-control" type="text" name="first_name" id="first_name" size="35" value="<?php echo $row_acct[3]; ?>"/>
					</div>
					<div class="input-group mt-3">
						Middle Name:
						<input class="ml-3 form-control" type="text" name="middle_name" id="middle_name" size="35" value="<?php echo $row_acct[4]; ?>"/>
					</div>
					<div class="input-group mt-3">
						Surname:
						<input class="ml-3 form-control" type="text" name="last_name" id="last_name" size="35" value="<?php echo $row_acct[5]; ?>"/>
					</div>
					<div class="form-group form-inline mt-3">
						<label>Gender: </label>
						<select class="ml-3 form-control"  name="gender" id="gender">
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
						<select class="ml-3 form-control" name="office_type" id="office_t">
							<option value=" ">--Office type--</option>
							<?php
							$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
							while ($row_office_type = mysqli_fetch_array($result_office_type)) {
								echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
							}

							?>
						</select>
					</div>

					<div id="opti" class="notVisible form-group form-inline">
						<label>Dept/Unit: </label>
						<select class="ml-3 form-control" name="opti" id="optio">
							<option value=" ">-Select-</option>
							<option value="1">Department</option>
							<option value="2">Unit</option>
						</select>
					</div>

					<div class="form-group form-inline">
						<label>Office Location: </label>
						<select class="ml-3 form-control" name="office_location" id="office_loc">

						</select>
					</div>
					<div>

						<div id="d_op" class="form-group form-inline">
							<label>Department: </label>
							<select class="ml-3 form-control" name="department" id="dept">
								<option value=" ">--Department--</option>
									<?php
									$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
									while ($row_dept = mysqli_fetch_array($result_dept)) {
										echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
									}
									?>
							</select>
						</div>&nbsp;&nbsp;
						<div id="un" class="notVisible form-group form-inline">
							<label>Unit: </label>
							<select class="ml-3 form-control" id="unit" name="unt">
								<option value=" ">--Unit--</option>
								<?php

								$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit");
								while ($row_unit = mysqli_fetch_array($result_unit)) {
									echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div>
						<div id="di_op" class="form-inline form-group">
							<label>Division: </label>
							<select class="ml-3 form-control" name="division" id="div">
							</select>
						</div>&nbsp;&nbsp;
						<div id="s_un" class="notVisible form-inline form-group">
							<label>Sub-unit:</label>
							<select class="ml-3 form-control" name="subUnit" id="sub_unit">
							</select>
						</div>
					</div>
					<div id="s_op" class="form-inline form-group">
						<label>Section</label> :
						<select class="ml-3 form-control" name="section" id="sect">

						</select>
					</div>
					<div class="input-group">
						Username:
						<input class="ml-3 form-control" type="text" size="35" name="username" value="<?php echo $row_acct[13]; ?>"/>
					</div>
					<span id="unameInfo" class="text-primary">Remember your username, you will need it to log in! </span>

					<div align="center" class="mt-5">
						<button class="btn btn-success" type="submit" name="user_edit" id="send" value="Save Changes">Save Changes</button>
					</div>
				</fieldset>
			</form>
		</div>
	</div><!-- close content -->
	<div id="divi">

	</div><br/>

<?php require_once("../includes/footer.php"); ?>