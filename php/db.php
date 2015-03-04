<?php
	// This file link to the database
	if(!mysql_connect("localhost", "root", "") or  !(mysql_select_db("srs"))){
		die("Could not able to connect to database! Please try again later!");
	}
	//Setting Time to local
	date_default_timezone_set('asia/calcutta');
?>