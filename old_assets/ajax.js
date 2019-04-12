// JavaScript Document
$('#prog_year').change(function() {
	var rep_year = $(this).val();
	get_prog_no(rep_year);
})

function get_prog_no(rep_year){
	$.post('get_prog_no.php', {rep_year:rep_year}, function(data){
	$('#prog_no').html(data);
	});
}
$('#year').change(function() {
	var year = $(this).val();
	get_prog_n(year);
})

$('#syear').change(function() {
	var syear = $(this).val();
	get_prog_no(syear);
})

$('#oyear').change(function() {
	var oyear = $(this).val();
	get_oprog_no(oyear);
})

function get_oprog_no(rep_year){
	$.post('get_prog_no.php', {rep_year:rep_year}, function(data){
	$('#oprog_no').html(data);
	});
}

$('#oprog_no').change(function() {
	var title = $(this).val();
	sub_oprog_no(title);
})

function sub_oprog_no(prog_id){
	$.post('get_sub_prog_no.php', {prog_id:prog_id}, function(data){
	$('#sub_oprog_no').html(data);
	});
}

$('#dep_edit').change(function() {
	var title = $(this).val();
	sub_dept(title);
})

function sub_dept(dept_id){
	$.post('get_dept_name.php', {dept_id:dept_id}, function(data){
	$('#dept_titl').text(data);
	});
}

$('#sub_oprog_no').change(function() {
	var title = $(this).val();
	obj_ono(title);
})

function get_prog_n(year){
	$.post('get_prog_number.php', {year:year}, function(data){
	$('#prog_n').html(data);
	});
}

$('#prog_no').change(function() {
	var title = $(this).val();
	prog_title(title);
	sub_prog_no(title);
	sub_prog_n(title);
})

function prog_title(title){
	$.post('get_prog.php', {id:title}, function(data){
	$('#prog_title').text(data);
	});
}

$('#prog_n').change(function() {
	var title = $(this).val();
	prog_titl(title);
})

function prog_titl(title){
	$.post('get_prog.php', {id:title}, function(data){
	$('#prog_titl').val(data);
	
		if(data == ''){
			$('#subm').removeAttr('disabled', 'disabled');
			$('#edit').attr('disabled', 'disabled');
		} else {
			$('#edit').removeAttr('disabled', 'disabled');
			$('#subm').attr('disabled', 'disabled');
		}
	});
}

$('#sub_prog').change(function() {
	var sub_prog = $(this).val();
	sub_prog_titl(sub_prog);
})

function sub_prog_titl(sub_prog){
	$.post('get_sub_prog.php', {sub_id:sub_prog}, function(data){
	$('#sub_prog_titl').val(data);
	
		if(data == ''){
			$('#subm_sub').removeAttr('disabled', 'disabled');
			$('#edit_sub').attr('disabled', 'disabled');
			$('#add_no').removeClass('notVisible');
		} else {
			$('#edit_sub').removeAttr('disabled', 'disabled');
			$('#subm_sub').attr('disabled', 'disabled');
			$('#add_no').addClass('notVisible');
		}
	});
}



function sub_prog_no(prog_id){
	$.post('get_sub_prog_no.php', {prog_id:prog_id}, function(data){
	$('#sub_prog_no').html(data);
	});
}

function sub_prog_n(prog_id){
	$.post('get_sub_prog_number.php', {prog_id:prog_id}, function(data){
	$('#sub_prog').html(data);														});
}

$('#sub_prog_no').change(function() {
	var sub_prog = $(this).val();
	sub_prog_title(sub_prog);
	obj_no(sub_prog);
	obj_ono(sub_prog);
})

function obj_ono(obj_id){
	$.post('get_obj_number.php', {sub_prog_id:obj_id}, function(data){
	$('#obj_ono').html(data);
	});
}

$('#obj_ono').change(function() {
	var obj = $(this).val();
	obj_tit(obj);
});

