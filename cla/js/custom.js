/*---------------------------------------------------------------------
    File Name: custom.js
---------------------------------------------------------------------*/

$(function () {

	"use strict";

	/* Preloader
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

	setTimeout(function () {
		$('.loader_bg').fadeToggle();
	}, 1500);

	/* Tooltip
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

	$(document).ready(function () {
		$('[data-toggle="tooltip"]').tooltip();
	});



	/* Mouseover
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

	$(document).ready(function () {
		$(".main-menu ul li.megamenu").mouseover(function () {
			if (!$(this).parent().hasClass("#wrapper")) {
				$("#wrapper").addClass('overlay');
			}
		});
		$(".main-menu ul li.megamenu").mouseleave(function () {
			$("#wrapper").removeClass('overlay');
		});
	});





	var params = new URLSearchParams(window.location.search);
	var statusMessages = {
		invalid: 'Please check the information you entered and try again.',
		match: 'Passwords do not match.',
		exists: 'That email address is already registered.',
		success: 'Your request was completed successfully.'
	};
	var statusKey = params.get('error') || params.get('signup') || params.get('sent') || params.get('login');
	if (statusKey && statusMessages[statusKey]) {
		var status = document.querySelector('[data-form-status]');
		if (status) {
			status.textContent = statusMessages[statusKey];
			status.classList.add('is-visible', params.get('error') ? 'is-error' : 'is-success');
		}
	}
	/* Toggle sidebar
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */

	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$(this).toggleClass('active');
		});
	});

	/* Product slider 
	-- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- */
	// optional
	$('#blogCarousel').carousel({
		interval: 5000
	});


});