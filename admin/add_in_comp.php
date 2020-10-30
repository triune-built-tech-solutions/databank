<?php
require_once("../includes/header.php");

if (isset($_GET['id']))
	$taker = $_GET['id'];

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
				background: #9FF;
				color: #666;
				font-family: Tahoma, Geneva, sans-serif;
				font-size: 15px;
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
				background: #6f9ff1;
				color: #fff;
				font-weight: 700;
				font-style: normal;
				border: 0;
				cursor: pointer;
			}

			#scheduled #send:hover {
				background: #79a7f1;
			}

			#error {
				margin-bottom: 20px;
				border: 1px solid #efefef;
			}

			.not_visible {
				display: none;
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
				<h4>In-Company Safety Organization Details </h4>
			</div>
			<div id="exec" class="card-body ml-5">
				<form method="post" action="process_incomp_org.php" name="scheduled" id="scheduled">
					<p class="form-inline form-group">Office Type : <select class="form-control ml-3" name="off_type">
							<option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option>
						</select></p>
					<br/>
					<p class="form-inline form-group">Office Location : <select class="form-control ml-3"
								name="off_loc">
							<option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option>
						</select></p>
					<br/>
					<p class="form-inline form-group">Month : <select class="form-control ml-3"
								name="rep_month" id="rep_month">
							<option value=" ">-Month-</option>
							<?php
							$query_emonth = "Select * from emonth";
							$result_emonth = mysqli_query($connect, $query_emonth);

							while ($row_emonth = mysqli_fetch_array($result_emonth)) {
								echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
							}
							?>
						</select></p>
					<br/>
					<p class="form-inline form-group">Year :  <select class="form-control ml-3" name="rep_year" id="rep_year">
							<option value=" ">-Year-</option>
							<?php


							$query_eyear = "Select * from eyear";
							$result_eyear = mysqli_query($connect, $query_eyear);

							while ($row_eyear = mysqli_fetch_array($result_eyear)) {
								echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
							}
							?>
						</select></p>
					<br/>
					<p class="form-inline form-group">Name of Company:
						<input class="form-control ml-3" type="text" size="25" name="company" id="company"/>
					</p>
					<br/>
					<p class="form-inline form-group">Address :
						<input class="form-control ml-3" type="text" size="25" name="address" id="address"/>
					</p>
					<br/>
					<p class="form-inline form-group">Email :
						<input class="form-control ml-3" type="text" size="25" name="email" id="email"/>
					</p>
					<br/>
					<p class="form-inline form-group">Phone Number :
						<input class="form-control ml-3" type="text"
								size="25" name="phone" id="phone"/></p>
					<br/>
					<p class="form-inline form-group">Sector :
						<input class="form-control ml-3" type="text" size="25" name="sector" id="sector"/></p>
					<br/>
					<p>
						<button class="btn btn-primary" type="submit" id="send" value="Submit" name="submit">Submit</button>
					</p>
					<br/>
				</form>
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
	</div><br/>
<?php
require_once("../includes/footer.php");
?>