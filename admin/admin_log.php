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
	<div id="itf_prog" class="row">
		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Department</p>
				</div>
				<form class="card-body" name="add_dept" action="" method="post" id="add_dept">
					<div class="form-group">
						<label for="">Department Name :</label>
						<input class="form-control" type="text" name="dept" id="depart"/>&nbsp
					</div>
					<button class="btn-primary btn" type="submit" id="subm" value="Add" name="add_dept">Submit</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Edit Department Name</p>
				</div>
				<form class="card-body" name="edit_dept" action="edit_adminlog.php" method="post" id="edit_dept">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="dept_edit" id="dep_edit">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="dept_titl">New Department</label>
						<input type="text" class="form-control" name="dept_titl" id="dept_titl"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="edit" value="Edit" name="edit_department">Edit</button>
					<button class="btn btn-outline-danger" type="submit" id="del_department" value="Delete" name="del_department">Delete</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Division</p>
				</div>
				<form class="card-body" name="add_div" action="" method="post" id="add_div">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="dep">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Division Name</label>
						<input class="form-control" type="text" name="div" id="divis"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="divs" value="Add" name="add_div">Add</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Edit Division</p>
				</div>
				<form class="card-body" name="edit_div" action="edit_adminlog.php" method="post" id="add_sect">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department1" id="dept1">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Division</label>
						<select class="form-control" name="division1" id="div1">

						</select>
					</div>
					<div class="form-group">
						<label for="">New Division</label>
						<input class="form-control" type="text" name="div_edit" id="div_edit"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="edit_div" value="Edit" name="edit_division">Edit</button>
					<button class="btn btn-outline-danger" type="submit" id="del_div" value="Delete" name="del_division">Delete</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Section</p>
				</div>
				<form class="card-body" name="add_sect" action="" method="post" id="add_sect">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="dept">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Division</label>
						<select class="form-control" name="division" id="div">

						</select>
					</div>
					<div class="form-group">
						<label for="">Section</label>
						<input class="form-control" type="text" name="sect" id="sect" size="50"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="sec" value="Add" name="add_sect">Add</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Edit Section</p>
				</div>
				<form class="card-body" name="edit_sect" action="edit_adminlog.php" method="post" id="edit_sect">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="dept2">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select></div>
					<div class="form-group">
						<label for="">Division</label>
						<select class="form-control" name="division" id="div2">

						</select>
					</div>
					<div class="form-group">
						<label for="">Section</label>
						<select class="form-control" name="sect" id="sect2">

						</select>
					</div>&nbsp;
					<div class="form-group">
						<label for="">New Section</label>
						<input class="form-control" type="text" name="sec_edit" id="sec_edit" size="50"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="edit_div" value="Edit" name="edit_section">Edit</button>
					<button class="btn btn-outline-danger" type="submit" id="del_div" value="Delete" name="del_section">Delete</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Unit</p>
				</div>
				<form class="card-body" action="" method="post" id="add_unit">
					<div class="form-group">
						<label for="">Unit Name</label>
						<input class="form-control" type="text" name="unit" id="uni" size="50"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="units" value="Add" name="add_unit">Add</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Sub-Unit</p>
				</div>
				<form class="card-body" action="" method="post" id="add_SubUnit">
					<div class="form-group">
						<label for=""> Unit</label>
						<select class="form-control" id="ut" name="unt">
							<option>--Unit--</option>
							<?php

							$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
							while ($row_unit = mysqli_fetch_array($result_unit)) {
								echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
							}
							?>
						</select>
					</div>&nbsp;&nbsp;
					<div class="form-group">
						<label for="">Sub-Unit</label>
						<input class="form-control" type="text" name="subUnit" id="subUnit" size="50"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" id="subUnits" value="Add" name="add_subUnit">Add</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Suspend Department</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_dept">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="dept">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<button class="btn btn-danger" type="submit" id="suspend" value="Suspend" name="sus_dept">Suspend</button>
					<a class="btn btn-outline-primary" href="release.php">Restore</a></p>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Suspend Division</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_div">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="depts">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Division</label>
						<select class="form-control" name="division" id="divd">

						</select>
					</div>
					<button class="btn btn-danger" type="submit" value="Suspend" name="sus_div">Suspend</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Suspend Section</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_sec">
					<div class="form-group">
						<label for="">Department</label>
						<select class="form-control" name="department" id="depm">
							<option value=" ">--Department--</option>
							<?php
							$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
							while ($row_dept = mysqli_fetch_array($result_dept)) {
								echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Division</label>
						<select class="form-control" name="division" id="divn">

						</select></div>
					<div class="form-group">
						<label for="">Section</label>
						<select class="form-control" name="section" id="secti">

						</select>
					</div>
					<button class="btn btn-danger" type="submit" value="Suspend" name="sus_sec">Suspend</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Suspend Unit</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_dept">
					<div class="form-group">
						<label for="">Unit</label>
						<select class="form-control" name="unit" id="ut">
							<option value=" ">--Unit--</option>
							<?php

							$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
							while ($row_unit = mysqli_fetch_array($result_unit)) {
								echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
							}
							?>
						</select>
					</div>
					<button class="btn btn-danger" type="submit" id="suspend" value="Suspend" name="sus_unit">Suspend</button>
				</form>
			</div>
		</div>


		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Suspend Sub-Unit</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_div">
					<div class="form-group">
						<label for="">unit</label>
						<select class="form-control" name="unit" id="unit">
							<option value=" ">--Unit--</option>
							<?php

							$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit where status = 1");
							while ($row_unit = mysqli_fetch_array($result_unit)) {
								echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Sub-Unit</label>
						<select class="form-control" name="sub_unit" id="sub_unit">

						</select>
					</div>
					<button class="btn btn-danger" type="submit" value="Suspend" name="sus_sub">Suspend</button>
				</form>
			</div>
		</div>


		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Add Office</p>
				</div>
				<form class="card-body" action="" method="post" id="sus_div">
					<div class="form-group">
						<label for="">Office Type :<br/></label>
						<select class="form-control" name="off_type" id="off_ty">
							<option value=" ">--Office Type--</option>
							<?php
							$result_ty = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
							while ($row_ty = mysqli_fetch_array($result_ty)) {
								echo "<option value='" . $row_ty[0] . "'>" . $row_ty[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Office Location</label>
						<input class="form-control" type="text" name="locate" id="locat" size="30"/>
					</div>
					<button class="btn btn-primary" type="submit" value="Add" name="add_off">Add</button>
				</form>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<p class="h4">Edit Office</p>
				</div>
				<form class="card-body" action="edit_adminlog.php" method="post" id="edit_off">
					<div class="form-group">
						<label for="">Office Type</label>
						<select class="form-control" name="off_type" id="office_t">
							<option value=" ">--Office Type--</option>
							<?php
							$result_ty = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
							while ($row_ty = mysqli_fetch_array($result_ty)) {
								echo "<option value='" . $row_ty[0] . "'>" . $row_ty[1] . "</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label for="">Office Location</label>
						<select class="form-control" name="office_location" id="office_loc">

						</select>
					</div>
					<div class="form-group">
						<label for="">New Location</label>
						<input class="form-control" type="text" name="loc_edit" id="loc_edit" size="50"/>&nbsp;&nbsp;
					</div>
					<button class="btn btn-primary" type="submit" value="edit" name="edit_off">Submit</button>
				</form>
			</div>
		</div>

	</div><!-- close itf_prog -->
</div><!-- close content -->
<?php
if (isset($_POST['add_dept']) && !empty($_POST['dept'])) {
	$dept = $_POST['dept'];

	$query = "INSERT INTO department VALUES (null, '$dept', 1)";

	mysqli_query($connect, $query) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['add_div']) && !empty($_POST['div'])) {
	$dept = $_POST['department'];
	$div = $_POST['div'];

	$que = "INSERT INTO division VALUES (null, $dept, '$div', 1)";

	mysqli_query($connect, $que) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['add_sect']) && !empty($_POST['sect'])) {
	$dept = $_POST['department'];
	$div = $_POST['division'];
	$sect = $_POST['sect'];

	$quer = "INSERT INTO section VALUES (null, $div, '$sect', 1)";

	mysqli_query($connect, $quer) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['add_unit']) && !empty($_POST['unit'])) {
	$unit = $_POST['unit'];

	$qury = "INSERT INTO unit VALUES (null, '$unit', 1)";

	mysqli_query($connect, $qury) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['add_subUnit']) && !empty($_POST['subUnit'])) {
	$unit = $_POST['unt'];
	$sub = $_POST['subUnit'];

	$qur = "INSERT INTO sub_unit VALUES (null, $unit, '$sub', 1)";

	mysqli_query($connect, $qur) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['sus_dept']) && !empty($_POST['department'])) {
	$dept = $_POST['department'];

	$sus_q = "update department SET status = 0 where id = $dept";

	mysqli_query($connect, $sus_q) or
	die("Error updating department " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['sus_div']) && !empty($_POST['department']) && !empty($_POST['division'])) {
	$dept = $_POST['department'];
	$div = $_POST['division'];

	$sus_qd = "update division SET status = 0 where id = $div";

	mysqli_query($connect, $sus_qd) or
	die("Error updating division " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['sus_sec']) && !empty($_POST['division']) && !empty($_POST['section'])) {
	$sect = $_POST['section'];
	$div = $_POST['division'];

	$sus_qs = "update section SET status = 0 where id = $sect";

	mysqli_query($connect, $sus_qd) or
	die("Error updating section " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['sus_unit']) && !empty($_POST['unit'])) {
	$unt = $_POST['unit'];

	$sus_qun = "update unit SET status = 0 where id = $unt";

	mysqli_query($connect, $sus_qun) or
	die("Error updating department " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['sus_sub']) && !empty($_POST['unit']) && !empty($_POST['sub_unit'])) {
	$unit = $_POST['unit'];
	$subU = $_POST['sub_unit'];

	$sus_qd = "update sub_unit SET status = 0 where id = $subU";

	mysqli_query($connect, $sus_qd) or
	die("Error updating division " . mysqli_error($GLOBALS["___mysqli_ston"]));

}

if (isset($_POST['add_off']) && !empty($_POST['locate'])) {
	$typ = $_POST['off_type'];
	$loc = $_POST['locate'];
	$auto_date = time();
	$show_date = date("d/m/Y H:i", $auto_date);

	$loca = "INSERT INTO area_office VALUES (null, $typ, '$loc', '$show_date')";

	mysqli_query($connect, $loca) or
	die("error inserting to database " . mysqli_error($GLOBALS["___mysqli_ston"]));

}
?>
<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
