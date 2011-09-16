<?php 

	gatekeeper();
	
	$user_guid 			= (int) get_input('guid');
	$new_username		= get_input('username'); 
	
	$loggedin_user		= get_loggedin_user();
	
	if($user = get_user($user_guid))
	{
		if(($user->username != $new_username) && (strlen($new_username) > 4))
		{
			// make sure we can check all users (even unvalidated)
			$access_status = access_get_show_hidden_status();
			access_show_hidden_entities(true);
			
			if(get_user_by_username($new_username))
			{
				register_error(elgg_echo('change_username:error:usernameexists'));
			}
			else
			{
				try
				{
					validate_username($new_username);
					
					$user->username = $new_username;
					
					if($user->save())
					{
						register_plugin_hook("forward", "system", "change_username_forward_hook");
						
						system_message(elgg_echo('change_username:message:success'));
					}
				}
				catch(Exception $e)
				{
					register_error($e->getMessage());
				}
				
			}
			
			// restore access status
			access_show_hidden_entities($access_status);
		}
	}