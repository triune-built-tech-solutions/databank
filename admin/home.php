<?php require_once("../includes/header.php");?>

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
					echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SUB-UNIT:</span> " . $row_div[2] . ".&nbsp;&nbsp;&nbsp;";
				}
			}
			if (isset($section)) {
				$query_section = "SELECT * FROM section where section_id = $section";
				$result_section = mysqli_query($connect, $query_section);

				while ($row_section = mysqli_fetch_array($result_section)) {
					echo "|&nbsp; <span style='color:#A80203; font-size:13px; font-weight:bold;'> SECTION:</span> " . $row_section[2] . ".</p>";
				}
			}

			$dash_sched = "SELECT sum(training), sum(participants) from scheduled_training";
			$dash_res_sched = mysqli_query($connect, $dash_sched);
			while ($dash_row_sched = mysqli_fetch_array($dash_res_sched)) {
				$tot_sched = $dash_row_sched[0];
				$tot_sched_p = $dash_row_sched[1];
			}

			$dash_unsched = "SELECT sum(target), sum(participants) from unscheduled_training";
			$dash_res_unsched = mysqli_query($connect, $dash_unsched);
			while ($dash_row_unsched = mysqli_fetch_array($dash_res_unsched)) {
				$tot_unsched = $dash_row_unsched[0];
				$tot_unsched_p = $dash_row_unsched[1];
			}

			$dash_staff = "SELECT count(*) as all_staff from nominal";
			$dash_res_staff = mysqli_query($connect, $dash_staff);
			while ($dash_row_staff = mysqli_fetch_array($dash_res_staff)) {
				$tot_staff = $dash_row_staff[0];
			}

			$dash_staff_p = "SELECT count(*) as all_staff from staff_prog";
			$dash_res_staff_p = mysqli_query($connect, $dash_staff_p);
			while ($dash_row_staff_p = mysqli_fetch_array($dash_res_staff_p)) {
				$tot_staff_p = $dash_row_staff_p[0];
			}

			$dash_train_cont = "SELECT sum(amount_coll) as all_coll from train_cont";
			$dash_res_train_cont = mysqli_query($connect, $dash_train_cont);
			while ($dash_row_train_cont = mysqli_fetch_array($dash_res_train_cont)) {
				$tot_train_cont = $dash_row_train_cont[0];
			}

			$dash_comp_acct = "SELECT sum(amount) as amt_coll from ver_comp_acct";
			$dash_res_comp_acct = mysqli_query($connect, $dash_comp_acct);
			if (!$dash_res_comp_acct) {
				print mysqli_error($GLOBALS["___mysqli_ston"]);
				exit;
			}
			while ($dash_row_comp_acct = mysqli_fetch_array($dash_res_comp_acct)) {
				$tot_comp_acct = $dash_row_comp_acct[0];
			}

			$dash_rev_c = "SELECT sum(amount_coll) as amt_coll from rev_fr_course";
			$dash_res_rev_c = mysqli_query($connect, $dash_rev_c);
			while ($dash_row_rev_c = mysqli_fetch_array($dash_res_rev_c)) {
				$tot_rev_c = $dash_row_rev_c[0];
			}

			$dash_reimburse = "SELECT sum(amount_paid) as amt_coll from reimbursement";
			$dash_res_reimburse = mysqli_query($connect, $dash_reimburse);
			while ($dash_row_reimburse = mysqli_fetch_array($dash_res_reimburse)) {
				$tot_reimburse = $dash_row_reimburse[0];
			}

			$dash_siwes = "SELECT sum(student_placed), sum(srudent_paid) from siwes_matters";
			$dash_res_siwes = mysqli_query($connect, $dash_siwes);
			while ($dash_row_siwes = mysqli_fetch_array($dash_res_siwes)) {
				$tot_siwes_placed = $dash_row_siwes[0];
				$tot_siwes_paid = $dash_row_siwes[1];
			}

			$dash_incompany = "SELECT sum(survey_conducted), sum(prog_implemented) from incompany";
			$dash_res_incompany = mysqli_query($connect, $dash_incompany);
			if (!$dash_res_incompany) {
				print mysqli_error($GLOBALS["___mysqli_ston"]);
				exit;
			}
			while ($dash_row_incompany = mysqli_fetch_array($dash_res_incompany)) {
				$tot_in_company = $dash_row_incompany[0];
				$tot_in_company1 = $dash_row_incompany[1];
			}


			$dash_nisdp = "SELECT * from nisdp_part";
			$dash_res_nisdp = mysqli_query($connect, $dash_nisdp);
			$tot_trainee_n = mysqli_num_rows($dash_res_nisdp);

			$dash_tsdp = "SELECT * from tsdp_part";
			$dash_res_tsdp = mysqli_query($connect, $dash_tsdp);
			$tot_trainee_t = mysqli_num_rows($dash_res_tsdp);
			?>
		</div>

		<div class="row">
			<div class="col-md-12 mb-3 mt-3">
				<div class="card o-hidden border-0 shadow">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-3 hidden-sm">
								<div class="d-flex justify-content-center">
									<img style="height: 200px; width: 200px" class="card-img p-2" alt="ITF Logo" src="../assets/img/itf-logo.png">
								</div>
							</div>
							<div class="col-md-9 bg-dark flex-column">
								<h1 class="h4 text-white m-4" style="font-weight: 100; line-height: 2;">
									The ITF Data Bank System provides an interface for interacting with business
									intelligence, data, and reports generated to the Industrial Training Fund.
								</h1>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="col-md-8">
				<div class="card mb-3 shadow">
					<div class="row no-gutters">
						<div class="col-md-5">
							<img src="../assets/img/reports.jpg" class="card-img" alt="...">
						</div>
						<div class="col-md-7">
							<div class="card-body">
								<h3 class="card-title">Reports</h3>
								<p class="card-text">Create and access various reports relevant to your Area Office or Department</p>
								<ul class="list-group list-group-flush">
									<li class="list-group-item"><a class="card-link" href="special_rpt.php">Departmental Reports</a></li>
									<li class="list-group-item"><a class="card-link" href="meeting.php">Area Office Reports</a></li>
									<li class="list-group-item"><a class="card-link" href="view_legals.php">Legal Reports</a></li>
									<li class="list-group-item"><a class="card-link" href="add_procurement.php">Procurement Reports</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card shadow pb-3">
					<!--<img src="../assets/img/reports.jpg" class="card-img-top" alt="...">
					<hr>-->
					<div class="card-body">
						<h3 class="card-title">Organisation</h3>
						<p class="card-text">Upload and verify organisation wide information</p>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item"><a class="card-link" href="itf_prog.php">Administer Work Plans</a></li>
						<li class="list-group-item"><a class="card-link" href="view_nominal.php">View Nominal Roll</a></li>
						<li class="list-group-item"><a class="card-link" href="admin_log.php">Manage Organisational Structure</a></li>
						<li class="list-group-item"><a class="card-link" href="view_itf_programmes.php">ITF Training Programmes</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<?php require_once("../includes/footer.php");?>