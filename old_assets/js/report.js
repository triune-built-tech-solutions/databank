// JavaScript Document
$('#prog_no').change(function() {
	var title = $(this).val();
	prog_title(title);
	sub_prog_no(title);
})

function prog_title(title){
	$.post('get_prog.php', {id:title}, function(data){
	$('#prog_title').text(data);
												  });
}

function sub_prog_no(prog_id){
	$.post('get_sub_prog_no.php', {prog_id:prog_id}, function(data){
	$('#sub_prog_no').html(data);
															});
}

$('#sub_prog_no').change(function() {
	var sub_prog = $(this).val();
	sub_prog_title(sub_prog);
	obj_no(sub_prog);
})

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