<?php
require_once("../includes/header.php");
?>
<div id="content"><!-- open content -->
	<style type="text/css">
		#peit input {
			padding: 3px;
			color: #949494;
			font-family: Arial, Verdana, Helvetica, sans-serif;
			font-size: 13px;
			border: 1px solid #cecece;
		}

		#peit input.none {
			background: #9FF;
			color: #666;
			font-family: Tahoma, Geneva, sans-serif;
			font-size: 15px;
		}

		#peit input.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#peit select.error {
			background: #f8dbdb;
			border-color: #e77776;
		}

		#peit p {
			margin-bottom: 15px;
		}

		#peit #send {
			background: #6f9ff1;
			color: #fff;
			font-weight: 700;
			font-style: normal;
			border: 0;
			cursor: pointer;
		}

		#peit #send:hover {
			background: #79a7f1;
		}

		#error {
			margin-bottom: 20px;
			border: 1px solid #efefef;
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
			<h4>New Training Package Report</h4>
		</div>
		<div id="exec" class="card-body">
			<form method="post" action="add_peit.php" name="peit" id="peit">
				<div class="form-group form-inline">
					<label for="">Office Type :</label>
					<select class="form-control ml-3" name="off_type">
						<option value="<?php echo $office_type; ?>"> <?php echo $office_name; ?></option>
					</select>
				</div>
				<br/>

				<div class="form-group form-inline">Office Location :
					<select class="form-control ml-3" name="off_loc">
						<option value="<?php echo $office_location; ?>"> <?php echo $office_loc; ?></option>
					</select></div>
				<br/>
				<p class="form-group form-inline">Month : 
					<select class="form-control ml-3" name="rep_month" id="rep_month">
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
				<p class="form-group form-inline">Year : 
					<select class="form-control ml-3" name="rep_year" id="rep_year">
						<option value=" ">-Year-</option>
						<?php
						$query_eyear = "Select * from eyear";
						$result_eyear = mysqli_query($connect, $query_eyear);

						while ($row_eyear = mysqli_fetch_array($result_eyear)) {
							echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
						}
						?>
					</select>
				</p>
				<br/>
				<p class="form-group form-inline">Target For The Year: <input class="form-control ml-3" type="text"
				                                                                   size="25" name="target"
				                                                                   id="target"/></p><br/>
				<p class="form-group form-inline">No. of Surveys carried out : <input class="form-control ml-3"
				                                                                           type="text" size="25"
				                                                                           name="surv_c_o"
				                                                                           id="surv_c_o"/></p>
				<br/>
				<p class="form-group form-inline">No. of Packages developed : <input class="form-control ml-3"
				                                                                          type="text" size="25"
				                                                                          name="packages_dev"
				                                                                          id="packages_dev"/>
				</p><br/>
				<p class="form-group form-inline">No. Implemented: <input class="form-control ml-3" type="text"
				                                                               size="25" name="implemented"
				                                                               id="implemented"/></p><br/>
				<p class="form-group form-inline">No. of Participants: <input class="form-control ml-3" type="text"
				                                                                   size="25" name="participants"
				                                                                   id="participants"/></p><br/>
				<p class="form-group form-inline">Amount Collected: <input class="form-control ml-3" type="text"
				                                                                size="25" name="participants"
				                                                                id="participants"/></p><br/>
				<p class="form-group form-inline">Amount Outstanding: <input class="form-control ml-3" type="text"
				                                                                  size="25" name="participants"
				                                                                  id="participants"/></p><br/>
				<div >
					<button class="btn btn-primary" type="submit" value="Submit" name="submit" id="send"> Submit</button>
				</div><br/>
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