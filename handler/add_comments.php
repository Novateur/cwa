<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$val = sanitize($_POST['val']);
	$post_id = sanitize($_POST['post_id']);
	$id = get_loggedin_user_id();
	$mydate = date("Y-m-d h:i:s");


	$query=$connection->query("INSERT INTO comments(user_id, post_id, comment, date_time) VALUES ('{$id}', '{$post_id}', '{$val}', '{$mydate}')");
	if($query)
	{
		$query2=$connection->query("INSERT INTO notifications(user_id, post_id, action, date_time, status, caused_by) VALUES ('{$id}', '{$post_id}', 'commented', '{$mydate}', 0, 'writer')");
		if($query2)
		{
			echo "inserted";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "Error";
	}

?>