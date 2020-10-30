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
        $target = new Target\Create(false);

        // send message output
        Screen\Response::getMessage($statusMsgClass, $statusMsg);
        
        $target->allOffices($target_name, $offices, $tid, $alloutcomes);
        $outcomes = $target->getPerformanceOutcomes();

        $json = null;

        if (count($outcomes) > 0)
        {
        	$json = preg_replace('/["]/',"'",json_encode($outcomes));
        }

		?>

		<div data-outcomes="<?=$json?>" style="display: none;"></div>

		<div id="query_opt" class="card shadow">
            <div class="card-header">
                <h4><a href="performance_indicator.php"><i class="fa fa-arrow-left text-danger"></i></a> <?=$target_name?></h4>
            </div>
            
            <form class="card-body" action="" method="post" name="report_query">
                <?php if (!empty($statusMsg)) {
                    echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
                } ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <tbody class="form-table">
                        <tr>
                            <td>Outcome</td>
                            <td>
                                <div class="wrapper row-gap10">

                                    <?php
                                        // list outcomes
                                        if (count($alloutcomes) > 0)
                                        {
                                            foreach ($alloutcomes as $index => $obj)
                                            {
                                                ?>
                                                    <div class="w1-18 wrapper column-gap10">
                                                        <div class="w1-12">
                                                            <input type="text" name="outcome[]" class="form-control" placeholder="Performance Outcome" value="<?=$obj->outcome?>" readonly/>
                                                        </div>
                                                        <div class="w12-18">
                                                            <input type="text" name="outcome_period[]" class="form-control" placeholder="Annual Target" value="<?=$obj->outcome_period?>" data-input-target="<?=$obj->outcome?>"/>
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
                                $_offices = [];

                                while ($r = mysqli_fetch_array($q)) {
                                    $_offices[$r['area_office_name']] = $r['id'];
                                }

                                $json = preg_replace('/["]/',"'",json_encode($_offices));

                                ?>
                                <input type="hidden" name="area_offices" value="<?=$area_offices?>" data-offices="<?=$json?>" data-autoselect='false' data-trigger="watchClick" required/>
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
                            <td><input type="submit" name="update-target" value="Update" class="btn btn-success"></td>
                        </tr>
                        <tbody>
                    </table>
                </div>

            </form>
        </div>
<style>
	.menu-list{
		border-radius: 5px;
		border: 2px red;
	}
	.hide-toggle{display:none;}
	.list-modal{display:none; z-index:20; position:fixed; background:rgb(248, 249, 252); padding:15px;
	max-height:90%; overflow:scroll; box-shadow:0px 0px 10px rgba(0,0,0,0.1); border-bottom-right-radius:50px;
	opacity:0; transition:opacity 0.7s ease-in-out;}
	.menu-bar-list{display:grid; grid-template-columns:repeat(4, 1fr); grid-gap:30px; }
	.menu-bar-list .menu-list{height:50px; background:#fff; box-shadow: 0px 10px 10px rgba(0,0,0,0.1);
	transition:all 0.5s ease-in-out; display: flex;padding: 10px;flex-direction: column;}
	.menu-list .header{display: flex;align-items: center;justify-content: space-between;width: 100%;}
	.menu-list .header h1{font-size:16px; margin:0px; padding:0px;}
	.menu-bar-list .menu-list:hover{cursor:pointer; box-shadow: 0px 0px 10px rgba(0,0,0,0.1);}
	.header .arrow{width:30px; height:30px; display:flex; justify-content:center; align-items:center;
	background:#e44738; border-radius:50%; align-self:flex-end; color:#fff;
	transform:rotate(0deg); transition:transform 0.5s ease-in-out;}
	.arrow.rotate-arrow{transform:rotate(180deg); transition:transform 0.5s ease-in-out;}


	/* body */
	.menu-bar-list .body{border-top:1px solid rgba(0,0,0,0.05); margin-top:7px; padding-top:15px;
	display:none; height:0%; overflow:hidden; opacity:0; transition: height 0.5s ease-in-out, opacity 0.5s ease-in-out;
	align-self:center; width: 100%;}
	.body.toggleShow{height:100%; opacity:1; transition: height 0.5s ease-in-out, opacity 0.5s ease-in-out;}
	.menu-bar-list .body ul{list-style:none; padding:0px; margin:0px;}
	.menu-bar-list .body ul li{padding:0px; line-height:26px;}
	.menu-bar-list .body ul li a{color:#e34738; font-size:14px;}

	.menu-list-toggle{position:fixed; bottom:76px; right:3%; z-index:30;}
	.menu-list-toggle .toggle-btn{height:60px; width:60px; border-radius:50%; background:#e14435; display:flex;
	justify-content:center; align-items:center; box-shadow:-5px 10px 10px rgba(0,0,0,0.1); transition:all 0.5s ease-in-out;}
	.menu-list-toggle .toggle-btn:hover{box-shadow:-5px 10px 10px rgba(0,0,0,0.3); cursor:pointer;}
	.toggle-btn .fa{color:#fff; font-size:20px;}

</style>
	
	<script type="text/javascript">
		var outcomes = document.querySelector('*[data-outcomes]');
		outcomes = outcomes.getAttribute('data-outcomes');
		outcomes = outcomes.replace(/[']/g, '"');

		if (outcomes.length > 3)
		{
			outcomes = JSON.parse(outcomes);
		}

		var original = [];

		var period = document.querySelectorAll('*[name="outcome_period[]"]');

		[].forEach.call(period, function(e){
			var inpt = e.getAttribute('data-input-target');
			var obj = Object.create(null);
			obj[inpt] = e.value;
			original.push(obj);	
		});

    	function watchClick(option, id)
    	{
    		switch (option)
    		{
    			case 'clicked':
    				clickOption(id);
    			break;

    			case 'unclicked':
    				original.map(function(e){
    					var keys = Object.keys(e);
    					var key = keys[0];
    					var query = '*[data-input-target="'+key+'"]';
    					var input = document.querySelector(query);
    					input.value = e[key];
    				});
    				// find selected
    				var selected = document.querySelector('.form-table .select-wrapper .select-list .select.selected');
    				if (selected != null)
    				{
    					var id = selected.getAttribute('data-id');
    					clickOption(id);
    				}
    			break;
    		}
    	}

    	function clickOption(id)
    	{
    		if (outcomes != '' && (typeof outcomes[id] !== undefined))
			{
				var data = outcomes[id];
				if (typeof data == 'object')
				{
					data.outcome.map(function(e,x){
						var query = '*[data-input-target="'+e+'"]';
						var input = document.querySelector(query);
						if (input != null)
						{
							input.value = data.outcome_period[x];
						}
					});
				}
			}
    	}
    </script>

    <script type="text/javascript" src="../assets/js/itf_wekiwork.js"></script>

    <?php if (!$target->get->has('office')) :?>
    <div id="show_rep" class="mt-5 card shadow">
		<div class="card-header">
			<h4>Area Offices</h4>
		</div>
		<div class="card-body">

			<div class="accordion" id="accordionExample">
				<?php

                foreach ($offices as $id => $name)
                {
                    ?>
                    <div class="card">
                    <div class="card-header" id="heading<?=$id?>" data-toggle="collapse" data-target="#collapse<?=$id?>" aria-expanded="false" aria-controls="collapse<?=$id?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button">
                            <?=ucwords($name)?>
                        </button>
                    </h5>
                    </div>
                    <div id="collapse<?=$id?>" class="collapse" aria-labelledby="heading<?=$id?>" data-parent="#accordionExample">
                    <div class="card-body">
                    <div class="table-responsive">
                    	<table class="table table-bordered table-hover table-striped" id="dataTable" width="100%" cellspacing="0">
                        <tbody>
                        <tr>
                            <td>Outcomes</td>
                            <td>
                            	<table class="table">
	                                <tr>
	                                    <th> Outcome </th>
	                                    <th> Target </th>
	                                    <th> Achieved </th>
	                                    <th> Score </th>
	                                </tr>
	                                	<?php

	                                		if (isset($outcomes[$id]))
	                                		{
	                                			foreach ($outcomes[$id]['outcome'] as $x => $outcome)
	                                			{
	                                				?>
	                                				<tr>
	                                					<td><?=$outcome?></td>
	                                					<td><?=$outcomes[$id]['outcome_period'][$x]?></td>
	                                					<td>0</td>
	                                					<td>0</td>
	                                				</tr>
	                                				<?php
	                                			}
	                                		}
	                                		else
	                                		{
	                                			foreach ($outcomes['default']['outcome'] as $x => $outcome)
	                                			{
	                                				?>
	                                				<tr>
	                                					<td><?=$outcome?></td>
	                                					<td><?=$outcomes['default']['outcome_period'][$x]?></td>
	                                					<td>0</td>
	                                					<td>0</td>
	                                				</tr>
	                                				<?php
	                                			}
	                                		}

	                                	?>
	                            </table>
                            </td>
                        </tr>
	                    </tbody>
	                    </table>
                    </div>
                    </div>
                    </div>
	                </div>
                    <?php
                }
            ?>
			</div>
		</div>
	</div>
    <?php else : ?>
    <div id="show_rep" class="mt-5 card shadow">
        <?php 
            $id = $target->get->id;
            $office = $target->get->office;
            $outcomes = $target->getPerformanceOutcomes();
        ?>
        <?php if (!empty($statusMsg)) {
            echo '<div class="alert ' . $statusMsgClass . '">' . $statusMsg . '</div>';
        } ?>
		<div class="card-header">
			<h4><a href="manage_targets.php?id=<?=$id?>"><i class="fa fa-arrow-left text-danger"></i></a> Outcomes for <?=$office?></h4>
		</div>
		<div class="card-body">
            <p class="text-info">* Set outcome target for this area office.</p>
            <form action="" method="post">
                <?php foreach ($outcomes as $i => $row) : ?>
                    <section class="form-group">
                        <label><?=ucwords($row->outcome)?></label>
                        <input type="number" value="<?=$row->outcome_period?>" name="<?=$row->outcome?>" class="form-control"/>
                    </section>
                <?php endforeach; ?>
                <button type="submit" name="update-target" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
    <?php endif; ?>

	</div>


    <div id="divi">

</div><br/>

<?php require_once ("../includes/footer.php"); ?>