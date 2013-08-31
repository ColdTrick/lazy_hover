<?php
?>
//<script>
elgg.provide("elgg.lazy_hover");

elgg.lazy_hover.init = function(){
	$(".elgg-avatar > .elgg-icon-hover-menu").on('click', function() {
		var $placeholder = $(this).parent().find(".elgg-menu-hover.elgg-ajax-loader");
		if ($placeholder.length > 0) {
			var md5 = $placeholder.attr('rel');
			// select all similar placeholders
			var $all_placeholders = $(".elgg-menu-hover[rel='" + md5 + "']");
			var action = elgg.get_site_url() + 'lazy_hover';
			var data = $placeholder.data('lazy-hover');

			elgg.get(action, {
				data: data,
				success: function(data) {
					if (data) {
						// replace all existing placeholders with new menu
						$all_placeholders.removeClass('elgg-ajax-loader pvl')
							.html($(data).children());

						// show the new menu in the popup
						var $popup = $('.elgg-menu-hover:visible');
						if ($popup.attr('rel') === md5) {
							$popup.removeClass('elgg-ajax-loader pvl')
								.html($(data).children());
						}
					}
				}
			});
		}
	});
};

// register init hook
// lower priority is required have the live click registration before other click events
elgg.register_hook_handler("init", "system", elgg.lazy_hover.init, 400);
