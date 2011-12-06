$(function() {
	$('.console').live('click', function() {
		$(this).parent().next('.buffer').slideToggle('fast');
		return false;
	});
	
	$('.filter select').bind('change', function() {
		$('.case').hide();
		var value = $(this).val();
		var passed = 0;
		var failed = 0;
		
		if ( value == '0' ) {
			$('.case').show();
			passed = $('body').data('passed');
			failed = $('body').data('failed');			
		} else {
			$('.case').hide();
			
			var test_case = $('.case[ref='+$(this).val()+']');
		
			passed = $(test_case).data('passed');
			failed = $(test_case).data('failed');	
			
			test_case.show();
		}
		
		$('.tools .total strong').text(parseInt(passed) + parseInt(failed));
		$('.tools .passed strong').text(passed);
		$('.tools .failed strong').text(failed);
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