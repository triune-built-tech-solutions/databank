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
	<div align="center">
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="report_query">

			<select name="month">
				<option value=" ">-Month-</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select> &nbsp;&nbsp;&nbsp;

			<select name="year">
				<option value=" ">-Year-</option>
				<?php
				$query_eyear = "Select * from eyear";
				$result_eyear = mysqli_query($connect, $query_eyear);

				while ($row_eyear = mysqli_fetch_array($result_eyear)) {
					echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;

			<select name="office_type" id="office_t">
				<option value=" ">-Office_Type-</option>
				<?php
				$query_office_type = "Select * from office_type";
				$result_office_type = mysqli_query($connect, $query_office_type);

				while ($row_office_type = mysqli_fetch_array($result_office_type)) {
					echo "<option value='" . $row_office_type[0] . "'>" . $row_office_type[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;

			<select name="office_loc" id="office_loc">
				<option value=" "></option>
			</select>&nbsp;&nbsp;&nbsp;
			<button type="submit" name="begin_query" class="btn btn-success">Begin Query</button>
		</form>
		<br/>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="period_query">
			Periodic Query : <select name="month_f" id="month_f">
				<option value=" ">--From--</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select> &nbsp;&nbsp;||&nbsp;&nbsp;
			<select name="month_t" id="month_t">
				<option value=" ">--To--</option>
				<?php
				$query_emonth = "Select * from emonth";
				$result_emonth = mysqli_query($connect, $query_emonth);

				while ($row_emonth = mysqli_fetch_array($result_emonth)) {
					echo "<option value='" . $row_emonth[0] . "'>" . $row_emonth[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="p_year">
				<option value=" ">-Year-</option>
				<?php
				$query_eyear = "Select * from eyear";
				$result_eyear = mysqli_query($connect, $query_eyear);

				while ($row_eyear = mysqli_fetch_array($result_eyear)) {
					echo "<option value='" . $row_eyear[1] . "'>" . $row_eyear[1] . "</option>";
				}
				?>
			</select>&nbsp;&nbsp;
			<button type="submit" name="begin_period" class="btn btn-dark">Query</button>
		</form>
	</div>
	<br/>
	<div class="card shadow">
		<div class="card-header">
			<h4>ITF Utility Vehicles</h4>
		</div>
		<div class="card-body">
			<table class="table table-bordered table-hover table-responsive" id="dataTable" width="100%" cellspacing="0">
				<thead>
				<tr>
					<td colspan="12" align="left"><a href="add_vehicle.php" class="btn btn-danger"> Add Vehicle </a></td>
				</tr>

				<tr>
					<th>S/N</th>
					<th>Make of Vehicle</th>
					<th>Colour</th>
					<th>Chassis No</th>
					<th>Engine No</th>
					<th>Registration No</th>
					<th>Date Purchase</th>
					<th>Amount</th>
					<th>Location</th>
					<th>Uses</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
				</thead>

				<?php
				$s = "select * from vehicles";
				$q = mysqli_query($GLOBALS["___mysqli_ston"], $s);
				if (!$q) {
					print mysqli_error($GLOBALS["___mysqli_ston"]);
					exit;
				}

				while ($r = mysqli_fetch_array($q)) {
					?>
					<tr class="record">
						<td><?php print $r['sn']; ?>
						</td>

						<td><?php print $r['make']; ?>
						</td>

						<td><?php print $r['colour']; ?>
						</td>

						<td><?php print $r['chassis']; ?>
						</td>

						<td><?php print $r['engine_no']; ?>
						</td>

						<td><?php print $r['registration']; ?>
						</td>

						<td><?php print $r['date_purchase']; ?>
						</td>

						<td><?php print number_format($r['price'], 2); ?>
						</td>

						<td><?php print $r['location']; ?>
						</td>

						<td><?php print $r['use_u']; ?>
						</td>

						<td><a href="each_vehicle.php?id=<?php print $r['sn']; ?>">Edit</a></td>
						<td><a href="#" id="<?php print $r['sn']; ?>" class="vehdelbutton">Delete</a></td>

					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>

</div><!-- close content -->
<div id="divi">

</div><br/>

<script type="text/javascript">
    $(function() {

        $(".vehdelbutton").click(function(){

//Save the link in a variable called element
            var element = $(this);

//Find the id of the link that was clicked
            var del_id = element.attr("id");

//Built a url to send
            var info = 'id=' + del_id;
            if(confirm("Sure you want to delete this record? There is NO undo!"))
            {

                $.ajax({
                    type: "GET",
                    url: "delete_untility.php",
                    data: info,
                    success: function(){

                    }
                });
                $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                    .animate({ opacity: "hide" }, "slow");

            }

            return false;

        });

    });
</script>

<?php  require_once("../includes/footer.php"); ?>
