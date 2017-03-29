<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$summary = sanitize($_POST['summary']);

	$query=$connection->query("UPDATE users SET qualifications='{$summary}' WHERE email='{$_SESSION['user']}'");
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "Error";
	}

?>