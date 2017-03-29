<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$title = sanitize($_POST['title']);
	$desc = sanitize_desc($_POST['desc']);
	$type = sanitize($_POST['type']);
	$price = sanitize($_POST['price']);
	$id = get_loggedin_publisher_id();
	$mydate = date("Y-m-d h:i:s");

	$query=$connection->exec("INSERT INTO posts(title, post, publisher_id, type_of_content,price,date_time) VALUES ('{$title}', '{$desc}', {$id}, '{$type}', '{$price}', '{$mydate}')");
	if($query)
	{
		echo "created";

	}
	else
	{
		echo "Error";
	}

?>