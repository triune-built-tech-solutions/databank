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
			<h4>Key Performance Indicators</h4>
		</div>
		<div class="card-body">
			<div class="accordion" id="accordionExample">
				<?php $forms = $builder->formsForTarget(); $id = 0;?>
				<?php
				foreach ($forms as $index => $row) { 
	                $exp = array_flip(explode(',', $row->submits_by));

	                if (!isset($exp[Target\Office::$location])) { 
	            ?>
	            	<div class="card">
                    <div class="card-header" id="heading<?=$id?>" data-toggle="collapse" data-target="#collapse<?=$id?>" aria-expanded="<?=($id == 0 ? 'true' : 'false')?>" aria-controls="collapse<?=$id?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button">
                            <?=ucwords($row->form_name)?>
                        </button>
                    </h5>
                    </div>

                    <div id="collapse<?=$id?>" class="collapse <?=$id == 0 ? 'show' : ''?>" aria-labelledby="heading<?=$id?>" data-parent="#accordionExample">
                    <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post" enctype="multipart/form-data" id="form<?=$id?>">
                            <input type="hidden" name="entryid" value="<?=$row->entryid?>">
                            <table class="table" width="100%" cellspacing="0">
                                <tbody class="form-table">
                                	
                                	<tr>
                                		<td>
                                			<?php
                                				$remark = $row->remarks;
                                				if (strlen($remark)>1) 
                                				{
                                					echo $remark;
                                				}
                                				else
                                				{
                                					echo 'Please fill the form below and submit to continue';
                                				}
                                			?>
                                		</td>
                                		<td>
                                			<?php 

                                				$form = $builder->readBuilder($row->json_data);
                                				$form = str_replace('col-md-4', 'col-md-12', $form);

                                				echo $form;
                                			?>
                                		</td>
                                	</tr>
                                	
                                <tbody>
                            </table>
                        </form>
                    </div>
                    </div>
                    </div>
                </div>
	            <?php
	        		$id++; }}
	            ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>