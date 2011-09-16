<?php 

	function change_username_hook($hook, $entity_type, $returnvalue, $params)
	{
		include(dirname(dirname(__FILE__)) . "/actions/change.php");
	}
	
	function change_username_forward_hook($hook, $entity_type, $returnvalue, $params)
	{
		global $CONFIG;
		
		$result = $returnvalue;
		
		if(!empty($params) && is_array($params))
		{
			$current_url = $params["current_url"];
			
			if($current_url == $CONFIG->wwwroot . "action/usersettings/save")
			{
				$user_guid = (int) get_input("guid");
				
				if(!empty($user_guid) && ($user = get_user($user_guid)))
				{
					$result = $CONFIG->wwwroot . "pg/settings/user/" . $user->username;
				}
			}
		}
		
		return $result;
	}