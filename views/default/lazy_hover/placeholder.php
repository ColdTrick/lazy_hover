<?php

global $LAZY_HOVER;

if (!isset($LAZY_HOVER)) {
	$LAZY_HOVER = array();
}

$user = elgg_extract("entity", $vars);
if (elgg_instanceof($user)) {
	
	$data = array(
		'guid' => $user->getGUID(),
		'page_owner_guid' => (int) elgg_get_page_owner_guid(),
		'contexts' => elgg_get_config("context"),	
	);
	$data_encoded = http_build_query($data);

	$class = "elgg-menu elgg-menu-hover elgg-ajax-loader pvl";
	$md5 = md5($data['guid'] . "-" . $data['page_owner_guid'] . "-" . implode("-", $data['contexts']));
	
	echo "<ul class=\"$class\" rel=\"$md5\" data-lazy-hover=\"$data_encoded\"></ul>";
}
