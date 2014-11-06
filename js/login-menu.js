$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
		$(".user-icon").css("top","60px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");

	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
		$(".pass-icon").css("top","140px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});