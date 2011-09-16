<?php

	require_once(dirname(__FILE__) . "/lib/hooks.php");

	function change_username_init()
	{
		// extend CSS
		elgg_extend_view("css", "change_username/css");
		
		if(isadminloggedin() || (isloggedin() && (get_plugin_setting("allowed_users", "change_username") != "admin")))
		{
			global $CHANGE_USERNAME_ALLOWED;
			$CHANGE_USERNAME_ALLOWED = true;
			
			// register page handler for nice URL's
			register_page_handler("change_username", "change_username_page_handler");
			
			// extend usersettings
			elgg_extend_view("usersettings/user", "change_username/usersettings/username", 0);
			
			// register hook to save settings
			register_plugin_hook("usersettings:save", "user", "change_username_hook");
		}
	}
	
	function change_username_pagesetup()
	{
		global $CHANGE_USERNAME_ALLOWED;
		
		if(!empty($CHANGE_USERNAME_ALLOWED)){
			$context = get_context();
			$user = get_loggedin_user();
			$page_owner = page_owner_entity();
			
			if(!empty($user) && !empty($page_owner) && ($context == "settings")){
				// extend metatags
				elgg_extend_view("metatags", "change_username/metatags");
			}
		}
	}

	function change_username_page_handler($page)
	{
		switch($page[0])
		{
			case "check":
				include(dirname(__FILE__) . "/procedures/check.php");
				break;
			default:
				return false;
				break;
		}
	}

	// register default elgg events
	register_elgg_event_handler("init", "system", "change_username_init");
	register_elgg_event_handler("pagesetup", "system", "change_username_pagesetup");
	