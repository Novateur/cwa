<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");

	$id = sanitize($_POST['id']);

	$sql = "SELECT * FROM posts WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<b>Title:</b><br/>
			<input type='hidden' name='id' id='id' value='{$r['id']}' class='form-control'/>
			<input type='text' name='title' id='title' value='{$r['title']}' class='form-control'/><br/>";
			echo "<b>Description:</b><br/>
			<textarea rows='8' name='desc' id='editor' class='form-control'>{$r['post']}</textarea><br/>";
			echo "<b>Content type:</b><br/>
			<select class='form-control' name='type' id='type'>
			<option value='{$r['type_of_content']}'>{$r['type_of_content']}</option>
			<option value='Video'>Video</option>
			<option value='Written'>Written</option>
			</select><br/>";
			echo "<b>Price:</b><br/>
			<input type='text' name='price' id='price' value='{$r['price']}' class='form-control'/><br/>";
		}
	}
	else
	{
			echo "<div class='alert alert-danger'>Post was not found</div>";

	}
?>