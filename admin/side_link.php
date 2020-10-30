<?php

$self = $_SERVER['PHP_SELF'];
$file = basename($self);

$type = ($file != 'arearep.php') ? 'list-modal' : '';
$btnType = ($file != 'arearep.php') ? 'show-toggle' : 'hide-toggle';

$accessRight = [
	['staff_info.php' => 'Add Report',
	 'edit_staff_info.php' => 'Edit Report'],
	['training_needs.php' => 'Add Report',
	'edit_training_needs.php' => 'Edit Report'],
	['scheduled_training.php' => 'Add Report',
	'edit_scheduled_training.php' => 'Edit Report',
	'add_scheduled_facil.php' => 'Add Facilitator'],
	['new_training.php' => 'Add Report',
	'edit_new_training.php' => 'Edit Report'],
	['peit.php' => 'Add Report',
	'edit_peit.php' => 'Edit Report'],
	['industrial_training.php' => 'Add Report',
	'edit_industrial_training.php' => 'Edit Report',
	'add_apprenticeship.php' => 'Add Company Details'],
	['course_approval.php' => 'Add Report',
	'edit_course_approval.php' => 'Edit Report'],
	['in-company.php' => 'Add Report',
	'edit_in-company.php' => 'Edit Report',
	'add_in_comp.php' => 'Add Company Detail',
	'add_in_part.php' => 'Add Participant Detail',
	'add_in_facilitator.php' => 'Add Facilitator Detail'],
	['siwes_matters.php' => 'Add Report',
	'edit_siwes_matters.php' => 'Edit Report'],
	['reimbursement.php' => 'Add Report',
	'edit_reimbursement.php' => 'Edit Report',
	'add_comp_reimburse.php' => 'Add Company Details'],
	['emp_stat.php' => 'Add Report',	
	'edit_emp_stat.php' => 'Edit Report',
	'add_defaulter.php' => 'Add Defaulter Detail'],
	['training_contribution.php' => 'Add Report',
	'edit_training_contribution.php' => 'Edit Report',
	'add_comp_cont.php' => 'Add Company Details'],
	['verification_of_acct.php' => 'Add Report',
	'edit_verification_of_acct.php' => 'Edit Report',
	'add_comp_verd.php' => 'Add Comp Details'],
	['revenue_gen.php' => 'Add Report',
	'edit_revenue_gen.php' => 'Edit Report'],
	['outstanding_course.php' => 'Add Report',
	'edit_outstanding_course.php' => 'Edit Report',
	'add_comp_outstanding.php' => 'Add Comp Details'],
	['other_income.php' => 'Add Report',
	'edit_other_income.php' => 'Edit Report'],
	['nisdp_participant.php' => 'Add Trainee',
	'add_nisdp_craftmen.php' => 'Add Mastercraftmen'],
	['tsdp_participant.php' => 'Add Trainee',
	'add_tsdp_craftmen.php' => 'Add Mastercraftmen'],
	['itf_collaboration.php' => 'Add Trainee',
	'add_itf_collaborator.php' => 'Add Collaborators'],
	['entrepreneurship.php' => 'Add Report',
	'add_entre_part.php' => 'Add Participant Detail',
	'add_entre_facilitator.php' => 'Add Facilitator Detail']
];

function accesslinks($access_right, &$accessRight)
{
	static $id = 0;

	if($access_right !== '1' && $access_right !== '3' && isset($accessRight[$id]))
	{
		foreach ($accessRight[$id] as $href => $title)
		{
			$links[] = '<li> <a href="'.$href.'"> '.$title.' </a> </li>'.PHP_EOL;
		}
	}

	$id++;

	return implode("\n", $links);
}
?>

<section class="<?=$type?>">
	<section class="menu-bar-list">
		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Staff Information </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_staff_info.php">View Report </a></li>
				</ul>
			</span>
		</div>
		
		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Training Needs </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_training_needs.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Scheduled Training </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_scheduled_training.php">View Report </a></li>
					<li><a href="each_participant.php">View Participant </a></li>
					<li><a href="view_facil.php">View Facilitator </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Unscheduled Training </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_unscheduled_training.php">View Report </a></li>
					<li><a href="each_un_participant.php">View Participant </a></li>
					<li><a href="view_unfacil.php">View Facilitator </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> New Training Package </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_new_training.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> PPIT </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_peit.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Apprenticeship </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_industrial_training.php">View Report </a></li>
					<li><a href="view_apprenticeship.php">View Company Details </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Course Approval </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_course_approval.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> In-Company Safety </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_in-company.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> SIWES Matters </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_siwes_matters.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Reimbursement </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_reimbursement.php">View Report </a></li>
					<li><a href="view_comp_reimburse.php">View Company Details</a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Employers Statistics </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_emp_stat.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Training Contribution </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_training_contribution.php">View Report </a></li>
					<li><a href="view_company_cont.php">View Company Details </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Verification of Company </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_verification_of_acct.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Revenue From Course </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_revenue_gen.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Outstanding Course </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_outstanding_course.php">View Report </a></li>
					<li><a href="view_comp_outstanding.php">View Company Details </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Other Income </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_other_income.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> ITF Flagship Programme </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_nisdp.php">View Report </a></li>
					<li><a href="view_craftsman.php">View Mastercraftmen </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title">ITF-NECA Programme</h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_tsdp.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Collaborations </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_itf_collaboration.php">View Report </a></li>
				</ul>
			</span>
		</div>

		<div class="menu-list">
			<span class="header dropdown">
				<h1 class="title"> Entrepreneurship Dev </h1>
				<span class="arrow"><i class="fa fa-caret-down"></i></span>
			</span>
			<span class="body">
				<ul>
					<?=accesslinks($access_right, $accessRight)?>
					<li><a href="view_entrepreneurship.php">View Report </a></li>
				</ul>
			</span>
		</div>
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