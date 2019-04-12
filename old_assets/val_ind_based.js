// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#ind_based");
	var rep_month = $("#rep_month");
	var rep_year = $("#rep_year");
	var target = $("#target");
	var surveys = $("#surveys");
	var training = $("#training");
	
	target.blur(validateTarget);
	surveys.blur(validateSurveys);
	training.blur(validateTraining);
	
	rep_month.change(validateRepMonth);
	rep_year.change(validateRepYear);
	
	target.keyup(validateTarget);
	surveys.keyup(validateSurveys);
	training.keyup(validateTraining);
	
	form.submit(function(){
		if(validateRepMonth() & validateRepYear() & validateTarget() & validateSurveys() & validateTraining()){
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
		}
		else{
			target.addClass("error");
			return false;
		}
	}
	
	function validateSurveys() {
		if(surveys.val().length < 1){
			surveys.addClass("error");
			return false;
		}
		//if it's valid
		else{
			surveys.removeClass("error");
			return true;
		}
	}
	
	function validateTraining() {
		if(training.val().length < 1){
			training.addClass("error");
			return false;
		}
		//if it's valid
		else{
			training.removeClass("error");
			return true;
		}
	}
	
});