// JavaScript Document
$('#deptsr').change(function() {
	var depts = $(this).val();
	get_divd(depts);
})

function get_divd(dept){
	$.post('get_divisionr.php', {dept:dept}, function(data){
	$('#divdr').html(data);
	});
}

$('#depmr').change(function() {
	var deps = $(this).val();
	get_divs(deps);
})

function get_divs(dept){
	$.post('get_division.php', {dept:dept}, function(data){
	$('#divnr').html(data);
	});
}

$('#divnr').change(function() {
	var div = $(this).val();
	get_secti(div);
})

function get_secti(div){
	$.post('get_sectionr.php', {div:div}, function(data){
	$('#sectir').html(data);
	});
}

$('#unitr').change(function() {
	var un = $(this).val();
	get_sub_unit(un);
})

function get_sub_unit(unit_id){
	$.post('get_sub_unitr.php', {unit_id:unit_id}, function(data){
	$('#sub_unitr').html(data);
	});
}

