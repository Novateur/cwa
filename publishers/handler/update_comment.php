<?php
	ob_start();
	require_once("../../includes/db.inc");
	require_once("../../includes/functions.php");
	
	$val = sanitize($_POST['val']);
	$id = sanitize($_POST['id']);
	
	
	$sql="UPDATE comments SET comment='{$val}' WHERE id={$id}";
	$query = $connection->exec($sql);
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "error";
	}
?>