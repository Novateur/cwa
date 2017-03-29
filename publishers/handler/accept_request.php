<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$id = sanitize($_POST['id']);

	$sql = "UPDATE requests SET status = 1,update_level = 'Assigned' WHERE id={$id}";
	$query = $connection->query($sql);

	if($query)
	{
		echo "accepted";
	}
	else
	{
		echo "error";
	}
?>