<?php
	echo sprintf(__('Thank you for signing up on %s, your information is listed below', true), $site_name) .":\n\n";
	echo __('Username', true) .": ". $user['User']['username'] ."\n";
	echo __('Password', true) .": ". $user['User']['newPassword'] ."\n\n";
	echo __('Enjoy!', true);
?>