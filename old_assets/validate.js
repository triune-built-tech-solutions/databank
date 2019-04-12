// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#add_user");
	var name = $("#first_name");
	var nameInfo = $("#nameInfo");
	var midname = $("#middle_name");
	var midnameInfo = $("#mnameInfo");
	var surname = $("#last_name");
	var surnameInfo = $("#lnameInfo");
	var username = $("#username");
	var unameInfo = $("#unameInfo");
	var staff_no = $("#staff_no");
	var staffInfo = $("#staffInfo");
	var pass1 = $("#pass1");
	var pass1Info = $("#pass1Info");
	var pass2 = $("#pass2");
	var pass2Info = $("#pass2Info");
	var title = $("#title");
	var gender = $("#gender");
	var office_t = $("#office_t");
	var office_lo = $("#office_loc");
	var access = $("#access_right");
	var dept = $("#dept");
	var div = $("#div");
	var section = $("#section");
	
	//On blur
	staff_no.blur(validateStaff_no);
	name.blur(validateName);
	surname.blur(validateSurname);
	username.blur(validateUsername);
	username.blur(validateUsename);
	pass1.blur(validatePass1);
	pass2.blur(validatePass2);
	
	//On key press
	title.change(validateTitle);
	gender.change(validateGender);
	office_t.change(validateOfficeT);
	office_lo.change(validateOfficeL);
	access.change(validateAccess);
	//dept.change(validateDept);
	//div.change(validateDiv);
	//section.change(validateSection);
	staff_no.keyup(validateStaff_no);
	name.keyup(validateName);
	surname.keyup(validateSurname);
	username.keyup(validateUsername);
	username.keyup(validateUsename);
	pass1.keyup(validatePass1);
	pass2.keyup(validatePass2);
	
	//On Submitting ***validateDept() & validateDiv() & validateSection() & ***
	
	form.submit(function(){
		if(validateStaff_no() & validateTitle() & validateGender() & validateOfficeT() & validateOfficeL() & validateAccess() & validateName() & validateSurname() & validateUsername() & validatePass1() & validatePass2()){
			alert("data successfully added");
			return true;
		} else {
			alert("data not successfully added");
			return false;
		}
	}); 
	
	function validateTitle(){
		if (title.val() == " "){
			title.addClass("error");
			return false;
		} else {
			title.removeClass("error");
			return true;
		}
	}
	
	
	function validateGender(){
		if (gender.val() == " "){
			gender.addClass("error");
			return false;
		} else {
			gender.removeClass("error");
			return true;
		}
	}
	
	function validateOfficeT(){
		if (office_t.val() == " "){
			office_t.addClass("error");
			return false;
		} else {
			office_t.removeClass("error");
			return true;
		}
	}
	
	function validateOfficeL(){
		if (office_lo.val() == " "){
			office_lo.addClass("error");
			return false;
		} else {
			office_lo.removeClass("error");
			return true;
		}
	}
	
	function validateAccess(){
		if (access.val() == " "){
			access.addClass("error");
			return false;
		} else {
			access.removeClass("error");
			return true;
		}
	}
	
	function validateDept(){
		if (dept.val() == " "){
			dept.addClass("error");
			return false;
		} else {
			dept.removeClass("error");
			return true;
		}
	}
	
	function validateDiv(){
		if (div.val() == " "){
			div.addClass("error");
			return false;
		} else {
			div.removeClass("error");
			return true;
		}
	}
	
	function validateSection(){
		if (section.val() == " "){
			section.addClass("error");
			return false;
		} else {
			section.removeClass("error");
			return true;
		}
	}
	
	//validation functions
	function validateStaff_no(){
		//if it's NOT valid
		if(staff_no.val().length < 4){
			staff_no.addClass("error");
			staffInfo.text("This field is required");
			staffInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			staff_no.removeClass("error");
			staffInfo.text("What's your staff number?");
			staffInfo.removeClass("error");
			return true;
		}
	}
	
	function validateName(){
		//if it's NOT valid
		if(name.val().length < 3){
			name.addClass("error");
			nameInfo.text("We want names with more than 2 letters!");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			nameInfo.text("What's your name?");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateMidName(){
		//if it's NOT valid
		if(midname.val().length < 3){
			midname.addClass("error");
			midnameInfo.text("We want names with more than 2 letters!");
			midnameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			midname.removeClass("error");
			midnameInfo.text("What's your middle name?");
			midnameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateSurname(){
		//if it's NOT valid
		if(surname.val().length < 3){
			surname.addClass("error");
			surnameInfo.text("We want names with more than 2 letters!");
			surnameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			surname.removeClass("error");
			surnameInfo.text("What's your last name?");
			surnameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateUsername(){
		//if it's NOT valid
		if(username.val().length < 4){
			username.addClass("error");
			unameInfo.text("We want names with more than 3 letters!");
			unameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			username.removeClass("error");
			unameInfo.text("Remember your username, you will need it to log in!");
			unameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateUsename(){
		$.post('check_user.php', {usrname:username.val()}, function(data){
		if(data == 0){
			$('#send').removeAttr('disabled', 'disabled');
			return true;
		} else {
			username.addClass("error");
			unameInfo.text("Username already exist. Please choose a new one");
			unameInfo.addClass("error");
			$('#send').attr('disabled', 'disabled');
			return false;
		}
		});
	}
	
	function validatePass1(){
		//it's NOT valid
		if(pass1.val().length <5){
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
