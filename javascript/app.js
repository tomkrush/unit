$(function() {
	var testCase;

	function resize_box()
	{
		$('.cases_wrapper').height($(window).height()-88);
	}

	resize_box();
	$(window).resize(resize_box);
	
	var cases_list_html = '';
	
	$('.cases .case').each(function() {
		var text = $(this).attr('rel');
		var id = text + 'Field';
		var passed = $(this).data('passed');
		var failed = $(this).data('failed');
		
		cases_list_html += '<li><input type="checkbox" checked="checked" id="'+id+'"/><label for="'+id+'">'+text+'</label><div class="status"><span class="passed">'+passed+'</span><span class="failed">'+failed+'</span></div></li>';
	});
	
	$('.filter .popover .list').html(cases_list_html);
	
	$('.filter .button').click(function() {
		$('.filter .popover').fadeToggle('fast');
	});
	
	$('.filter .popover .list li').delegate('input[type=checkbox]', 'change', function() {
		var li = $(this).parent();
		
		var rel = $('label', li).text();
		var the_case = $('.cases .case[rel='+rel+']');
			
		if ( $(this).attr('checked') )
		{
			the_case.show();
		}
		else {
			the_case.hide();
		}
		
		var passed = 0;
		var failed = 0;
		
		$('.cases .case:visible').each(function() {		
			passed += parseInt($(this).data('passed'));			
			failed += parseInt($(this).data('failed'));
		});
		
		$('.footer.toolbar .passed span').text(passed);
		$('.footer.toolbar .failed span').text(failed);
	});
	
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