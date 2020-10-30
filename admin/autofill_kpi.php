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

        function getVal($key, $record)
        {
            if (isset($record->{$key}))
            {
                return $record->{$key};
            }

            return null;
        }
    ?>

    <?php if (Target\Office::targetExists()) : ?>

	<div id="query_opt" class="card shadow">
		<div class="card-header">
			<h4>Key Performance Indicators</h4>
		</div>
		<div class="card-body">
            <?php if (!empty($statusMsg)) {
                echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
            } ?>
        <div class="accordion" id="accordionExample">
            <?php $target = Target\Office::getAllTargets(); $id = 0;?>

            <?php foreach ($target as $index => $row) { 
                $exp = array_flip(explode(',', $row->submits_by));
                $show = isset($_GET['targetid']) && ($_GET['targetid'] == $row->targetid) ? 'show' : '';
            ?>
                <div class="card">
                    <div class="card-header" id="heading<?=$id?>" data-toggle="collapse" data-target="#collapse<?=$id?>" aria-expanded="false" aria-controls="collapse<?=$id?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button">
                            <?=ucwords($row->target_name)?>
                        </button>
                    </h5>
                    </div>

                    <div id="collapse<?=$id?>" class="collapse <?=$show?>" aria-labelledby="heading<?=$id?>" data-parent="#accordionExample">
                    <div class="card-body">
                    <div class="table-responsive">
                        <form action="" method="post" enctype="multipart/form-data" id="form<?=$id?>">
                            <input type="hidden" name="targetid" value="<?=$row->targetid?>">
                            <input type="hidden" name="score" value="<?=$row->score?>">
                            <table class="table" width="100%" cellspacing="0">
                                <tbody class="form-table">
                                
                                <?php
                                    
                                    $edit = false;
                                    $record = (object) [];
                                    $jsonData = (object) [];

                                    if (isset($_GET['edit']) && (isset($_GET['targetid']) && ($_GET['targetid'] == $row->targetid)))
                                    {
                                        $manualEntries = Database\ORM::table('manual_kpi_entries')->get('entryid = :id', $_GET['edit']);
                                        if (Database\ORM::getRows($manualEntries) > 0)
                                        {
                                            $edit = true;
                                            $record = Database\ORM::fetch($manualEntries);
                                            $jsonData = json_decode($record->manual_entry);
                                        }
                                    }

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
                                                                $rowVal = null;

                                                                if ($edit)
                                                                {
                                                                    $merge = array_combine($jsonData->outcomeid, $jsonData->outcome);
                                                                    $rowVal = $merge[$out->outcomeid];
                                                                }
                                                                ?>
                                                                <tr>
                                                                    <td><?=$sn?>.</td>
                                                                    <td><?=$out->outcome?></td>
                                                                    <td>
                                                                        <input type="hidden" name="outcomeid[]" value="<?=$out->outcomeid?>"/>
                                                                        <input type="number" name="outcome[]" class="form-control" placeholder="achieved" value="<?=$rowVal?>" required/>
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
                                    <td><textarea name="comment" class="form-control" style="width:250px;"><?=getVal('comment', $jsonData)?></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Attachment</td>
                                    <td><input name="attachment" type="file" class="form-control" style="width:250px;"></textarea>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Month</td>
                                    <td>
                                        <select name="month" required class="form-control">
                                            <?php
                                            for ($x=1; $x != 13; $x++)
                                            {
                                               $time = mktime(0,0,0,$x,1,date('Y'));
                                               $month = date('F', $time);
                                               $selected = null;
                                                
                                               $getMonth = getVal('month', $record);

                                               if ($getMonth !== null)
                                               {
                                                   if ($x == $getMonth)
                                                   {
                                                       $selected = 'selected';
                                                   }
                                               }
                                               ?>
                                                   <option value="<?=$x?>" <?=$selected?>><?=$month?></option>
                                               <?php
                                            }?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Year</td>
                                    <td>
                                        <select name="year" required class="form-control">
                                            <?php
                                            
                                            $current = intval(date('Y'));
                                            $last5 = $current -5;

                                            for ($x=$current; $x != $last5; $x--)
                                            {
                                                $selected = null;
                                                $getYear = getVal('year', $record);

                                                if ($getYear !== null)
                                                {
                                                    if ($x == $getYear)
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                }
                                                else
                                                {
                                                    if ($x == $current)
                                                    {
                                                        $selected = 'selected';
                                                    }
                                                }

                                                ?>
                                                    <option value="<?=$x?>" <?=$selected?>><?=$x?></option>
                                                <?php
                                            }?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Area Offices</td>
                                    <td data-parent="true">
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

                                    $areaoffices = $row->area_offices;

                                    $getOffices = getVal('area_offices', $jsonData);

                                    if ($getOffices != null)
                                    {
                                        $areaoffices = $getOffices;
                                    }

                                    $autoselect = 'data-autoselect="false"';

                                    if (isset($_GET['edit']) && $_GET['targetid'] == $row->targetid){ $autoselect = ''; }
                                    ?>
                                    <input type="hidden" name="area_offices" <?=$autoselect?> value="<?=$areaoffices?>" data-offices="<?=$json?>" required/>
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
                                    <td><input type="submit" value="Submit" class="btn btn-success" data-confirm="Are you sure all fields are correct?" data-id="<?=$id?>"></td>
                                </tr>
                                <tbody>
                            </table>
                        </form>
                    </div>
                    </div>
                    </div>
                </div>

            <?php $id++; } ?>
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


    <div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4>KPI Manual Submissions</h4>
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
					<th>Month
					</th>
                    <th>
                    Year
                    </th>
                    <th>Area Office[s]</th>
					<th>Date of Submission
                    </th>
                    <th></th>
				</tr>
				</thead>
                <tbody>
                    <?php
                        $query = Database\ORM::table('manual_kpi_entries')->get();
                        if (Database\ORM::getRows($query) > 0)
                        {
                            while ($row = Database\ORM::fetch($query))
                            {
                                // get target name
                                $targetTable = Database\ORM::table('create_targets')->get('targetid = :tid', $row->targetid);
                                $target = Database\ORM::fetch($targetTable);
                                // read json
                                $jsonData = json_decode($row->manual_entry);
                                ?>
                                <tr>
                                    <td><?=$target->target_name?></td>
                                    <td>
                                        <?php
                                        
                                            // get outcomes
                                            $outcomes = mysqli_query($connect, 'select * from performance_outcome where targetid = '.$row->targetid);

                                            // run and generate outcome
                                            if (Database\ORM::getRows($outcomes) > 0)
                                            {
                                                ?>
                                                    <table class="no-grid table">
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
                                                                // merge both outcome id and outcomes
                                                                $newArray = array_combine($jsonData->outcomeid, $jsonData->outcome);

                                                                while ($out = mysqli_fetch_object($outcomes))
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td><?=$sn?>.</td>
                                                                        <td><?=$out->outcome?></td>
                                                                        <td>
                                                                            <?=$newArray[$out->outcomeid]?>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                    // increment
                                                                    $sn += 1; 
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>  
                                                <?php
                                            }
                                        ?>     
                                    </td>
                                    <td><?=ucfirst(date('F', mktime(0,0,0,$row->month,1,$row->year)))?></td>
                                    <td><?=$row->year?></td>
                                    <td><?=count(explode(',', $jsonData->area_offices))?></td>
                                    <td><?=$row->dateadded?></td>
                                    <td>
                                        <a href="?edit=<?=$row->entryid?>&targetid=<?=$row->targetid?>" class="text text-primary"><i class="fa fa-edit"></i> edit</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    ?>
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

<script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

<?php require_once ("../includes/footer.php"); ?>