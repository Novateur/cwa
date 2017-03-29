<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$name = sanitize($_POST['name']);
	$gender = sanitize($_POST['gender']);
	$title = sanitize($_POST['title']);
	$state_orign = sanitize($_POST['state_origin']);

	$query=$connection->query("UPDATE users SET name='{$name}', gender='{$gender}', title='{$title}', state_origin='{$state_orign}' WHERE email='{$_SESSION['user']}'");
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "Error";
	}

?>