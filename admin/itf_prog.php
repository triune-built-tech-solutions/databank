<?php require_once("../includes/header.php"); ?>
<style>
	.lef {
		float: left;
	}

	.notVisible {
		visibility: hidden;
	}

	#add_prog input.dis {
		padding: 3px;
		color: #949494;
		font-family: Arial, Verdana, Helvetica, sans-serif;
		font-size: 13px;
		border: 1px solid #cecece;
	}

	#add_prog input.none {
		background: #9FF;
		color: #666;
		font-family: Tahoma, Geneva, sans-serif;
		font-size: 15px;
	}

	#add_prog input.error {
		background: #f8dbdb;
		border-color: #e77776;
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
	<div id="itf_prog" class="row">
		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow ">
				<div class="card-header">
					<h4>Copy Program</h4>
				</div>
				<div class="card-body">
					<form name="copy_prog" action="merge_prog.php" method="post" id="copy_prog">
						<p class="input-group">
							<label class="mr-3" for="">From:</label>
							<select class="form-control" name="year_copy" id="year_copy">
								<option>-Year-</option>
								<?php
								$query_eyear = "Select * from eyear";
								$result_eyear = mysqli_query($connect, $query_eyear);

								while ($row_eyear = mysqli_fetch_array($result_eyear)) {
									echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
								}
								?>
							</select></p>
						<p class="input-group">
							<label class="mr-3" for="">To:</label>
							<select class="form-control" name="year_copy1" id="year_copy1">
								<option>-Year-</option>
								<?php
								$query_eyear = "Select * from eyear";
								$result_eyear = mysqli_query($connect, $query_eyear);

								while ($row_eyear = mysqli_fetch_array($result_eyear)) {
									echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
								}
								?>
							</select></p>

						<button class="btn btn-primary" type="submit" id="migrate" value="migrate" name="migrate_prog">Migrate Programme</button>

					</form>
				</div>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<h4>Add Program</h4>
				</div>
				<div class="card-body">
					<fieldset>
						<form name="add_prog" action="add_prog.php" method="post" id="add_prog">
							<p class="input-group">
								<label for="" class="mr-3">Year: </label>
								<select class="form-control" name="year" id="year">
									<option>-Year-</option>
									<?php
									$query_eyear = "Select * from eyear";
									$result_eyear = mysqli_query($connect, $query_eyear);

									while ($row_eyear = mysqli_fetch_array($result_eyear)) {
										echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
									}
									?>
								</select></p>
							<p class="lef input-group">
								<label class="mr-3">Prog No: </label>
								<select class="form-control" name="prog_no" id="prog_n">

								</select></p>
							<p class="input-group">
								Prog. Tittle:
								<input type="text" class="form-control" name="prog_titl" id="prog_titl"/>&nbsp;&nbsp;
							</p>
							<div class="input-group">
								<button class="btn btn-primary mr-3 w-25" type="submit" id="subm" disabled="disabled" value="Add" name="add_prog">Add</button>
								<button class="btn btn-outline-primary w-25" type="submit" id="edit" disabled="disabled" value="Edit" name="edit_prog">Edit</button>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<h4>Add Sub Program</h4>
				</div>
				<div class="card-body">
					<fieldset>
						<form name="add_sub_prog" action="add_sub_prog.php" method="post" id="add_sub_prog">
							<p class="input-group">
								<label for="" class="mr-3">Year: </label>
								<select class="form-control" name="syear" id="syear">
									<option>-Year-</option>
									<?php
									$query_eyear = "Select * from eyear";
									$result_eyear = mysqli_query($connect, $query_eyear);

									while ($row_eyear = mysqli_fetch_array($result_eyear)) {
										echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
									}
									?>
								</select></p>
							<p class="input-group">
								<label for="" class="mr-3">Prog No: </label>
								<select class="form-control" name="sprog_n" id="prog_no">
								</select></p>
							<p class="input-group">
								<label class="mr-3" for="">Sub Prog No: </label>
								<select class="form-control" name="sub_prog_no" id="sub_prog">

								</select>&nbsp;&nbsp;&nbsp;</p>
							<p class="lef input-group">
								Sub Prog. Tittle:
								<input class="form-control" type="text" name="sub_prog_title" id="sub_prog_titl"/>&nbsp;&nbsp;
							</p>
							<div class="input-group">
								<button class="btn btn-primary w-25 mr-3" type="submit" id="subm_sub" disabled="disabled" value="Add" name="add_sub">Add</button>
								<button class="btn btn-outline-primary w-25" type="submit" id="edit_sub" disabled="disabled" value="Edit" name="edit_sub">Edit</button>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>

		<div class="col-md-6 mt-3 mb-3">
			<div class="card shadow">
				<div class="card-header">
					<h4>Add Objective</h4>
				</div>
				<div class="card-body">
					<fieldset>
						<form name="obj_add" action="add-obj.php" method="post" id="obj_add">
							<p class="input-group">
								<label for="" class="mr-3">Year: </label>
								<select class="form-control" name="oyear" id="oyear">
									<option>-Year-</option>
									<?php
									$query_eyear = "Select * from eyear";
									$result_eyear = mysqli_query($connect, $query_eyear);

									while ($row_eyear = mysqli_fetch_array($result_eyear)) {
										echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
									}
									?>
								</select></p>
							<p class="input-group">
								<label for="" class="mr-3">Prog No: </label>
								<select class="form-control" name="oprog_n" id="oprog_no">
								</select></p>
							<p class="input-group">
								<label for="" class="mr-3">Sub Prog No: </label>
								<select class="form-control" name="sub_oprog_no" id="sub_oprog_no">

								</select></p>
							<p class="input-group">
								<label for="" class="mr-3">Objective No: </label>
								<select class="form-control" name="obj_ono" id="obj_ono">

								</select></p>

							<p class="input-group">
								Objective Tittle:
								<input type="text" class="form-control" name="obj_title" id="obj_t"/>
							</p>
							<div class="input-group">
								<button class="btn btn-primary mr-3 w-25" type="submit" id="subm_obj" disabled="disabled" value="Add" name="adding_obj">Add</button>
								<button class="btn btn-outline-primary w-25" type="submit" id="edit_obj" disabled="disabled" value="Edit" name="edit_obj">Edit</button>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>

		<div class="col-md-6 mt-3-mb-3">
			<div class="card shadow">
				<div class="card-header">
					<h4>Add Home News</h4>
				</div>
				<div class="card-body">
					<fieldset>
						<form method="post" action="add_home.php" id="add_homeP">
							<p>
								<label for="">Heading </label>
								<input class="form-control m-0" type="text" name="headings" id="heading"/>
							</p>
							<p>
								<label for="">Text</label>
								<textarea class="form-control" name="homeP" id="homeP" cols="100" rows="5"> </textarea>
							</p>
							<button class="btn btn-primary" type="submit" name="submit" value="Submit" id="homePage">Publish News</button>
						</form>
					</fieldset>
				</div>
			</div>
		</div>

	</div>
</div><!-- close content -->
<div id="divi">

</div><br/>

<?php require_once("../includes/footer.php"); ?>
