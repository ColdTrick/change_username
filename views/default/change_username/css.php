<?php 
	$graphics_folder = $vars["url"] . "mod/change_username/_graphics/";	
?>

#change_username p,
#change_username_hidden,
#change_username_status
{
	display: none;
}

#change_username_field
{
	background-repeat: no-repeat; 
	background-position: 97% 50%;
}

.username_check_load, 
.username_check_load:focus
{
	background-image: url(<?php echo $graphics_folder;?>loader.gif);
}

.username_check_success, 
.username_check_success:focus
{
	border: 1px green solid;
	background-image: url(<?php echo $graphics_folder;?>success.png);
}

.username_check_error, 
.username_check_error:focus
{
	border: 1px red solid;
	background-image: url(<?php echo $graphics_folder;?>error.png);
}