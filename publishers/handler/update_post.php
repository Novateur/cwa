<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$title = sanitize($_POST['title']);
	$desc = sanitize_desc($_POST['desc']);
	$type = sanitize($_POST['type']);
	$price = sanitize($_POST['price']);
	$id = sanitize($_POST['id']);

	$sql = "UPDATE posts SET title='{$title}', post='{$desc}', type_of_content='{$type}', price='{$price}' WHERE id={$id}";
	$query = $connection->query($sql);
	if($query)
	{
		echo "updated";
	}
	else
	{
		echo "Error: could not update post, try again later";
	}
?>