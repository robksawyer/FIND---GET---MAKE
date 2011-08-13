<?php
/*
	CHANGED This is a custom model that I added.
	This fixed the following error.
	* Error: Database table forum_homes for model Home was not found.
*/
class Search extends ForumAppModel {
	var $useTable = false;
}
?>