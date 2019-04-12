// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#add_user");
	var oldp = $("#oldp");
	var oldInfo = $("#oldInfo");
	var pass1 = $("#pass1");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2");
	var pass2Info = $("#pass2Info");
	
	//On blur
	oldp.blur(validatePassO);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	
	//On key press
	oldp.keyup(validatePassO);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	
	//On Submitting
	form.submit(function(){
		if(validatePass1() & validatePass2()){
			alert("data successfully updated");
			return true;
		} else {
			alert("data not successfully updated");
			return false;
		}
	});
	
	function validatePassO(){
		$.post('check_oldpass.php', {oldp:oldp.val()}, function(data){
		if(data == 1){
			oldp.removeClass("error");
			oldInfo.text("Former Password you use to login...");
			oldInfo.removeClass("error");
			$('#send').removeAttr('disabled', 'disabled');
			return true;
		} else {
			oldp.addClass("error");
			oldInfo.text("Password does not match old password!");
			oldInfo.addClass("error");
			$('#send').attr('disabled', 'disabled');
			return false;
		}
		});
	}
	
	function validatePass1(){
		//it's NOT valid
		if(pass1.val().length < 5){
			pass1.addClass("error");
			pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
			pass1Info.addClass("error");
			return false;
		}
		//it's valid
		else{			
			pass1.removeClass("error");
			pass1Info.text("At least 5 characters: letters, numbers and '_'");
			pass1Info.removeClass("error");
			validatePass2();
			return true;
		}
	}
	
	function validatePass2(){
		//are NOT valid
		if( pass1.val() != pass2.val() ){
			pass2.addClass("error");
			pass2Info.text("Passwords doesn't match!");
			pass2Info.addClass("error");
			return false;
		}
		//are valid
		else{
			pass2.removeClass("error");
			pass2Info.text("Confirm password");
			pass2Info.removeClass("error");
			return true;
		}
	}
});
