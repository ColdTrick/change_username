<?php 
	$user = page_owner_entity();
		
?>

<script type="text/javascript">
	$(function()
	{
		$('#change_username_toggle').click(function()
		{
			$('#change_username p').toggle();
	
			$(this).remove();
		});
		
		$('#change_username_field').keyup(function(event)
		{
			if(event.which != 13)
			{
				var username = $(this).val();
				if('<?php echo $user->username; ?>' != username && username.length >= 4)
				{
					$('#change_username_field').removeClass('username_check_load username_check_success username_check_error').addClass('username_check_load');
					
					$.post('<?php echo $vars["url"] . 'pg/change_username/check'; ?>', {username: username}, function(response)
					{
						if(response.valid)
						{
							$('#change_username_status').hide();
							$('#change_username_field').addClass('username_check_success');
						}
						else
						{
							showError(response.error);
						}
					},'json');
				}
				else
				{
					$('#change_username_status').hide();
					$(this).removeClass('username_check_load username_check_success username_check_error');
				}
			}
		});
	});
	
	function showError(error)
	{
		$('#change_username_status').html(error).show();
		$('#change_username_field').addClass('username_check_error');
	}
</script>