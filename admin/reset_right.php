<?php
require_once("../includes/header.php");
require_once("../includes/connections.php");

if (isset($_GET['reset'])) {
	$pass_id = $_GET['reset'];
}
?>
	<style type="text/css">
		fieldset {
			width: 400px;
			margin: 20px auto;
			padding: 20px;
		}

		p.blue {
			color: #00F;
			font-weight: bold;
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
		<div class="card shadow">
			<?php
			if (isset($pass_id)) {
				$get_user = "SELECT * FROM staff_reg where id = " . $pass_id;

				$get_result = mysqli_query($connect, $get_user) or
				die("Error Connecting to Server" . mysqli_error($GLOBALS["___mysqli_ston"]));

				while ($usernam = mysqli_fetch_assoc($get_result)) {
					$name = $usernam['username'];
				}
			}
			?>
			<div class="card-header">
				<h4>Reset Password</h4>
			</div>
			<form class="card-body" action="reset.php" method="post" name="f2">
				<div>
					<div class="form-group form-inline">
						<label for="">Username :</label>
						<input class="ml-3 form-control" type="text" value="<?php echo $name; ?>" name="na"/>
					</div>
					<div class="form-group form-inline">
						<label for="">Access Right :</label>&nbsp;&nbsp;
						<select class="form-control ml-3" name="access_right" id="access_right">
							<option value=" ">--Access right--</option>
							<?php
							$result_access = mysqli_query($GLOBALS["___mysqli_ston"], "select * from assess_right");
							while ($row_access = mysqli_fetch_array($result_access)) {
								echo "<option value='" . $row_access[0] . "'>" . $row_access[1] . "</option>";
							}

							?>
						</select>
					</div>
					<button class="btn btn-primary mr-3" type="submit" name="resetIt" value="Replace">Update</button>
					<a href="home.php">Cancel</a>
				</div>

			</form>
		</div>
	</div><!-- close content -->
	<div id="divi">

	</div><br/>

<?php require_once("../includes/footer.php") ?>