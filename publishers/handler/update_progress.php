<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");


	$val = sanitize($_POST['val']);
	$prog = sanitize($_POST['prog']);

	$sql = "UPDATE requests SET update_level='{$prog}' WHERE id = {$val}";
	$query = $connection->query($sql);
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "error";
	}

?>