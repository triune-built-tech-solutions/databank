// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#indepth");
	var rep_month = $("#rep_month");
	var rep_year = $("#rep_year");
	var target = $("#target");
	var surv_c_o = $("#std_c_o");
	var train_int_dev = $("#int_dev");
	var train_int_imp = $("#int_imp");
	
	target.blur(validateSenStaff);
	surv_c_o.blur(validateJunStaff);
	train_int_dev.blur(validateOthStaff);
	train_int_imp.blur(validateStaffDis);
	
	rep_month.change(validateRepMonth);
	rep_year.change(validateRepYear);
	
	target.keyup(validateSenStaff);
	surv_c_o.keyup(validateJunStaff);
	train_int_dev.keyup(validateOthStaff);
	train_int_imp.keyup(validateStaffDis);
	
	form.submit(function(){
		if(validateRepMonth() & validateRepYear() & validateSenStaff() & validateJunStaff() & validateOthStaff() & validateStaffDis()){
			alert("data successfully added");
			return true;
		}
		 else{
			 alert("data was not successfully added");
			return false;
		 }
	});
	
	function validateRepMonth(){
		if(rep_month.val() == " "){
			rep_month.addClass("error");
			return false;
		} else {
			rep_month.removeClass("error");
			return true;
		}
	}
	
	function validateRepYear(){
		if(rep_year.val() == " "){
			rep_year.addClass("error");
			return false;
		} else {
			rep_year.removeClass("error");
			return true;
		}
	}
	
	function validateSenStaff() {
		if(target.val().length >= 1){
			target.removeClass("error");
			return true;
		} else {
			target.addClass("error");
			return false;
		}
	}
	
	function validateJunStaff() {
		if(surv_c_o.val().length < 1){
			surv_c_o.addClass("error");
			return false;
		} else {
			surv_c_o.removeClass("error");
			return true;
		}
	}
	
	function validateOthStaff() {
		if(train_int_dev.val().length < 1){
			train_int_dev.addClass("error");
			return false;
		} else {
			train_int_dev.removeClass("error");
			return true;
		}
	}
	
	function validateStaffDis() {
		if(train_int_imp.val().length < 1){
			train_int_imp.addClass("error");
			return false;
		} else {
			train_int_imp.removeClass("error");
			return true;
		}
	}
	
});