jQuery(document).ready(function ($) {
	$('.bold_timeline_lite_dismiss_notice_callto_action_snooze').on('click', function (event) {
		var $this = $(this);
		var wrapper			= $this.parents('.bold-timeline-lite-feedback-notice-wrapper');
		var ajaxURL			= wrapper.data('ajax-url');
		var ajaxCallback	= wrapper.data('ajax-callback');
		jQuery.ajax({
				 type : "post",
				 dataType : "json",
				 url : ajaxURL,
				 data : {
							'action': ajaxCallback
				 },
				 success: function(response) {
					 wrapper.slideUp('fast');					
				 },
				 error: function( xhr, status, error ) {
                     console.log('error: ' +  status + ' ' + error);
                 }
		  });
	});
});