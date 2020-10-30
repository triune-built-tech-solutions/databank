<?php require_once ("../includes/header.php"); ?>

<div id="content"><!-- open content -->
	<div id="depart">
		<?php
		if (isset($department)) {
			$query_dept = "SELECT * FROM department where id = $department";
			$result_dept = mysqli_query($connect, $query_dept);

			while ($row_dept = mysqli_fetch_array($result_dept)) {
				$department = $row_dept[1];
				$idp = $row_dept[0];
				echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
			}
		} else {
			$query_unit = "SELECT * FROM unit where id = $unit";
			$result_unit = mysqli_query($connect, $query_unit);

			while ($row_unit = mysqli_fetch_array($result_unit)) {
				$department = $row_unit[1];
				$idps = $row_unit[0];
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
        
        // process builder
        $builder = new Builder\Engine();

        // send message output
        Screen\Response::getMessage($statusMsgClass, $statusMsg);
        
		?>
	</div>

	<?php $report = $builder->generateReport(); ?>

	<div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4><?=ucfirst($report->title)?></h4>
		</div>
		<div class="card-body" id="report-body">
			<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">
				<tr>
                    <form action="#report-body" method="post">
					    <td colspan="2"><input type="text" name="search" class="form-control" style="width:400px;" placeholder="Search by report title or date"></td>
                        <td><input type="submit" value="Search" class="btn btn-primary"></td>
                    </form>
				</tr>
            </table>
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
					<?=$report->headers?>
				</tr>
				</thead>
                <tbody>
                	<?=$report->body?>
                </tbody>
            </table>
            </div>
		</div>

	</div>
</div>
<script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>