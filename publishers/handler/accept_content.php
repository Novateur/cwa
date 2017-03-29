<?php
	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$id = sanitize($_POST['id']);
	$post_id = sanitize($_POST['post_id']);
	$user_id = sanitize($_POST['user_id']);

	$query=$connection->query("UPDATE contents SET status='Accepted' WHERE id={$id}");
	if($query)
	{
		$query2=$connection->query("UPDATE requests SET update_level='completed' WHERE post_id='{$post_id}' AND user_id='{$user_id}'");
		if($query2)
		{	
			echo "accepted";
		}
		else
		{
			echo "query2 error";
		}
	}
	else
	{
		echo "error";
	}

?>