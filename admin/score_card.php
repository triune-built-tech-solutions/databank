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

    <?php if ( $target->hasView() === false 
    && $target->hasInfo() === false
    && $target->hasKpi() === false
    && $target->hasOffice() === false
    && $target->showReport() === false) : ?>

	<div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4>Performance Indicator Score Card</h4>
		</div>
		<div class="card-body" id="report-body">
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
                    <th>S/N</th>
					<th>KPI Title
					</th>
					<th>Area Offices
					</th>
					<th>Submits
					</th>
				</tr>
				</thead>
                <tbody>
                <?=$target->targetCreated(function($row){
                    return [
                        '<td>'.$row->sn.'</td>',
                        '<td>'.$row->target_name.'</td>',
                        '<td>'.(count(explode(',', $row->area_offices))).'</td>',
                        '<td>'.($row->target_submits > 0 ? $row->target_submits : 0).'</td>',
                    ];
                },true,'kpi')?>
                </tbody>
            </table>
            </div>
		</div>

    </div>
    
    <?php endif; ?>

    <?php if ($target->showReport($title, true, $year)) : ?>
    <div id="query_opt" class="card shadow">
        <div class="card-header">
            <h4><a href="#" onclick="history.back()" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; Go Back </h4>
        </div>

        <div class="card-body">
        <div class="wrapper" >
            <div class="w1-end wrapper">
                <h1 class="w1-end text-center report-table-title"> <?=$year?> END OF YEAR PERFORMANCE REVIEW MEETING </h1> 

                <div class="table-responsive w1-end">
                    <!-- table information -->
                    <table class="table table-bordered report-table w1-end">
                        <tr>
                            <td colspan="9" class="text-center report-sub-title">KEY DELIVERABLES [JANUARY - DECEMBER, <?=$year?>]</td>
                        </tr> 
                        <tr>
                            <td colspan="9" class="text-center report-sub-title"><?=$title?></td>
                        </tr>
                        <tr>
                            <td class="no-bottom-border"></td>
                            <td class="no-bottom-border"></td>
                            <td colspan="3" style="height:30px">DECEMBER <?=intval($year)-1?></td>
                            <td colspan="4" style="height:30px">DECEMBER <?=intval($year)?></td>
                        </tr>
                        <tr>
                            <th class="no-top-border">SN.</th>
                            <th class="no-top-border">OUTCOME</th>
                            <th>ANNUAL TARGET <?=intval($year)-1?></th>
                            <th>ACTUAL ACHIEVED <?=intval($year)-1?></th>
                            <th>% ACHIEVED <?=intval($year)-1?></th>
                            <th>ANNUAL TARGET <?=intval($year)?></th>
                            <th>ACTUAL ACHIEVED <?=intval($year)?></th>
                            <th>% ACHIEVED <?=intval($year)?></th>
                            <th>REMARK</th>
                        </tr>

                        <!-- list outcomes -->
                        <?=$target->getOutcomes(function($row) use ($year)
                        {
                            // last year
                            $lastYear = intval($year)-1;
                            $currentYear = intval($year);

                            // return row
                            return [
                                '<td>'.$row->sn.'</td>',
                                '<td>'.$row->outcome.'</td>',
                                '<td>'.$row->annual[$lastYear].'</td>',
                                '<td>'.$row->achieved[$lastYear].'</td>',
                                '<td>'.$row->percentage[$lastYear].'</td>',
                                '<td>'.$row->annual[$currentYear].'</td>',
                                '<td>'.$row->achieved[$currentYear].'</td>',
                                '<td>'.$row->percentage[$currentYear].'</td>',
                                '<td>'.$row->remark[$currentYear].'</td>'
                            ];
                        })?>
                    </table>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        </div>

        </div>
    <?php endif; ?>

    <?php if ($target->hasInfo()) : ?>
    <?php $view = $target->getInfo();  $year = isset($_GET['year']) ? $_GET['year'] : date('Y'); ?>
        <div id="query_opt" class="card shadow">
        <div class="card-header wrapper">
            <h4 class="w1-14"><a href="#" onclick="history.back()" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=$view->target_name?> </h4>
            <div class="w14-end text-right">
                <a href="?show-report=<?=$_GET['kpi']?>&officeid=<?=$_GET['officeid']?>&year=<?=$year?>" class="btn btn-success"> Show Report </a>  

                <a href="show-analytics.php?id=<?=$_GET['kpi']?>&officeid=<?=$_GET['officeid']?>" class="btn btn-primary"> Analytics </a>    
            </div>
        </div>

        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <tbody class="form-table">
                
                <?php
                    // run and generate outcome
                    $outcomes = Database\ORM::table('area_office_performance')->get('tsid = :id', $view->tsid);

                    if (Database\ORM::getRows($outcomes) > 0)
                    {
                        ?>
                        <tr>
                            <td> Outcomes </td>
                            <td>
                                <table class="no-grid">
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Outcome</th>
                                            <th>Annual/Monthly Target</th>
                                            <th>Target Achieved </th>
                                            <th>Score earned </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            // serial
                                            $sn = 1;
                                            while ($out = Database\ORM::fetch($outcomes))
                                            {
                                                // get outcome name and other information
                                                $outcome = Database\ORM::table('performance_outcome');
                                                $outcome->get('outcomeid = :id', $out->outcomeid);

                                                $query = 'select * from targets_submitted where tsid = '.$out->tsid;
                                                $submitted = mysqli_query($connect, $query);
                                                $submit = mysqli_fetch_object($submitted);

                                                $query = 'select * from performance_outcome_for_office where outcomeid = '.$out->outcomeid.' and officeid = '.$submit->area_officeid;

                                                $getout = mysqli_query($connect, $query);

                                                if ($getout->num_rows > 0)
                                                {
                                                    $data = mysqli_fetch_object($getout);
                                                    $outcome->outcome_period = $data->outcome_period;
                                                }

                                                ?>
                                                <tr>
                                                    <td><?=$sn?>.</td>
                                                    <td><?=$outcome->outcome?></td>
                                                    <td><?=$outcome->outcome_period?></td>
                                                    <td><?=$out->target_achieved?></td>
                                                    <td><?=$out->scored?></td>
                                                </tr>
                                                <?php
                                                // increment
                                                $sn += 1; 
                                            }
                                        ?>
                                    </tbody>
                                </table>      
                            </td>
                        </tr>

                        <?php
                    }
                ?>

                <tr class="no-border">
                    <td>Score earned</td>
                    <td> <?=$view->score_earned?>
                    </td>
                </tr>

                <tr class="no-border">
                    <td>Comment</td>
                    <td> <?=$view->comment?>
                    </td>
                </tr>

                <tr class="no-border">
                    <td>Date Submitted</td>
                    <td> <?=$view->dateSubmitted?>
                    </td>
                </tr>

                <tr class="no-border">
                    <td>Attachment</td>
                    <td> <?=$view->attachment?>
                    </td>
                </tr>

                <tr class="no-border">
                    <td>Submitted by</td>
                    <td> <?=$view->submittedby?>
                    </td>
                </tr>

                <tbody>
            </table>
        </div>
        </div>

        </div>
    <?php endif; ?>

    <?php if ($target->hasKpi($title, true)) : ?>
        <div id="show_rep" class="mt-5 card shadow">
            <div class="card-header">
                <h4><a href="?back" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=ucwords($title)?></h4>
            </div>
            <div class="card-body" id="report-body">

                <div class="row">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                        <?php
                            $query = 'SELECT year FROM target_submission WHERE targetid = '.$target->get('kpi').' ORDER BY year desc';
                            $submission = mysqli_query($connect, $query);
                            $years = [];

                            if ($submission->num_rows > 0)
                            {
                                while ($data = mysqli_fetch_object($submission))
                                {
                                    $years[] = $data->year;
                                }
                            }

                            $years = array_unique($years);

                        ?>
                        <select name="year" class="form-control" onchange="queryYear(event)" data-kpi="<?=$_GET['kpi']?>">
                            <option value=""> -- Select Year -- </option>
                            <?php
                                foreach ($years as $year)
                                {
                                    ?>
                                    <option value="<?=$year?>"><?=$year?></option>
                                    <?php
                                }
                            ?>  
                        </select>
                    </div>
                </div>

                <script>
                    function queryYear(event)
                    {
                        if (event.target.value != '')
                        {
                            var kpi = event.target.getAttribute('data-kpi');
                            window.open('?kpi='+kpi+'&year='+event.target.value, '_self', 'location=yes');
                        }
                    }
                </script>
               <!-- Nav tabs -->
               <ul class="nav nav-tabs" role="tablist">
                  <?php
                     $current = date('F');
                     for ($x=1; $x != 13; $x++)
                     {
                        $time = mktime(0,0,0,$x,1,date('Y'));
                        $month = date('F', $time);

                        ?>
                            <li role="presentation" class="<?=$current == $month ? 'active' : ''?>">
                                 <a href="#<?=$month?>" aria-controls="<?=$month?>" role="tab" data-toggle="tab"><?=$month?></a>     
                            </li>
                        <?php
                     }
                  ?>
               </ul>
               <!-- Tab panes -->
               <div class="tab-content">
                  <?php

                     // get target
                    $targets = Database\ORM::table('create_targets');
                    $targets->get('targetid = :id', $target->kpi);

                    // get submits 
                    $submits = explode(',', $targets->submits_by);

                     for ($x=1; $x != 13; $x++)
                     {
                        $time = mktime(0,0,0,$x,1,date('Y'));
                        $month = date('F', $time);

                        ?>
                            <div role="tabpanel" style="padding: 10px;" class="tab-pane <?=$current == $month ? 'active' : ''?>" id="<?=$month?>">
                                
                                <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Area Office
                                        </th>
                                        <th>
                                        </th>
                                        <th>Total Score</th>
                                        <th>Date
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $sn = 1;

                                            $year = date('Y');

                                            if (isset($_GET['year']))
                                            {
                                                $year = filter_var(intval($_GET['year']), FILTER_VALIDATE_INT);
                                            }

                                            if (!is_int($year)) { $year = date('Y'); }

                                             // run data
                                            foreach ($submits as $index => $areaid)
                                            {
                                                $office = Database\ORM::table('area_office');
                                                $office->get('id = :id', $areaid);
                                                $area_office = $office->area_office_name;

                                                $query = 'SELECT * FROM target_submission WHERE targetid = '.$target->kpi.' and officeid = '. $areaid;
                                                $query .= ' AND year = '. $year;
                                                $submission = mysqli_query($connect, $query);

                                                if ($submission->num_rows > 0)
                                                {
                                                    $data = mysqli_fetch_object($submission);
                                                    $m = strtolower($month);
                                                    // get id
                                                    $getid = $data->{$m};
                                                    
                                                    if (strlen($getid) > 0)
                                                    {
                                                        // get outcome id
                                                        $query = 'SELECT * FROM area_office_performance WHERE tsid = '.$getid;
                                                        $outcomes = mysqli_query($connect, $query);


                                                        // get target submitted
                                                        $submitted = Database\ORM::table('targets_submitted');
                                                        $sub = $submitted->get('tsid=:id', $getid);

                                                        $sub = Database\ORM::fetch($sub);

                                                        $outcome = [];

                                                        // get total score
                                                        $scores = 0;
                                                        while ($o = mysqli_fetch_object($outcomes))
                                                        {
                                                            $scores += $o->scored;

                                                            // get outcome
                                                            $query = 'SELECT * FROM performance_outcome WHERE outcomeid = '.$o->outcomeid;

                                                            $per = mysqli_query($connect, $query);
                                                            $per = mysqli_fetch_object($per);

                                                            $_target = $per->outcome_period;

                                                            // check performance_outcome_for_office
                                                            $query = 'SELECT * FROM performance_outcome_for_office WHERE outcomeid = '.$o->outcomeid.' and officeid = '.$areaid;

                                                            $peroffice = mysqli_query($connect, $query);

                                                            if ($peroffice->num_rows > 0)
                                                            {
                                                                $peroffice = mysqli_fetch_object($peroffice);
                                                                $_target = $peroffice->outcome_period;
                                                            }

                                                            $outcome[] = '<tr>
                                                            <td>'.$per->outcome.'</td>
                                                            <td>'.$_target.'</td>
                                                            <td>'.$o->target_achieved.'</td>
                                                            <td>'.$o->scored.'</td>
                                                            </tr>';
                                                        }

                                                        $outcome = implode("\n", $outcome);

                                                        echo '<tr data-href="?info='.$getid.'&kpi='.$_GET['kpi'].'&officeid='.$areaid.'&year='.$year.'">';
                                                        echo '<td>'.$sn.'</td>';
                                                        echo '<td>'.$area_office.'</td>';
                                                        echo '<td><table class="table">
                                                                    <tr>
                                                                        <th> Outcome </th>
                                                                        <th> Target </th>
                                                                        <th> Achieved </th>
                                                                        <th> Score </th>
                                                                    </tr>
                                                                    '.$outcome.'
                                                                </table></td>';
                                                        echo '<td>'.$scores.'</td>';
                                                        echo '<td>'.$sub->dateSubmitted.'</td>';
                                                        echo '</tr>';
                                                    }
                                                }

                                                $sn++;
                                            }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                </div>

                            </div>
                        <?php
                     }
                  ?>
               </div>
            </div>

        </div>
    <?php endif; ?>

    <?php if ($target->hasOffice()) : ?>
    <?php $view = $target->getOffice(); ?>
    <div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4><a href="?back" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=$view->office?></h4>
		</div>
		<div class="card-body" id="report-body">
			
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
                    <th>S/N</th>
					<th>Target Name
					</th>
					<th>Expected Target
                    </th>
                    <th>Interval
					</th>
					<th>Fulfilled
					</th>
					<th>Score earned
                    </th>
                    <th>Date
					</th>
				</tr>
				</thead>
                <tbody>
                    <?=call_user_func($view->listTarget, function($row){
                        return [
                            '<td>'.$row->c.'.</td>',
                            '<td>'.$row->target_name.'</td>',
                            '<td>'.$row->expected.'</td>',
                            '<td>'.$row->interval.'</td>',
                            '<td>'.$row->fulfilled.'</td>',
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
</div><!-- close content -->
<div id="divi">

</div><br/>

<script>
    var dataHref = document.querySelectorAll('*[data-href]');
    if (dataHref.length > 0)
    {
        [].forEach.call(dataHref, (e)=>{
            e.addEventListener('click', (x)=>{
                var target = e.getAttribute('data-href');
                var href = window.location.href;

                if (href.indexOf('?') !== false)
                {
                    href = href.substr(0, href.indexOf('?'));
                }

                window.open( href + target, '_self');
            });
        });
    }
</script>

<?php require_once ("../includes/footer.php"); ?>