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

	<?php if (!empty($statusMsg)) {
        echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
    } ?>


	<div id="query_opt" class="card shadow">
        <div class="card-header">
            <h4><?=$builder->title?></h4>
        </div>
        
        <div class="card-body" id="report-body">
			
			<?php if (!$builder->view && !$builder->edit) : ?>
	        <div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
					<tr>
		                <th>S/N</th>
						<th>Form Name</th>
						<th>Area Offices</th>
						<th>Published</th>
		                <th>Submits</th>
		                <th>Date Created</th>
						<th></th>
					</tr>
					</thead>
		            <tbody>
		                <?=$builder->fetchRows()?>		
		            </tbody>
		        </table>
	        </div>
		    <?php elseif ($builder->edit): ?>
		    	<?php
                $q = mysqli_query($GLOBALS["___mysqli_ston"], "select * from area_office order by area_office_name asc");
                if (!$q) {
                    print mysqli_error($GLOBALS["___mysqli_ston"]);
                    exit;
                }
                $offices = [];

                while ($r = mysqli_fetch_array($q)) {
                    $offices[$r['area_office_name']] = $r['id'];
                }

                $json = preg_replace('/["]/',"'",json_encode($offices));

                ?>
                <form action="" method="post">
                	<div class="table-responsive">
	                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
	                        <tbody class="form-table">
	                        	<tr>
		                            <td> Form Title
		                            </td>
		                            <td align="left"><input type="text" name="form_name" value="<?=$builder->data->form_name?>" class="form-control" placeholder="Form Title" required>
		                            </td>
		                        </tr>

		                        <tr>
		                        	<td>Area Offices</td>
		                        	<td>
		                        		<input type="hidden" name="area_offices" value="<?=$builder->data->area_officeid?>" data-offices="<?=$json?>" data-autoselect="none" data-action="update" required/>
						                <section class="select-wrapper">
						                    <section class="search-box">
						                        <input class="form-control" data-search="search-offices" placeholder="Search for an area office">
						                        <span class="select-info">
						                            (<span>0</span>) selected.
						                        </span>
						                        <span class="select-all"><i class="fa fa-plus"></i> Add All </span>
						                    </section>

						                    <section data-select="list" class="select-list">
						                    </section>
						                </section>
		                        	</td>
		                        </tr>

		                        <tr>
		                        	<td></td>
		                        	<td>
		                        		<input type="submit" value="Update" class="btn btn-success" name="update">
		                        	</td>
		                        </tr>
	                        </tbody>
	                    </table>
	                </div>
	            </form>
		    <?php elseif ($builder->view): ?>
		    	<div class="builder-transpire">
		    		<?=$builder->readBuilder()?>
		    	</div>
		    <?php endif; ?>

		</div>
    </div>
</div>
<script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>