// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#outs_cour");
	var rep_month = $("#rep_month");
	var rep_year = $("#rep_year");
	var target = $("#gross_amt");
	var proposed = $("#amt_coll");
	
	target.blur(validateTarget);
	proposed.blur(validateProposed);
	
	rep_month.change(validateRepMonth);
	rep_year.change(validateRepYear);
	
	target.keyup(validateTarget);
	proposed.keyup(validateProposed);
	
	form.submit(function(){
		if(validateRepMonth() & validateRepYear() & validateTarget() & validateProposed()){
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
	
});