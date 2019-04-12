// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#reimburse");
	var rep_month = $("#rep_month");
	var rep_year = $("#rep_year");
	var target = $("#claims");
	var proposed = $("#claims_pro");
	var test_runned = $("#cl_pro_date");
	var participants = $("#claims_paid");
	var organizations = $("#amount_paid");
	
	target.blur(validateTarget);
	proposed.blur(validateProposed);
	test_runned.blur(validateTestRunned);
	participants.blur(validateParticipants);
	organizations.blur(validateOrganizations);
	
	rep_month.change(validateRepMonth);
	rep_year.change(validateRepYear);
	
	target.keyup(validateTarget);
	proposed.keyup(validateProposed);
	test_runned.keyup(validateTestRunned);
	participants.keyup(validateParticipants);
	organizations.keyup(validateOrganizations);
	
	form.submit(function(){
		if(validateRepMonth() & validateRepYear() & validateTarget() & validateProposed() & validateTestRunned() & validateParticipants() & validateOrganizations()){
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
	
	function validateTarget() {
		if(target.val().length >= 1){
			target.removeClass("error");
			return true;
		} else {
			target.addClass("error");
			return false;
		}
	}
	
	function validateProposed() {
		if(proposed.val().length >= 1){
			proposed.removeClass("error");
			return true;
		} else {
			proposed.addClass("error");
			return false;
		}
	}
	
	function validateTestRunned() {
		if(test_runned.val().length < 1){
			test_runned.addClass("error");
			return false;
		} else {
			test_runned.removeClass("error");
			return true;
		}
	}
	
	function validateParticipants() {
		if(participants.val().length < 1){
			participants.addClass("error");
			return false;
		} else {
			participants.removeClass("error");
			return true;
		}
	}
	
	function validateOrganizations() {
		if(organizations.val().length < 1){
			organizations.addClass("error");
			return false;
		} else {
			organizations.removeClass("error");
			return true;
		}
	}
	
});