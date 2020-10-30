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
        $_target = new Target\Office();
        
		?>
    </div>
    
    <?php 
        // send message output
        Screen\Response::getMessage($statusMsgClass, $statusMsg);
    ?>

    <?php if (Target\Office::$notification > 0 
        && $_target->hasView() === false) : ?>

	<div id="query_opt" class="card shadow">
		<div class="card-header">
			<h4>Key Performance Indicators</h4>
		</div>
		<div class="card-body">
            <?php if (!empty($statusMsg)) {
                echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
            } ?>
        <div class="accordion" id="accordionExample">
            <?php $target = Target\Office::Targets(); $id = 0;?>

            <?php foreach ($target as $index => $row) { 
                $exp = array_flip(explode(',', $row->submits_by));

                if (Target\Office::canShow($row)) { 
            ?>
                <div class="card">
                    <div class="card-header" id="heading<?=$id?>" data-toggle="collapse" data-target="#collapse<?=$id?>" aria-expanded="<?=($id == 0 ? 'true' : 'false')?>" aria-controls="collapse<?=$id?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button">
                            <?=ucwords($row->target_name)?>
                        </button>
                    </h5>
                    </div>

                    <div id="collapse<?=$id?>" class="collapse <?=$id == 0 ? 'show' : ''?>" aria-labelledby="heading<?=$id?>" data-parent="#accordionExample">
                    <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post" enctype="multipart/form-data" id="form<?=$id?>">
                            <input type="hidden" name="targetid" value="<?=$row->targetid?>">
                            <input type="hidden" name="score" value="<?=$row->score?>">
                            <table class="table" width="100%" cellspacing="0">
                                <tbody>
                                
                                <?php
                                    
                                    // get outcomes
                                    $outcomes = mysqli_query($connect, 'select * from performance_outcome where targetid = '.$row->targetid);

                                    // run and generate outcome
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
                                                            <th>Target Achieved </th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php 
                                                            // serial
                                                            $sn = 1;
                                                            while ($out = mysqli_fetch_object($outcomes))
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td><?=$sn?>.</td>
                                                                    <td><?=$out->outcome?></td>
                                                                    <td>
                                                                        <input type="hidden" name="outcomeid[]" value="<?=$out->outcomeid?>"/>
                                                                        <input type="number" name="outcome[]" class="form-control" placeholder="achieved" required/>
                                                                    </td>
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

                                <tr>
                                    <td>Comment</td>
                                    <td><textarea name="comment" class="form-control" style="width:250px;"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Attachment</td>
                                    <td><input name="attachment" type="file" class="form-control" style="width:250px;"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td><input type="submit" value="Submit" class="btn btn-success" data-confirm="Are you sure all fields are correct?" data-id="<?=$id?>"></td>
                                </tr>
                                <tbody>
                            </table>
                        </form>
                    </div>
                    </div>
                    </div>
                </div>
            <?php $id++; }} ?>
        </div>
        </div>
    </div>

    <?php else: ?>
        <?php if (!empty($statusMsg) && strlen($statusMsg) > 3) : ?>
            <div id="query_opt" class="card shadow">
                <div class="card-header">
                    <h4>Key Performance Indicators</h4>
                </div>                     
                <div class="card-body">
                    <?php if (!empty($statusMsg)) {
                        echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
                    } ?>
                </div>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <?php if ( $_target->hasView() ) : ?>
        <?php $view = $_target->getView(); ?>

        <div id="query_opt" class="card shadow">
		<div class="card-header">
			<h4><a href="?back" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; <?=$view->target_name?> </h4>
        </div>

        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                
                <?php
                    // run and generate outcome
                    $outcomes = Database\ORM::table('area_office_performance')->get('tsid = :id', $view->tsid);

                    if (Database\ORM::getRows($outcomes) > 0)
                    {
                        ?>
                        <tr>
                            <td> Outcomes </td>
                            <td>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>SN</th>
                                            <th>Outcome</th>
                                            <th>Target</th>
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

                                                $per = Database\ORM::table('performance_outcome_for_office');
                                                $p = $per->get('outcomeid = :oid', $out->outcomeid);

                                                $period = $out->outcome_period;

                                                if ($p->num_rows > 0)
                                                {
                                                    $p = Database\ORM::fetch($p);
                                                    $period = $p->outcome_period;
                                                }


                                                ?>
                                                <tr>
                                                    <td><?=$sn?>.</td>
                                                    <td><?=$outcome->outcome?></td>
                                                    <td><?=$period?></td>
                                                    <td><?=$out->target_achieved?></td>
                                                    <td><?=$out->scored?>%</td>
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

    <div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4>KPI Reports</h4>
		</div>
		<div class="card-body" id="report-body">
			<table class="table table-bordered table-hover table-striped table-responsive" id="dataTable" width="100%" cellspacing="0">
				<tr>
                    <form action="#report-body" method="post">
					    <td colspan="2"><input type="text" name="search" class="form-control" style="width:400px;" placeholder="Search by kpi title or date"></td>
                        <td><input type="submit" value="Search" class="btn btn-primary"></td>
                    </form>
				</tr>
            </table>
            <div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
					<th>KPI Title
					</th>
					<th>
					</th>
					<th>Total Score
					</th>
					<th>Date of Submission
                    </th>
                    <th></th>
				</tr>
				</thead>
                <tbody>
                    <?=$_target->allTargets(function($row, $t){
                        return [
                            '<td>'.$t->target_name.'</td>',
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
                            '<td>'.$row->score_earned.'%</td>',
                            '<td>'.$row->dateSubmitted.'</td>',
                            '<td><a href="?view='.$row->tsid.'" class="text-primary"><i class="fa fa-eye"></i></a></td>'
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
<script>
    var confir = document.querySelectorAll('*[data-confirm]');
    var content = document.querySelector('#content');

    if (confir.length > 0)
    {
        [].forEach.call(confir, (x)=>{
            x.addEventListener('click', function(e){
                e.preventDefault();
                // build dom
                const ask = document.querySelector('.ask-question');
                if (ask != null)
                {
                    content.removeChild(ask);
                }

                // ok create new element
                let askDom = document.createElement('div');
                askDom.className = 'ask-question';
                askDom.innerHTML = '<div class="ask-question-text"> <h1> '+this.getAttribute('data-confirm')+' </h1> </div>';
                let btn = document.createElement('div');
                btn.className = 'ask-question-btn';
                askDom.style.marginLeft = '0px';
                
                // create buttons to click
                var yes, no = document.createElement('a'), yes = document.createElement('a');
                yes.innerText = 'Yes';
                no.innerText = 'No';

                var id = this.getAttribute('data-id');
                var form = document.querySelector('#form'+id);

                no.addEventListener('click', ()=>{
                    askDom.style.bottom = '-100%';
                    setTimeout(function(){
                        document.body.removeChild(askDom);
                    },1000);
                });

                yes.addEventListener('click', ()=>{
                    no.click();
                    if (form != null)
                    {
                        form.submit();
                    }
                }); 

                btn.appendChild(yes);
                btn.appendChild(no);

                askDom.appendChild(btn);
                content.appendChild(askDom);

                setTimeout(()=>{
                    askDom.style.bottom = '0%';
                },50);
            });
        });
    }
</script>

<?php require_once ("../includes/footer.php"); ?>