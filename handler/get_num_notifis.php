<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");


	$id = get_loggedin_user_id();
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT post_id FROM comments WHERE user_id = '{$id}') AND user_id != '{$id}' AND status = 0 OR post_id IN (SELECT post_id FROM requests WHERE user_id = '{$id}') AND user_id != '{$id}' AND status = 0";
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