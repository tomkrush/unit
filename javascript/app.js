$(function() {
	$('.console').click(function() {
		$(this).parent().next('.buffer').slideToggle('fast');
		return false;
	});
	
	$('.refresh').live('click', function() {
		var url = $(this).data('url');
		var test_case = $(this).parent().parent();
		var refresh = this;
		
			$(refresh).addClass('loading');
		$.ajax({
			url:url,
			success:function(data) {
				$(test_case).replaceWith(data);
			},
			complete:function() {
				$(refresh).removeClass('loading');
			
			}
		});

		return false;
	});
});