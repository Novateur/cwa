<?php
	
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = get_loggedin_user_id();
	$sql = "SELECT title,id FROM posts WHERE id IN (SELECT post_id FROM requests WHERE user_id={$id} AND status = 0)";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo $r['title']."<span style='font-size:22px' class='pull-right'><a href='#' onclick=\"cancel_request({$r['id']},{$id})\"><i class='ion-ios-close-empty'></i></a></span><br/><br/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger' style='font-size:14px'>Request box is empty</div>";
	}

?>