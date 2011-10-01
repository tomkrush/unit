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
		cases_list_html += '<li><input type="checkbox" id="'+id+'"/><label for="'+id+'">'+text+'</label></li>';
	});
	
	$('.filter .popover .list').html(cases_list_html);
	
	$('.filter .popover .list li').delegate('input[type=checkbox]', 'change', function() {
		var li = $(this).parent();
		
		var rel = $('label', li).text();
		var the_case = $('.cases .case[rel='+rel+']');
			
		if ( $(this).attr('checked') )
		{
			the_case.hide();
		}
		else {
			the_case.show();
		}
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