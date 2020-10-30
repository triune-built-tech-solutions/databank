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

    <?php $form = $builder->formForTarget(); ?>

    <div id="query_opt" class="card shadow">
		<div class="card-header">
			<h4><a href="executive_report.php" class="text-danger"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=$form->form_name?></h4>
		</div>
		<div class="card-body">
			<form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="entryid" value="<?=$form->entryid?>">
                <small class="col-md-12 text-danger">
                	<?php
        				$remark = $form->remarks;

        				if (strlen($remark)>1) 
        				{
        					echo $remark;
        				}
        				else
        				{
        					echo 'Please fill the form below and submit to continue';
        				}
        			?>	
        			<br>
        		</small>
                <?php 

    				$f = $builder->readBuilder($form->json_data);
    				$f = str_replace('col-md-4', 'col-md-12', $f);

    				echo $f;
    			?>
            </form>
		</div>
	</div>

	<br>
	<div id="query_opt" class="card shadow">
		<div class="card-header">
			<h4><?=$form->form_name?> Submissions</h4>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
					<?php
						$names = $builder->getNames(json_decode($form->json_data));
						foreach ($names as $i => $name)
						{
							$name = ucwords(str_replace('_', ' ', $name));
							echo '<th>'.$name.'</th>'.PHP_EOL;
						}
					?>
					<th>Added by</th>
					<th>Date Added</th>
				</tr>
				</thead>
                <tbody>
                	<?php
                		$data = $builder->getEntriesData($names);

                		foreach ($data as $index => $arr)
                		{
                			$build = '<tr>';
            				foreach ($arr['entry'] as $i => $d)
            				{
            					$build .= '<td>'.$d.'</td>';
            				}
            				// added by
            				$row = $arr['row'];

            				$build .= '<td>'.$builder->addedBy($row->submitted_by).'</td>';
            				$build .= '<td>'.$row->date_created.'</td>';
                			$build .= '</tr>';

                			echo($build);
                		}
                	?>
                </tbody>
            </table>
            </div>
		</div>
	</div>

</div>
<script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>