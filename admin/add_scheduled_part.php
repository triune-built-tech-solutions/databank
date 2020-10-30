<?php
session_start();
require_once("../includes/header.php");
if (isset($_GET['id'])) {
	$user = $_GET['id'];
	$sqlUp = "SELECT * FROM scheduled_training WHERE id='$user'";
	$res = mysqli_query($GLOBALS["___mysqli_ston"], $sqlUp);
	$fetch = mysqli_fetch_assoc($res);
	$id = $fetch['id'];
	$offtyp = $fetch['office_type'];
	$offloc = $fetch['office_location'];
	$mon = $fetch['month'];
	$yer = $fetch['year'];
	$prog = $fetch['prog_title'];
}

$_SESSION['offtyp'] = $offtyp;
$_SESSION['offloc'] = $offloc;
$_SESSION['mon'] = $mon;
$_SESSION['yer'] = $yer;
$_SESSION['prog'] = $prog;
$_SESSION['id'] = $id;

if (!empty($_GET['status'])) {
	switch ($_GET['status']) {
		case 'succ':
			$statusMsgClass = 'alert-success';
			$statusMsg = 'Participants list has been inserted successfully.';
			break;
		case 'err':
			$statusMsgClass = 'alert-danger';
			$statusMsg = 'Some problem occurred, please try again.';
			break;
		case 'invalid_file':
			$statusMsgClass = 'alert-danger';
			$statusMsg = 'Please upload a valid CSV file.';
			break;
		default:
			$statusMsgClass = '';
			$statusMsg = '';
	}
}
?>

	<div id="content"><!-- open content -->
	<style type="text/css">
		#scheduled input {
			padding: 3px;
			color: #949494;
			font-family: Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			border: 1px solid #cecece;
		}

		#scheduled input.none {
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 20px;
			width: 150px;
			height: 30px;
			background: #6f9ff1;
			color: #fff;
			font-weight: 700;
			font-style: normal;
			border: 0;
			cursor: pointer;
		}

		#scheduled input.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#scheduled select.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#scheduled p {
			margin-bottom: 15px;
		}

		#scheduled p span {
			margin-left: 10px;
			color: #b1b1b1;
			font-size: 11px;
			font-style: italic;
		}

		#scheduled p span.error {
			color: #e46c6e;
		}

		#scheduled #send {

		}

		#scheduled #send:hover {
			background: #79a7f1;
		}

		#error {
			margin-bottom: 20px;
			border: 1px solid #efefef;
		}
	</style>
	<style type="text/css">
		.panel-heading a {
			float: right;
		}

		.panel-heading2 a {
			float: left;
		}

		#importFrm {
			margin-bottom: 20px;
			display: none;
		}

		#importFrm input[type=file] {
			display: inline;
		}
	</style>
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
		<?php
		require_once("side_link.php");
		?>
	</div>
	<div class="card shadow">
		<div class="card-header">
			<h4>Participant's Details</h4>
		</div>
		<div class="card-body">
			<?php
			$stateSql1 = "SELECT * FROM emonth WHERE emonth_id='$mon'";
			$stateResult1 = mysqli_query($GLOBALS["___mysqli_ston"], $stateSql1);
			$stateFetch1 = mysqli_fetch_assoc($stateResult1);
			$shwmon = $stateFetch1['emonth'];
			$shwmonid = $stateFetch1['emonth_id'];
			?>

			<div class="panel-heading">
				<a class="btn btn-dark" href="down.php?m=1">Download Excel Template</a>
			</div>
			<div class="panel-heading">
				<a class="btn btn-default" href="javascript:void(0);" onclick="$('#importFrm').slideToggle();">Import Participant's List</a>&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
			<?php if (!empty($statusMsg)) {
				echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
			} ?>
			<div class="panel-body">
				<form action="importData2.php" method="post" enctype="multipart/form-data" id="importFrm">
					<input type="file" name="file"/>
					<input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
				</form>
				<div id="exec">
					<form method="post" action="process_scheduled_part.php" name="scheduled" id="scheduled">
						<input type="hidden" value="<?php echo $id; ?>" name="ids"/>
						<div class="form-inline form-group">
							<label for="">Office Type :</label>
							<select class="form-control ml-3" name="off_type">
								<option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option>
							</select>
						</div>
						<br/>

						<div class="form-group form-inline">
							<label for="">Office Location :</label>
							<select class="form-control ml-3" name="off_loc">
								<option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option>
							</select>
						</div>
						<br/>
						<div class="form-inline form-group">
							<label for="">Month :</label>
							<select class="form-control ml-3" name="rep_month" id="rep_month">
								<option value=" <?php echo $shwmonid; ?> ">
								<?php echo $shwmon; ?></option>
							</select>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Year :</label>
							<select class="form-control ml-3" name="rep_year" id="rep_year">
								<option value=" <?php echo $yer; ?>"/>
								<?php echo $yer; ?></option>

							</select>
						</div>
						<br/>
						<div class="form-inline form-group">
							<label for="">Programme title: </label>
							<input class="form-control ml-3" type="text" size="25" name="prog" id="prog" value=" <?php echo $prog; ?>" readonly="readonly"/>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Name of Organization:</label>
							<input class="form-control ml-3" type="text" size="25" name="organization" id="organization"/>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Sector :</label>
							<input class="form-control ml-3" type="text" size="25" name="sector" id="sector"/>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Name of Participant:</label>
							<input class="form-control ml-3" type="text" size="25" name="participants" id="participants"/>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Gender :</label>
							<select class="form-control ml-3" id="gender" name="gender">
								<option value=" ">--Gender--</option>
								<?php
								$result_gender = mysqli_query($GLOBALS["___mysqli_ston"], "select * from gender order by gender_name");
								while ($row_gender = mysqli_fetch_array($result_gender)) {
									echo "<option value='" . $row_gender[1] . "'>" . $row_gender[1] . "</option>";
								}

								?>
							</select>
						</div>
						<br/>

						<div class="form-inline form-group">E-mail :
							<input class="only" type="text" size="25" name="email" id="email"/>
						</div>
						<br/>

						<div class="form-inline form-group" align="left">Address :
							<input class="form-control ml-3" type="text" size="25" name="address" id="address"/>
						</div>
						<br/>

						<div class="form-inline form-group">Phone Number : &nbsp;&nbsp;
							<input class="form-control ml-3" type="text" size="25" name="phone" id="phone"/>
						</div>
						<br/>

						<div class="form-inline form-group">Qualification : &nbsp;&nbsp;

							<select class="form-control ml-3" id="qual" name="qual">
								<option value=" ">--Qualification--</option>
								<option value="none"> None</option>
								<option value="primary"> Primary</option>
								<option value="secondary"> Secondary</option>
								<option value="OND"> OND</option>
								<option value="HND"> HND</option>
								<option value="NCE"> NCE</option>
								<option value="BSc"> BSc</option>
								<option value="PGD"> PGD</option>
								<option value="MSc"> MSc</option>
								<option value="PhD"> PhD</option>
								<option value="Professional"> Professional Qualification</option>
							</select>
						</div>
						<br/>

						<div class="form-inline form-group">
							<label for="">Designation :</label>
							<input class="form-control ml-3" type="text" size="25" name="designation" id="designation"/>
						</div>
						<br/>
						<div>
							<button class="btn btn-primary" type="submit" id="send" value="Submit" name="submit">Submit</button>
						</div>
						<br/>
					</form>
				</div>
			</div>
		</div>
	</div><!-- close content -->
	<div id="divi">
		<script>
            $('dd').filter('dd:nth-child(n+2)').hide();

            $('dt').click(function () {
                $(this).next().siblings('dd').hide();
                $(this).next().show();
            });
            //$('.subject').click(removeClass('li.page'));

		</script>
	</div>
	<br/>
<?php require_once("../includes/footer.php"); ?>