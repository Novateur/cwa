<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");


	$id = get_loggedin_publisher_id();
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0 AND caused_by = 'writer' ORDER BY id DESC LIMIT 0,10";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<li style='text-align:left'><a href='notification_post.php?post_ref={$r['post_id']}'><img src='../uploads/".get_user_dp($r['user_id'])."' height='40' width='40'/> <b>".get_user_name($r['user_id'])." </b>";
			if($r['action']=="commented")
			{
				echo "commented on your post";
			}
			if($r['action']=="requested")
			{
				echo "requested to write on your post";
			}
			echo "</a></li>";
		}
		echo "<hr/>
        <li><a href='notifications.php'>View all</a></li>";
	}
	else
	{
		echo "<li><a>You have no new notification</a></li>";
		echo "<hr/>
        <li><a href='notifications.php'>View all</a></li>";
	}


?>