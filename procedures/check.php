<?php 

	/**
	 * jQuery call to verify if username exists
	 * 
	 */

	$returnData = array();
	$returnData['valid'] = false;

	if(isloggedin()){
		$new_username = get_input('username');
		
		// make sure we can check every user (even unvalidated)
		$access_status = access_get_show_hidden_status();
		access_show_hidden_entities(true);
		
		// check if username exists
		try 
		{
			validate_username($new_username);
			
			if(get_user_by_username($new_username))
			{
				throw new Exception(elgg_echo('change_username:error:usernameexists'));
			}
			$returnData['valid'] = true;
		}
		catch (Exception $e)
		{
			$returnData['error'] = $e->getMessage();
		}
		
		// restore access settings
		access_show_hidden_entities($access_status);
	}
	
	// encode output
	$json_string = json_encode($returnData);
	
	header("Content-Type: application/json; charset=UTF-8");
	header("Content-Length: " . strlen($json_string));
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	
	echo $json_string;
	