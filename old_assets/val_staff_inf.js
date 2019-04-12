// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#staff_inf");
	var rep_month = $("#rep_month");
	var rep_year = $("#rep_year");
	var sen_staff = $("#sen_staff");
	var jun_staff = $("#jun_staff");
	var oth_staff = $("#oth_staff");
	var staff_dis = $("#staff_dis");
	var off_loc = $("#off_loc");
	var one = $('#off_loc').val();
	var two = $('#rep_month').val();
	
	sen_staff.blur(validateSenStaff);
	jun_staff.blur(validateJunStaff);
	oth_staff.blur(validateOthStaff);
	staff_dis.blur(validateStaffDis);
	
	rep_month.change(validateRepMonth);
	rep_year.change(validateRepYear);
	
	sen_staff.keyup(validateSenStaff);
	jun_staff.keyup(validateJunStaff);
	oth_staff.keyup(validateOthStaff);
	staff_dis.keyup(validateStaffDis);
	
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
		if(sen_staff.val().length >= 1){
			sen_staff.removeClass("error");
			return true;
		}
		else{
			sen_staff.addClass("error");
			return false;
		}
	}
	
	function validateJunStaff() {
		if(jun_staff.val().length >= 1){
			jun_staff.removeClass("error");
			return true;
		}
		else{
			jun_staff.addClass("error");
			return false;
		}
	}
	
	function validateOthStaff() {
		if(oth_staff.val().length < 1){
			oth_staff.addClass("error");
			return false;
		}
		//if it's valid
		else{
			oth_staff.removeClass("error");
			return true;
		}
	}
	
	function validateStaffDis() {
		if(staff_dis.val().length < 1){
			staff_dis.addClass("error");
			return false;
		}
		//if it's valid
		else{
			staff_dis.removeClass("error");
			return true;
		}
	}
	
});