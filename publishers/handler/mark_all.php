<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");


	$id = get_loggedin_publisher_id();

	$sql = "UPDATE notifications SET status = 1 WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND caused_by='writer'";
	$query = $connection->query($sql);

?>