<?php 

	$plugin = $vars["entity"];
	
	$allowed_users_options = array(
		"user" => elgg_echo("change_username:settings:allowed_users:user"),
		"admin" => elgg_echo("change_username:settings:allowed_users:admin")
	);

	echo "<div>";
	echo elgg_echo("change_username:settings:allowed_users");
	echo "&nbsp;" . elgg_view("input/pulldown", array("internalname" => "params[allowed_users]", "options_values" => $allowed_users_options, "value" => $plugin->allowed_users));
	echo "</div>";
