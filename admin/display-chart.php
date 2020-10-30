<?php
require_once("../includes/header.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
<script src="../assets/js/chartjslabels.js"></script>

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
        
        
		?>
    </div>

	<div id="query_opt" class="card shadow">
        <div class="card-header">
            <h4><a href="#" onclick="history.back()" style="color:#e14536;"><i class="fa fa-arrow-left"></i></a> &nbsp; Analytics </h4>
        </div>

        <div class="json-config" style="display: none"><?=json_encode($_POST)?></div>

        <div class="card-body">
        	<div class="text-center">
        		<h1 class="w1-end text-center report-table-title"> <?=date('Y')?> END OF YEAR PERFORMANCE REVIEW MEETING </h1> 
        	</div>
        	<canvas id="bar-chart-grouped" width="800" height="450"></canvas>
        </div>


        <script type="text/javascript">
        	var config = document.querySelector('.json-config');
        	config = JSON.parse(config.innerText.trim());
        	//data = JSON.parse();
        	var parse = config.json_data.replace(/[`]/g,'"').trim();

        	var data = JSON.parse(parse);

        	
        	var outcomes = [], datasets = [];

        	var achieved = Object.keys(data[0].achieved);

        	var obj1 = Object.create(null);
        	var obj2 = Object.create(null);

        	obj1.label = achieved[0] + ' % Achieved';
        	obj1.backgroundColor = "#C0504D";
        	obj2.label = achieved[1] + ' % Achieved';
        	obj2.backgroundColor = "#4F81BD";

        	var getdata = Object.create(null);
        	getdata[achieved[0]] = [];
        	getdata[achieved[1]] = [];

        	for (var x in data)
        	{
        		outcomes.push(data[x].outcome);

        		for (var year in data[x].achieved)
        		{
        			getdata[year].push(data[x].achieved[year]);
        		}

        	}

        	obj1.data = getdata[achieved[0]];
        	obj2.data = getdata[achieved[1]];

        	datasets.push(obj1);
        	datasets.push(obj2);

        	new Chart(document.getElementById("bar-chart-grouped"), {
		    type: 'bar',
		    data: {
		      labels: outcomes,
		      datasets: datasets
		    },
		    options: {
		      title: {
		        display: true,
		        text: config.display_title,
		        lineHeight : '1.7',
		        fontSize : 24,
		        fontStyle : 'normal',
		        fontColor : '#000',
		        fontFamily : 'Nunito,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"'
		      },
		      legend: {
		            display: true,
		            position : 'bottom'
		      },
		      tooltips: {
			        enabled: true
			  },
		      datalabels: {
	            color: '#000'
		      },
		      plugins: {
		          labels: {
		            render: function (args) {
				      return args.value + '%';
				    }
		          }
		      }
		    }

		});

        </script>

   	</div>

 </div>
 <?php require_once ("../includes/footer.php"); ?>