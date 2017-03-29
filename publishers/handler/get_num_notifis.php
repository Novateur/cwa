<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");


	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0 AND caused_by = 'writer'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		echo $query->rowCount();
	}
	else
	{
		echo 0;
	}

?>