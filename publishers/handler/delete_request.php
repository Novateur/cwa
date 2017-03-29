<?php
	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$id = sanitize($_POST['id']);

	$query=$connection->query("DELETE FROM requests WHERE id={$id}");
	if($query)
	{
		echo "removed";
	}
	else
	{
		echo "error";
	}

?>