function obj_tit(obj){
	$.post('get_obj.php', {obj_id:obj}, function(data){
	$('#obj_t').val(data);
	
		if(data == 0){
			$('#subm_obj').removeAttr('disabled', 'disabled');
			$('#edit_obj').attr('disabled', 'disabled');
			$('#add_obj').removeClass('notVisible');
		} else {
			$('#edit_obj').removeAttr('disabled', 'disabled');
			$('#subm_obj').attr('disabled', 'disabled');
			$('#add_obj').addClass('notVisible');
		}
	});
}

function sub_prog_title(sub_prog){
	$.post('get_sub_prog.php', {sub_id:sub_prog}, function(data){
	$('#sub_prog_title').text(data);
												  });
}

function obj_no(sub_prog_id){
	$.post('get_obj_no.php', {sub_prog_id:sub_prog_id}, function(data){
	$('#obj_no').html(data);
															});
}

$('#obj_no').change(function() {
	var obj_no = $(this).val();
	obj_title(obj_no);
})

function obj_title(obj_no){
	$.post('get_obj.php', {obj_id:obj_no}, function(data){
	$('#obj_title').text(data);
	});
}

$('#office_t').change(function() {
	var office_type = $(this).val();
	office_loc(office_type);
	get_opt(office_type);
})

function office_loc(office_type){
	$.post('get_office_loc.php', {office_type:office_type}, function(data){
	$('#office_loc').html(data);
	});
}

function get_opt(office_type){
	if(office_type == 3){
		$('#opti').removeClass('notVisible');
	} else {
		$('#opti').addClass('notVisible');
		$('#un').addClass('notVisible');
		$('#s_un').addClass('notVisible');
		$('#d_op').removeClass('notVisible');
		$('#di_op').removeClass('notVisible');
		$('#s_op').removeClass('notVisible');
	}
}

$('#optio').change(function() {
	var option = $(this).val();
	if(option == 2){
		$('#un').removeClass('notVisible');
		$('#s_un').removeClass('notVisible');
		$('#d_op').addClass('notVisible');
		$('#di_op').addClass('notVisible');
		$('#s_op').addClass('notVisible');
	} else {
		$('#un').addClass('notVisible');
		$('#s_un').addClass('notVisible');
		$('#d_op').removeClass('notVisible');
		$('#di_op').removeClass('notVisible');
		$('#s_op').removeClass('notVisible');
	}

})

$('#dept').change(function() {
	var dept = $(this).val();
	get_div(dept);
})
$('#dept2').change(function() {
	var dept = $(this).val();
	get_div2(dept);
})
$('#dept1').change(function() {
	var dept = $(this).val();
	get_div1(dept);
})

$('#depts').change(function() {
	var depts = $(this).val();
	get_divd(depts);
})

$('#depm').change(function() {
	var deps = $(this).val();
	get_divs(deps);
})

function get_divd(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#divd').html(data);
	});
}

function get_divs(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#divn').html(data);
	});
}

function get_div(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#div').html(data);
	});
}

function get_div2(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#div2').html(data);
	});
}

function get_div1(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#div1').html(data);
	});
}

$('#divs').change(function() {
	var divs = $(this).val();
	get_sect(divs);
})

$('#div2').change(function() {
	var divs = $(this).val();
	get_sect2(divs);
})

$('#div').change(function() {
	var div = $(this).val();
	get_sect(div);
})

$('#divn').change(function() {
	var div = $(this).val();
	get_secti(div);
})

function get_secti(div){
	$.post('get_section.php', {div:div}, function(data){
	$('#secti').html(data);
	});
}

function get_sect2(div){
	$.post('get_section.php', {div:div}, function(data){
	$('#sect2').html(data);
	});
}

function get_sect(div){
	$.post('get_section.php', {div:div}, function(data){
	$('#sect').html(data);
	});
}

$('#unit').change(function() {
	var un = $(this).val();
	get_sub_unit(un);
})

function get_sub_unit(unit_id){
	$.post('get_sub_unit.php', {unit_id:unit_id}, function(data){
	$('#sub_unit').html(data);
	});
}
