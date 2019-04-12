<?php
require_once("header.php");

if (isset($_GET['id'])) {
	$acct_id = $_GET['id'];
}
?>
<style>
	.notVisible {
		visibility: hidden;
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
	<div id="data_show">
		<form name="add_use" method="post" action="acct_man_save.php" id="add_user">
			<fieldset>
				<legend>
					<fieldset><span style="color:#F00"><h3>Edit Your personal Info...</h3></span></fieldset>
				</legend>
				<?php

				$query_acct = "SELECT * from staff_reg where id = $acct_id";
				$result_acct = mysqli_query($connect, $query_acct);

				$row_acct = mysqli_fetch_array($result_acct);

				?>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Staff N<u>o</u></span> : <input
							type="text" id="staff_no" size="35" name="staff_no"
							value="<?php echo $row_acct[1]; ?>"/><span id="staffInfo">What is your staff No.</span>
				</div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Title</span> : <select name="title"
				                                                                                           id="title">
						<option value=" ">--Title--</option>

						<?php
						$result_title = mysqli_query($connect, "select * from title");
						while ($row_title_name = mysqli_fetch_array($result_title)) {
							echo "<option value='" . $row_title_name[0] . "'>" . $row_title_name[1] . "</option>";
						}
						?>
					</select></div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Firstname</span> : <input
							type="text" name="first_name" id="first_name" size="35"
							value="<?php echo $row_acct[3]; ?>"/></div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Middlename</span> : <input
							type="text" name="middle_name" id="middle_name" size="35"
							value="<?php echo $row_acct[4]; ?>"/></div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Surname</span> : <input type="text"
				                                                                                            name="last_name"
				                                                                                            id="last_name"
				                                                                                            size="35"
				                                                                                            value="<?php echo $row_acct[5]; ?>"/>
				</div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Gender</span> : <select
							name="gender" id="gender">
						<option value=" ">--Gender--</option>
						<?php
						$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender");
						while ($row_gender = mysqli_fetch_array($result_gender)) {
							echo "<option value='" . $row_gender[0] . "'>" . $row_gender[1] . "</option>";
						}

						?>
					</select></div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Office Type</span> :
					<select name="office_type" id="office_t">
						<option value=" ">--Office type--</option>
						<?php
						$result_office_type = mysqli_query($GLOBALS["___mysqli_ston"], "select * from office_type");
						while ($row_office_type = mysqli_fetch_array($result_office_type)) {
							echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
						}

						?>
					</select></div>

				<div id="opti" class="notVisible">
					<span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Dept/Unit</span> :
					<select name="opti" id="optio">
						<option value=" ">-Select-</option>
						<option value="1">Department</option>
						<option value="2">Unit</option>
					</select>
				</div>

				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>office Location</span> :
					<select name="office_location" id="office_loc">

					</select><br/></div>
				<div>
<span id="d_op"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Department</span> : <select
			name="department" id="dept"><option value=" ">--Department--</option>
		<?php
		$result_dept = mysqli_query($GLOBALS["___mysqli_ston"], "select * from department where status = 1");
		while ($row_dept = mysqli_fetch_array($result_dept)) {
			echo "<option value='" . $row_dept[0] . "'>" . $row_dept[1] . "</option>";
		}
		?>
</select></span>&nbsp;&nbsp;
					<span id="un" class="notVisible"><span
								style='color:#1e69c7; font-size:13px; font-weight:bold;'>Unit</span> : <select id="unit"
					                                                                                           name="unt"><option
									value=" ">--Unit--</option>
							<?php

							$result_unit = mysqli_query($GLOBALS["___mysqli_ston"], "select * from unit");
							while ($row_unit = mysqli_fetch_array($result_unit)) {
								echo "<option value='" . $row_unit[0] . "'>" . $row_unit[1] . "</option>";
							}
							?>
</select></span>
				</div>
				<div><span id="di_op"><span
								style='color:#1e69c7; font-size:13px; font-weight:bold;'>Division</span> : <select
								name="division" id="div">

</select></span>&nbsp;&nbsp;
					<span id="s_un" class="notVisible"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Sub-unit</span> : <select
								name="subUnit" id="sub_unit">

</select></span>
				</div>
				<div id="s_op"><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Section</span> : <select
							name="section" id="sect">

					</select></div>
				<div><span style='color:#1e69c7; font-size:13px; font-weight:bold;'>Username</span> : <input type="text"
				                                                                                             size="35"
				                                                                                             name="username"
				                                                                                             value="<?php echo $row_acct[13]; ?>"/><span
							id="unameInfo">Remember your username, you will need it to log in! </span></div>
				<div align="center"><input type="submit" name="user_edit" id="send" value="Save Changes"/></div>
			</fieldset>
		</form>
	</div>
</div><!-- close content -->
<div id="divi">

</div><br/>
<div align="center" id="style1"><span style="color:#F00">&copy;</span> &#176 <?php echo date('Y'); ?> &nbsp; &nbsp;<span
			style="color:#03C">Industrial Training Fund.</span> All Rights Reserved.
</div>
<script type="text/javascript" src="old_assets/ajax.js"></script>
<script type="text/javascript" src="old_assets/validatemanage.js"></script>
</body>
</head>
</html>