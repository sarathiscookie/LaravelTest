$(function() {
    "use strict";
    
    /* Checking for the CSRF token */
	$.ajaxSetup({
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		}
	});
	
	$( '.changeStatus' ).on('change', function() {

		let id = $(this).data('id');

		let status = $(this).val();

		$.ajax({
			url: '/admin/dashboard/user/status/update',
			dataType: "JSON",
			type: "PUT",
			data: { 'id': id, 'status': status }
		})
			.done(function(result) {
				//
			})
			.fail(function(data) {
				//
			});
	});
    
});    