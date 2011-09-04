<?php
/**
 * 
 * Private Hosted Solution
 * 
 * 
 * 0: The private settings are turned off
 * 1: The private settings are turned on
 * 
*/
	$config['FGM']['private_solution'] = 0;

/**
 * Allow users to change items that they do not own. Note: They cannot delete items when this is set to 1. Use group_delete to allow this. 
 * 0: The user can't change items from other users
 * 1: The user can change items from other users
 * 
*/
	$config['FGM']['group_change'] = 0;

/**
 * Allow users to delete items that they do not own.
 * 0: The user can't delete items from other users
 * 1: The user can delete items from other users
 * 
*/
	$config['FGM']['group_delete'] = 0;
	
/**
 * Allow users to rate items.
 * 0: Hide the rating component globally
 * 1: Show the rating component globally
 * 
*/
	$config['FGM']['allow_rating'] = 0;


		
/**
 * Allows users to flag items.
 * 
*/
	$config['FGM']['allow_flagging'] = 1;
	

/**
 * 
 * Advertising
 * 
 * 
 * 0: Disable ads
 * 1: Show ads
 * 
*/
	$config['FGM']['advertising'] = 0;

/**
 * 
 * Social share buttons
 * 
 * 
 * 0: Disable social share buttons
 * 1: Enable buttons
 * 
*/
	$config['FGM']['social_sharing'] = 0;
	
/**
 * TESTING: This is used for testing without an internet connection.
 * It basically removes the google Javascript calls and uses local versions of the Js files.
*/
	$config['FGM']['local'] = false;


?>