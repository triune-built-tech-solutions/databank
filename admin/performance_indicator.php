<?php
require_once("../includes/header.php");
?>
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
        
        // process form
        $target = new Target\Create();

        // send message output
        Screen\Response::getMessage($statusMsgClass, $statusMsg);
        
		?>
	</div>
    <?php if (!$target->get->has('view')) : ?>
        <div id="query_opt" class="card shadow">
            <div class="card-header">
                <h4><?=$target->getState()?></h4>
            </div>
            
            <form class="card-body" action="" method="post" name="report_query">
                <?php if (!empty($statusMsg)) {
                    echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
                } ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <tbody class="form-table">
                            <?=$target->editTarget($target_name, $outcome, $outcome_period, $alloutcomes, $score, $area_offices, $button, $start_date, $end_date)?>
                        <tr>
                            <td> KPI Title
                            </td>
                            <td align="left"><input type="text" name="target_name" value="<?=$target_name?>" class="form-control" placeholder="KPI Title" required>
                            </td>
                        </tr>

                        <tr>
                            <td>Outcome</td>
                            <td>
                                <div class="wrapper row-gap10">
                                    <div class="w1-18 wrapper column-gap10">
                                        <div class="w1-8">
                                            <input type="text" name="outcome[]" class="form-control" placeholder="Performance Outcome" value="<?=$outcome?>"/>
                                        </div>

                                        <div class="w8-14">
                                            <input type="text" name="outcome_period[]" class="form-control" placeholder="Annual Target" value="<?=$outcome_period?>"/>
                                        </div>

                                        <div class="w14-18">
                                            <button type="button" class="btn btn-primary" onclick="addOutcome(this.parentNode.parentNode);"> <i class="fa fa-plus"></i> Add More </button>
                                        </div>
                                    </div>

                                    <?php
                                        // list outcomes
                                        if (count($alloutcomes) > 0)
                                        {
                                            foreach ($alloutcomes as $index => $obj)
                                            {
                                                ?>
                                                    <div class="w1-18 wrapper column-gap10">
                                                        <div class="w1-8">
                                                            <input type="text" name="outcome[]" class="form-control" placeholder="Performance Outcome" value="<?=$obj->outcome?>"/>
                                                        </div>
                                                        <div class="w8-14">
                                                            <input type="text" name="outcome_period[]" class="form-control" placeholder="Annual Target" value="<?=$obj->outcome_period?>"/>
                                                        </div>
                                                        <div class="w14-18">
                                                            <a href="?edit=<?=$obj->targetid?>&del-outcome=<?=$obj->outcomeid?>" class="btn btn-danger" data-confirm="Are you sure you want to delete?"> <i class="fa fa-minus"></i> Remove </a>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                                <input type="hidden" name="score" value="100" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>Area Offices - (Assign Target)</td>
                            <td>
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
                                <input type="hidden" name="area_offices" value="<?=$area_offices?>" data-offices="<?=$json?>" required/>
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
                            <?php
                                $month = intval(date('t'));
                            ?>
                            <td>Publication Interval</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6 relative-pos">
                                        <span>Publication day</span>
                                        <input type="hidden" class="form-control" name="date_start" value="<?=$start_date?>" required>
                                        <div class="input-calender" data-month="<?=$month?>" data-start-from="1">
                                            <?php
                                                for($x=1; $x != $month+1; $x++)
                                                {
                                                    if ($start_date == $x)
                                                    {
                                                        echo '<span class="active">'.$x.'</span>';
                                                    }
                                                    else
                                                    {
                                                        echo '<span>'.$x.'</span>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 relative-pos">
                                        <span>Expiration day</span>
                                        <input type="hidden" class="form-control" name="date_end" value="<?=$end_date?>" required>
                                        <div class="input-calender" data-month="<?=$month?>" data-start-from="<?=date('d')?>">
                                            <?php
                                                $current = date('d');
                                                for($x=1; $x != $month+1; $x++)
                                                {

                                                    if ($end_date == $x)
                                                    {
                                                        echo '<span class="active">'.$x.'</span>';
                                                    }
                                                    elseif ($x >= $current)
                                                    {
                                                        echo '<span>'.$x.'</span>';
                                                    }
                                                    else
                                                    {
                                                        echo '<span class="inactive">'.$x.'</span>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="<?=$button?>" class="btn btn-success"></td>
                        </tr>
                        <tbody>
                    </table>
                </div>

            </form>
        </div>
    <?php else : ?>
        <?php $target->viewTarget($target_name, $view); ?>

        <div id="query_opt" class="card shadow">
            <div class="card-header">
                <h4><a href="?back" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=$target_name?></h4>
            </div>
            
            <div class="card-body" id="report-body">
			
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
                    <th>S/N</th>
					<th>Area Office
					</th>
					<th>
                    </th>
					<th>Score earned
                    </th>
                    <th>Date Submitted
					</th>
				</tr>
				</thead>
                <tbody>
                    <?=call_user_func($view->listTarget, function($row){
                        return [
                            '<td>'.$row->c.'.</td>',
                            '<td>'.$row->area_office.'</td>',
                            '<td>
                            <table class="table">
                                <tr>
                                    <th> Outcome </th>
                                    <th> Target </th>
                                    <th> Achieved </th>
                                    <th> Score </th>
                                </tr>
                                '.$row->outcome.'
                            </table></td>',
                            '<td>'.$row->score.'</td>',
                            '<td>'.$row->date.'</td>'
                        ];
                    })?>
                </tbody>
            </table>
            </div>
		</div>
        </div>
    <?php endif; ?>


    <script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

	<div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4>Performance Indicator Reports</h4>
		</div>
		<div class="card-body" id="report-body">
			<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">
				<tr>
                    <form action="#report-body" method="post">
					    <td colspan="2"><input type="text" name="search" class="form-control" style="width:400px;" placeholder="Search by KPI title, area office, date"></td>
                        <td><input type="submit" value="Search" class="btn btn-primary"></td>
                    </form>
				</tr>
            </table>
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
					<th style="width: 250px;"> KPI Title
					</th>
					<th>Office[s]
					</th>
					<th>Submits
					</th>
                    <th>Published</th>
                    <th></th>
				</tr>
				</thead>
                <tbody>
                    <?=$target->targetCreated(function($row){

                        // return link
                        $link = $row->target_name;

                        if ($row->target_submits > 0)
                        {
                            $s = $row->target_submits > 1 ? 's' : '';
                            $link = '<a href="?view='.$row->targetid.'" title="View Submit'.$s.'">'.$row->target_name.'</a>';
                        }

                        // $publish = '<a href="?publish='.$row->targetid.'" title="publish '.$row->target_name.'" class="text text-warning"><i class="fa fa-eye-slash"></i></a>';

                        // if ($row->published == 1)
                        // {
                        //      $publish = '<a href="?unpublish='.$row->targetid.'" title="unpublish '.$row->target_name.'" class="text text-success"><i class="fa fa-eye"></i></a>';
                        // }

                        $publish = ($row->published == 1 ? 'Yes &nbsp; <a href="?unpublish='.$row->targetid.'" class="btn-outline danger">unpublish</a>' : 'No &nbsp; <a href="?publish='.$row->targetid.'" class="btn-outline success">publish</a>');

                        return [
                            '<td>'.$link.'</td>',
                            '<td><a href="manage_targets.php?id='.$row->targetid.'">('.(count(explode(',', $row->area_offices))).'). Update outcomes</a></td>',
                            '<td>'.($row->target_submits > 0 ? $row->target_submits : 0).'</td>',
                            '<td>'.$publish.'</td>',
                            '<td><a href="?edit='.$row->targetid.'" title="edit '.$row->target_name.'" class="text-primary"><i class="fa fa-edit"></i></a> | <a href="?del='.$row->targetid.'" title="delete '.$row->target_name.'" class="text text-danger"><i class="fa fa-trash"></i></a></td>'
                        ];
                    })?>
                </tbody>
            </table>
            </div>
		</div>

	</div>
</div><!-- close content -->
<div id="divi">

</div><br/>

<?php require_once ("../includes/footer.php"); ?>