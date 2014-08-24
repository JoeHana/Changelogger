var changelogger = changelogger || {};

jQuery(document).ready(function ($) {
	
    "use strict";
	
	// UIKIT > NOTIFY > START
	changelogger.notify = function() {
		
		$.UIkit.notify({
			message : 'Bazinga! Welcome to the Changelogger',
			status  : 'info',
			timeout : 5000,
			pos     : 'top-center'
		});
				
	}
	// UIKIT > NOTIFY > END
	
	//changelogger.notify();
	
});