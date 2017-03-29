<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");


	$id = get_loggedin_user_id();

	$sql = "UPDATE notifications SET status = 1 WHERE post_id IN (SELECT post_id FROM comments WHERE user_id = '{$id}') AND user_id != '{$id}' OR post_id IN (SELECT post_id FROM requests WHERE user_id = '{$id}') AND user_id != '{$id}'";
	$query = $connection->query($sql);

?>