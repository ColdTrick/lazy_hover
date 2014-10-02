<?php

// register default elgg events
elgg_register_event_handler("init", "system", "lazy_hover_init");

/**
 * Initialize the lazy hover plugin.
 *
 * @return void
 */
function lazy_hover_init() {
	elgg_extend_view("js/elgg", "js/lazy_hover/site");

	elgg_register_ajax_view("lazy_hover/user_hover");

	// extend public pages
	elgg_register_plugin_hook_handler("public_pages", "walled_garden", "lazy_hover_public_pages");

}

/**
 * Extend public pages
 *
 * @param string   $hook_name    "public_pages"
 * @param string   $entity_type  "walled_garden"
 * @param string[] $return_value array of public pages
 * @param mixed    $params       unused
 *
 * @return string[]
 */
function lazy_hover_public_pages($hook_name, $entity_type, $return_value, $params) {
	
	if (is_array($return_value)) {
		$return_value[] = "ajax/view/lazy_hover.*";
	}
	
	return $return_value;
}
