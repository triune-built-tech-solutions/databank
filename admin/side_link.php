<?php
$links = '
<td class="side_link" bgcolor="#A80203"><span style="font-size:14px; font-weight:bold; line-height:23px; margin:10px 3px;">
<dl>
<dt class="subject"><a class="white" href="#"> Staff Information</a></dt>
   	<dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="staff_info.php">Add Report </a><br />
	<a href="edit_staff_info.php">Edit Report </a><br />
	<!--<a href="upload_staff_info.php">Upload Report </a><br />
	<a href="view_staff_info_file.php">View Report File </a><br />-->

	';
	}
	$links .= '<a href="view_staff_info.php">View Report </a><br />
	<!--a href="total_staff_info.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="Training Needs Assessment"> Training Needs...</a></dt>
   	<dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="training_needs.php">Add Report </a><br />
	<a href="edit_training_needs.php">Edit Report </a><br />
	<!--<a href="upload_training_needs.php">Upload Report </a><br />-->

	';
	}
	$links .= '<a href="view_training_needs.php">View Report </a><br />
	<!--a href="total_training_needs.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Scheduled Training</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="scheduled_training.php">Add Report </a><br />
	<a href="edit_scheduled_training.php">Edit Report </a><br />
	
	<a href="add_scheduled_facil.php">Add Facilitator </a><br />
	<!--<a href="upload_scheduled_training.php">Upload Report </a><br />-->
	';
	}

	$links .= '<a href="view_scheduled_training.php">View Report </a><br />
	<a href="each_participant.php">View Participant </a><br />
	<a href="view_facil.php">View Facilitator </a><br />
	<!--a href="total_scheduled_training.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Unscheduled Training</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="unscheduled_training.php">Add Report </a><br />
    <a href="edit_unscheduled_training.php">Edit Report </a><br />
	
	<a href="add_unscheduled_facil.php">Add Facilitator </a><br />
	<!--<a href="upload_unscheduled_training.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_unscheduled_training.php">View Report </a><br />
	<a href="each_un_participant.php">View Participant </a><br />
	<a href="view_unfacil.php">View Facilitator </a><br />
	<!--a href="total_unscheduled_training.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="New Training Package Developed and Test-run"> New Training Package...</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="new_training.php">Add Report </a><br />
	<a href="edit_new_training.php">Edit Report </a><br />
	<!--<a href="upload_new_training.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_new_training.php">View Report </a><br />
	<!--a href="total_new_training.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title"Process & Productivity Improvement Programme"> PPIT</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="peit.php">Add Report </a><br />
	<a href="edit_peit.php">Edit Report </a><br />
	<!--<a href="upload_peit.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_peit.php">View Report </a><br />
	<!--a href="total_peit.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Apprenticeship </a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="industrial_training.php">Add Report </a><br />
	<a href="edit_industrial_training.php">Edit Report </a><br />
	<a href="add_apprenticeship.php">Add Company Details </a><br />
	<!--<a href="upload_industrial_training.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_industrial_training.php">View Report </a><br />
	<a href="view_apprenticeship.php">View Company Details </a><br />
	<!--a href="total_industrial_training.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Course Approval</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="course_approval.php">Add Report </a><br />
	<a href="edit_course_approval.php">Edit Report </a><br />
	<!--<a href="upload_course_approval.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_course_approval.php">View Report </a><br />
	<!--a href="total_course_approval.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> In-Company Safety</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="in-company.php">Add Report </a><br />
	<a href="edit_in-company.php">Edit Report </a><br />
	<a href="add_in_comp.php">Add Company Detail </a><br />
	<a href="add_in_part.php">Add Participant Detail </a><br />
	<a href="add_in_facilitator.php">Add Facilitator Detail</a><br />
	<!--<a href="upload_in-company.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_in-company.php">View Report </a><br />
	<!--a href="total_in-company.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Siwes Matters</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="siwes_matters.php">Add Report </a><br />
	<a href="edit_siwes_matters.php">Edit Report </a><br />
	<!--<a href="upload_siwes_matters.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_siwes_matters.php">View Report </a><br />
	<!--a href="total_siwes_matters.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Reimbursement</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="reimbursement.php">Add Report </a><br />
	<a href="edit_reimbursement.php">Edit Report </a><br />
	<a href="add_comp_reimburse.php">Add Company Details </a><br />
	<!--<a href="upload_reimbursement.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_reimbursement.php">View Report </a><br />
	<a href="view_comp_reimburse.php">View Company Details</a><br />
	<!--a href="total_reimbursement.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Employers Statistics</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="emp_stat.php">Add Report </a><br />
	<a href="edit_emp_stat.php">Edit Report </a><br />
	<a href="add_defaulter.php">Add Defaulter Detail </a><br />
	<!--<a href="upload_emp_stat.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_emp_stat.php">View Report </a><br />
	<!--a href="total_emp_stat.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Training Contribution</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="training_contribution.php">Add Report </a><br />
	<a href="edit_training_contribution.php">Edit Report </a><br />
	<a href="add_comp_cont.php">Add Company Details </a><br />
	<!--<a href="upload_training_contribution.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_training_contribution.php">View Report </a><br />
	<a href="view_company_cont.php">View Company Details </a><br />
	<!--a href="total_training_contribution.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="Verification of Company Accounts"> Verification of Company...</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="verification_of_acct.php">Add Report </a><br />
	<a href="edit_verification_of_acct.php">Edit Report </a><br />
	<a href="add_comp_verd.php">Add Comp Details </a><br />
	<!--<a href="upload_verification_of_acct.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_verification_of_acct.php">View Report </a><br />
	<!--a href="total_verification_of_acct.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Revenue From Course</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="revenue_gen.php">Add Report </a><br />
	<a href="edit_revenue_gen.php">Edit Report </a><br />
	<!--<a href="upload_revenue_gen.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_revenue_gen.php">View Report </a><br />
	<!--a href="total_revenue_gen.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="Outstanding Course Fee from Previous Years"> Outstanding Course...</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="outstanding_course.php">Add Report </a><br />
	<a href="edit_outstanding_course.php">Edit Report </a><br />
	<a href="add_comp_outstanding.php">Add Comp Details </a><br />
	<!--<a href="upload_outstanding_course.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_outstanding_course.php">View Report </a><br />
	<a href="view_comp_outstanding.php">View Company Details </a><br />
	<!--a href="total_outstanding_course.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="Other Income Generated"> Other Income...</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="other_income.php">Add Report </a><br />
	<a href="edit_other_income.php">Edit Report </a><br />
	<!--<a href="upload_other_income.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_other_income.php">View Report </a><br />
	<!--a href="total_other_income.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> ITF Flagship Programme</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="nisdp_participant.php">Add Trainee </a><br />
	<!--a href="edit_nisdp_participant.php">Edit Trainee </a><br /-->
	<a href="add_nisdp_craftmen.php">Add Mastercraftmen </a><br />
	<!--<a href="upload_nisdp_participant.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_nisdp.php">View Report </a><br />
	<a href="view_craftsman.php">View Mastercraftmen </a>
	<!--a href="total_other_income.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> ITF-NECA Programme</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="tsdp_participant.php">Add Trainee </a><br />
	<!--a href="edit_tsdp_participant.php">Edit Trainee </a><br /-->
	<a href="add_tsdp_craftmen.php">Add Mastercraftmen </a><br />
	<!--<a href="upload_tsdp_participant.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_tsdp.php">View Report </a><br />
	<!--a href="total_other_income.php">Summary </a-->
	</dd>
<dt><a class="white" href="#"> Collaborations</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="itf_collaboration.php">Add Trainee </a><br />
	<!--a href="edit_itf_collaboration.php">Edit Trainee </a><br / -->
	<a href="add_itf_collaborator.php">Add Collaborators </a><br />
	<!--<a href="upload_itf_collaboration.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_itf_collaboration.php">View Report </a><br />
	<!--a href="total_itf_collaboration.php">Summary </a-->
	</dd>
<dt><a class="white" href="#" title="Entrepreneurship Development Programme"> Entrepreneurship Dev...</a></dt>
    <dd>';
	if($access_right !== '1' && $access_right !== '3'){
	$links .= '<a href="entrepreneurship.php">Add Report </a><br />
	<!--a href="edit_entrepreneurship.php">Edit Report </a><br / -->
	<a href="add_entre_part.php">Add Participant Detail </a><br />
	<a href="add_entre_facilitator.php">Add Facilitator Detail</a><br />
	<!--<a href="upload_entrepreneurship.php">Upload Report </a><br />-->';
	}
	$links .= '<a href="view_entrepreneurship.php">View Report </a><br />
	<!--a href="total_entrepreneurship.php">Summary </a-->
	</dd>
</dl>
</span></td>';

echo $links;
?>