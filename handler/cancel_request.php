<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$user_id = sanitize($_POST['user_id']);
	$post_id = sanitize($_POST['post_id']);

	$query=$connection->exec("DELETE FROM requests WHERE post_id='{$post_id}' AND user_id='{$user_id}'");
	if($query)
	{
		echo "cancelled";
	}
	else
	{
		echo "Error";
	}

?>