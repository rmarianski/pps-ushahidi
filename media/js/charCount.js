/*
 * 	Character Count Plugin - jQuery plugin
 * 	Dynamic character count for text areas and input fields
 *	written by Alen Grakalic	
 *	http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
 *
 *	Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *	Dual licensed under the MIT (MIT-LICENSE.txt)
 *	and GPL (GPL-LICENSE.txt) licenses.
 *
 *	Built for jQuery library
 *	http://jquery.com
 *
 */
 
(function($) {

	$.fn.charCount = function(options){
	  
		// default configuration properties
		var defaults = {	
			allowed: 140,		
			warning: 25,
			css: 'counter',
			counterElement: 'span',
			cssWarning: 'warning',
			cssExceeded: 'exceeded',
			counterText: ''
		}; 
			
		var options = $.extend(defaults, options); 
		
	    function calculate(obj, counterElement){
			var count = $(obj).val().length;
			var available = options.allowed - count;
			if(available <= options.warning && available >= 0){
				counterElement.addClass(options.cssWarning);
			} else {
				counterElement.removeClass(options.cssWarning);
			}
			if(available < 0){
				counterElement.addClass(options.cssExceeded);
			} else {
				counterElement.removeClass(options.cssExceeded);
			}
			counterElement.html(options.counterText + available);
		};
				
		this.each(function() {  			
                    var counterElement = $('<'+ options.counterElement +' class="' + options.css + '">'+ options.counterText +'</'+ options.counterElement +'>');
		    $(this).after(counterElement);
		    calculate(this, counterElement);
		    $(this).keyup(function(){calculate(this, counterElement)});
		    $(this).change(function(){calculate(this, counterElement)});
		});
	  
	};

})(jQuery);
