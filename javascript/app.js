$(function() {
	$('.console').click(function() {
		$(this).parent().next('.buffer').slideToggle('fast');
		return false;
	});
});