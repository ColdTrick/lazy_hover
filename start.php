<?php

// register default elgg events
elgg_register_event_handler("init", "system", "lazy_hover_init");

/**
 * Initialize the lazy hover plugin.
 */
function lazy_hover_init() {
	elgg_extend_view("js/elgg", "js/lazy_hover/site");

	elgg_register_ajax_view('lazy_hover/user_hover');

	// extend public pages
	elgg_register_plugin_hook_handler('public_pages', 'walled_garden', 'lazy_hover_public_pages');

}

/**
 *
 * Extend public pages
 * @param string $hook_name
 * @param string $entity_type
 * @param array $return_value
 * @param array $parameters
 */
function lazy_hover_public_pages($hook_name, $entity_type, $return, $params){
	if(is_array($return)){
		$return[] = "lazy_hover";
	}
	return $return;
}
