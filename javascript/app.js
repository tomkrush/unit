$(function() {
	var testCase;

	function resize_box()
	{
		$('.cases_wrapper').height($(window).height()-88);
	}

	resize_box();
	$(window).resize(resize_box);

	$('.cases_wrapper').scroll(function() {
		var scrollOffset = $('.cases_wrapper').scrollTop(); 
								
		$('.case').each(function() {
			var position = $(this).position().top + $(this).outerHeight();
						
			if (position > scrollOffset) {
					
				if ( testCase != this )
				{
					if ( testCase )
					{
						$('h3', testCase).css({
							'position': 'absolute',
							'top': '0'
						});
					}
					
					testCase = this;
					
					$('h3', testCase).css({
						'position': 'fixed',
						'top': '44px'
					});
				}
				
				return false;
			}
		});
	});
});