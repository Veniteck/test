;( function( $ ) {
	'use strict';

	$(document).ready(function() {

		if($('#fs_affiliation_content_wrapper').length) {

			var $messages = $('#fs_affiliation_content_wrapper #messages');
console.log($messages.text().trim());
			if($messages.text().trim() === '') {
				$messages.html('');
			}
			console.log($messages.html());
		}

		$('#wpfooter').appendTo('#wpwrap');

	});

})( jQuery );