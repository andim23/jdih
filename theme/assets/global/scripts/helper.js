// JavaScript Document
$.clearInput = function () {
	$('#form').find('input[type=text], input[type=hidden], input[type=password], input[type=number], input[type=email], textarea, select').val('');
	$(".select2").select2("val", "");
};

$.clearErrorMark = function () {
	$("#form .text-danger").remove();
	$("#form .form-group").removeClass("has-error");
	$("#form .form-group").removeClass("has-success");
};

function clearInput(formid){
	$('#' + formid).find('input[type=text], input[type=hidden], input[type=password], input[type=number], input[type=email], textarea').val('');
}

function null_to_empty(val){
	return val!=null?val:'';
}