<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	

	$id = sanitize($_POST['user']);
	
	$sql = "SELECT title,id FROM posts WHERE id IN (SELECT post_id FROM contents WHERE user_id={$id} AND status='Accepted')";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo $r['title']."<br/><br/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger' style='font-size:14px'>Written box is empty</div>";
	}

?>