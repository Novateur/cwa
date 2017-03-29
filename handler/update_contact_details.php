<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$phone = sanitize($_POST['phone']);
	$add1 = sanitize($_POST['add1']);
	$add2 = sanitize($_POST['add2']);

	$query=$connection->query("UPDATE users SET phone='{$phone}', add1='{$add1}', add2='{$add2}' WHERE email='{$_SESSION['user']}'");
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "Error";
	}

?>