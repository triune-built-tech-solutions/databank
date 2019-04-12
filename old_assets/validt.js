// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#rep");
	var rep_type = $("#rep_type");
	var rep_m = $("#rep_m");
	var rep_y = $("#prog_year");
	var ann_targ = $("#ann_targ");
	var month_f = $("#month_f");
	var month_t = $("#month_t");
	var prog_no = $("#prog_no");
	var sub_prog_no = $("#sub_prog_no");
	var obj_no = $("#obj_no");
	var act = $("#act");
	var arch = $("#arch");
	var cons = $("#cons");
	
	rep_type.change(validateRepType);
	rep_m.change(validateRepM);
	rep_y.change(validateRepY);
	ann_targ.change(validateAnnTarg);
	month_f.change(validateMonthF);
	month_t.change(validateMonthT);
	prog_no.change(validateProgNo);
	sub_prog_no.change(validateSubProg);
	obj_no.change(validateObjNo);
	act.blur(validateAct);
	
	
	act.keyup(validateAct);
	
	form.submit(function(){
		if(validateRepType() & validateRepM() & validateRepY() & validateAnnTarg() & validateMonthF() & validateMonthT() & validateProgNo() & validateSubProg() & validateObjNo() & validateAct()){
			alert("Report successfully added");
			return true
		} else {
			alert("Report not successfully added");
			return false;
		}
	});
	
	function validateRepType(){
		if(rep_type.val() == " "){
			rep_type.addClass("error");
			return false;
		} else {
			rep_type.removeClass("error");
			return true;
		}
	}
	
	function validateRepM(){
		if(rep_m.val() == " "){
			rep_m.addClass("error");
			return false;
		} else {
			rep_m.removeClass("error");
			return true;
		}
	}
	
	function validateRepY(){
		if(rep_y.val() == " "){
			rep_y.addClass("error");
			return false;
		} else {
			rep_y.removeClass("error");
			return true;
		}
	}
	
	function validateAnnTarg(){
		if(ann_targ.val() == 0){
			ann_targ.addClass("error");
			return false;
		} else {
			ann_targ.removeClass("error");
			return true;
		}
	}
	
	function validateMonthF(){
		if(month_f.val() == 0){
			month_f.addClass("error");
			return false;
		} else {
			month_f.removeClass("error");
			return true;
		}
	}
	
	function validateMonthT(){
		if(month_t.val() == 0){
			month_t.addClass("error");
			return false;
		} else {
			month_t.removeClass("error");
			return true;
		}
	}
	
	function validateProgNo(){
		if(prog_no.val() == 0){
			prog_no.addClass("error");
			return false;
		} else {
			prog_no.removeClass("error");
			return true;
		}
	}
	
	function validateSubProg(){
		if(sub_prog_no.val() == 0){
			sub_prog_no.addClass("error");
			return false;
		} else {
			sub_prog_no.removeClass("error");
			return true;
		}
	}
	
	function validateObjNo(){
		if(obj_no.val() == 0){
			obj_no.addClass("error");
			return false;
		} else {
			obj_no.removeClass("error");
			return true;
		}
	}
	
	function validateAct(){
		if(act.val().length < 4){
			act.addClass("error");
			return false;
		} else {
			act.removeClass("error");
			return true;
		}
	}
	
});