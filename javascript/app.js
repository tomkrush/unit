$(function() {
	$('.console').live('click', function() {
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
				if ( data ) {
					$(test_case).replaceWith(data);
				} else {
					alert('Nothing returned.');	
				}
			},
			complete:function() {
				$(refresh).removeClass('loading');
			
			}
		});

		return false;
	});
});