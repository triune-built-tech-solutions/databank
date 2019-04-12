// JavaScript Document
$(document).ready(function(){
	//global vars
	var form = $("#add_prog");
	var prog_titl = $("#prog_titl");
	
	prog_titl.blur(validateAdd_prog);
	
	form.submit(function (){
		if(validateAdd_prog)
			return true;
		else
			return false;
		})
	
	
	function validateAdd_prog(){
		if(prog_titl.val().length < 1){
			prog_title.addClass("error");
			return false;
		} else {
			prog_title.removeClass("error");
			return true;
		}
	}
});