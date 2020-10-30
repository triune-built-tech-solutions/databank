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
        
		?>
    </div>

    <div id="query_opt" class="card shadow">
        <div class="card-header">
            <h4><a href="#" onclick="history.back()" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; Generate Analytics </h4>
        </div>

        <?php $target->canShow($_GET['id']); $view = $target->getInfo(); ?>

        <div class="card-body">
    		<form action="display-chart.php" method="post">
    			<div class="form-group">
    				<label>Display Format</label>
    				<div class="row display-format">
    					<div class="col-lg-3 active">
    						<img src="../assets/img/graph1.png" class="img-responsive">
    					</div>

    					<div class="col-lg-3">
    						<img src="../assets/img/graph2.png" class="img-responsive">
    					</div>

    					<div class="col-lg-3">
    						<img src="../assets/img/graph3.png" class="img-responsive">
    					</div>

    					<div class="col-lg-3">
    						<img src="../assets/img/graph4.png" class="img-responsive">
    					</div>
    				</div>
    			</div>

    			<input type="hidden" name="display_format" value="1">
    			<input type="hidden" name="targetid" value="<?=$_GET['id']?>">

    			<div class="form-group">
    				<label>Display Title</label>
    				<input type="text" name="display_title" class="form-control" placeholder="Display title for chart." value="<?=$view->target_name?>">
    			</div>

    			<!-- list outcomes -->
                    <?php 

                    $json = [];

                    $json = $target->getOutcomes(function($row)
                    {
                    	$json = [];

                        // last year
                        $lastYear = intval(date('Y'))-1;
                        $currentYear = intval(date('Y'));

                        $json['outcome'] = ucwords($row->outcome);
                        $json['achieved'][$lastYear] = $row->achieved[$lastYear];
                        $json['achieved'][$currentYear] = $row->achieved[$currentYear];

                        // return row
                        return $json;

                    }, $_GET['id']);

                    $json = json_encode($json);
                    $json = str_replace('"', "`", $json);

                    ?>

                 <textarea name="json_data" style="display: none"><?=$json?></textarea>

    			<button class="btn btn-success" type="submit" name="create-chart">Create</button>
    		</form>
        </div>

        </div>


</div><!-- close content -->

<script type="text/javascript">
	var format = document.querySelector('[name="display_format"]'),
	list = document.querySelectorAll('.display-format > div');

	[].forEach.call(list, function(e,i){
		e.addEventListener('click', function(){
			uncheckAll();
			e.classList.add('active');
			format.value = (i+1);
		});
	});

	function uncheckAll()
	{
		[].forEach.call(list, function(e){
			e.classList.remove('active');
		});
	}
</script>

<?php require_once ("../includes/footer.php"); ?>