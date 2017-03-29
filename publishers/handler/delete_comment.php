<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");

	$id = sanitize($_POST['comment_id']);

	$query=$connection->exec("DELETE FROM comments WHERE id='{$id}'");
	if($query)
	{
		echo "deleted";
	}
	else
	{
		echo "Error";
	}

?>