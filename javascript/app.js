$(function() {
	$(".navigation.right .passed").click(function() {
		$(".file.has_passes, .file .row.pass").show();
		$(".file.has_fails, .file .row.fail").hide();
		$(".file .results").hide();
	});

	$(".navigation.right .failed").click(function() {
		$(".file.has_passes, .file .row.pass").hide();
		$(".file.has_fails, .file .row.fail").show();
		$(".file .results").hide();
	});

	$(".navigation.right .total").click(function() {
		$(".file.has_passes, .file .row.pass").show();
		$(".file.has_fails, .file .row.fail").show();
		$(".file .results").show();
	});
});