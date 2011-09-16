<?php 

	$user = page_owner_entity();

?>
<h3><?php echo elgg_echo('username'); ?></h3>
<div id="change_username">
	<?php 
		echo elgg_view('input/button', array(	'internalid' 	=> 'change_username_toggle',
												'type'			=> 'button',
												'value' 		=> elgg_echo('change_username:changeusername')));
	?>
	
	<p>
		<?php
			echo elgg_view('input/text',array(	'internalname' 	=> 'username', 
												'internalid' 	=> 'change_username_field', 
												'value' 		=> $user->username));
		?>
		<br />
		<span id="change_username_status"><?php echo elgg_echo("change_username:error:usernameunavailable"); ?></span>
	</p>
</div>