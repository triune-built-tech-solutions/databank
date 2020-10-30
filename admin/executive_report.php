<?php
require_once("../includes/header.php");

require_once("../functions/function.php");
?>

	<div id="content"><!-- open content -->
		<style type="text/css">
			#staff_inf input {
				padding: 3px;
				color: #949494;
				font-family: Arial, Verdana, Helvetica, sans-serif;
				font-size: 13px;
				border: 1px solid #cecece;
			}

			#staff_inf input.none {
				background: #9FF;
				color: #666;
				font-family: Tahoma, Geneva, sans-serif;
				font-size: 15px;
			}

			#staff_inf input.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#staff_inf select.error {
				background: #f8dbdb;
				border-color: #e77776;
			}

			#staff_inf p {
				margin-bottom: 15px;
			}

			#staff_inf p span {
				margin-left: 10px;
				color: #b1b1b1;
				font-size: 11px;
				font-style: italic;
			}

			#staff_inf p span.error {
				color: #e46c6e;
			}

			#staff_inf #send {
				background: #6f9ff1;
				color: #fff;
				font-weight: 700;
				font-style: normal;
				border: 0;
				cursor: pointer;
			}

			#staff_inf #send:hover {
				background: #79a7f1;
			}

			#error {
				margin-bottom: 20px;
				border: 1px solid #efefef;
			}
		</style>
		<div id="depart">
			<?php
			if (isset($department)) {
				$query_dept = "SELECT * FROM department where id = $department";
				$result_dept = mysqli_query($connect, $query_dept);

				while ($row_dept = mysqli_fetch_array($result_dept)) {
					$department = $row_dept[1];
					echo "<p><span style='color:#A80203; font-size:13px; font-weight:bold;'> DEPARTMENT:</span> " . $row_dept[1] . ".&nbsp;&nbsp;&nbsp;";
				}
			} else {
				$query_unit = "SELECT * FROM unit where id = $unit";
				$result_unit = mysqli_query($connect, $query_unit);

				while ($row_unit = mysqli_fetch_array($result_unit)) {
					$department = $row_unit[1];
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

		<?php

$self = $_SERVER['PHP_SELF'];
$file = basename($self);

$type = ($file != 'executive_report.php') ? 'list-modal' : '';
$btnType = ($file != 'executive_report.php') ? 'show-toggle' : 'hide-toggle';


function accesslinks($access_right, $eid)
{
	$links = [];

	if($access_right !== '1' || $access_right !== '3')
	{
		$links[] = '<li><a href="manage_report.php?id='.$eid.'">Manage report</a></li>'.PHP_EOL;
	}

	return implode("\n", $links);
}

	// process builder
    $builder = new Builder\Engine();

?>

<section class="<?=$type?>">
	<section class="menu-bar-list">
		<?php $forms = $builder->formsForTarget();?>
		<?php
		foreach ($forms as $index => $row) { 
        $exp = array_flip(explode(',', $row->submits_by));

        if (!isset($exp[Target\Office::$location]))
        { 
        ?>
        	<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> <?=$row->form_name?> </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $row->entryid)?>
					<?php if ($builder->hasReport($row->entryid)) : ?>
						<li><a href="view_form_report.php?id=<?=$row->entryid?>">View Report </a></li>
					<?php endif; ?>
				</ul>
			</span>
			</div>

        <?php
    	}}
        ?>
		
	</section>
</section>

<div class="menu-list-toggle <?=$btnType?>">
	<div class="toggle-btn"><i class="fa fa-grip-horizontal"></i> </div>
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

<script>

	let dropdownsTitle = document.querySelectorAll('.header.dropdown');
	let menutoggle = document.querySelector('.menu-list-toggle');

	if (dropdownsTitle.length > 0)
	{
		[].forEach.call(dropdownsTitle, (d)=>{
			d.addEventListener('click', showDropdownBody);
		});

		function showDropdownBody()
		{
			// get arrow
			const arrow = this.querySelector('.arrow');
			const body = this.parentNode.querySelector('.body');
			const list = this.parentNode;

			if (!arrow.hasAttribute('data-clicked'))
			{
				// show
				arrow.setAttribute('data-clicked', true);
				arrow.classList.add('rotate-arrow');
				body.style.display = 'block';
				list.style.height =  '200px';

				setTimeout(()=>{
					body.style.opacity = 1;
					body.classList.add('toggleShow');
				},100);
			}
			else
			{
				// hide
				arrow.removeAttribute('data-clicked');
				arrow.classList.remove("rotate-arrow");
				list.style.height = '50px';
				body.style.opacity = 0;
				setTimeout(()=>{
					body.classList.remove('toggleShow');
				},500);
			}
		}	
	}

	if (menutoggle != null)
	{
		const fa = menutoggle.querySelector('.fa');
		const listModal = document.querySelector('.list-modal');

		menutoggle.addEventListener('click', ()=>{
			if (!menutoggle.hasAttribute('data-clicked'))
			{
				listModal.style.display = 'block';
				setTimeout(()=>{
					listModal.style.opacity = 1;
					menutoggle.setAttribute('data-clicked', true);
					fa.classList.add('fa-minus')
					fa.classList.remove('fa-grip-horizontal');
				},100);
			}
			else
			{
				listModal.style.opacity = 0;
				setTimeout(()=>{
					listModal.style.display = 'none';
					menutoggle.removeAttribute('data-clicked');
					fa.classList.add('fa-grip-horizontal')
					fa.classList.remove('fa-minus');
				},400);
			}
		});
	}

</script>
		

	</div><!-- close content -->
	<div id="divi">
		&nbsp;
	</div><br/>

<?php require_once("../includes/footer.php"); ?>