<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$id = get_loggedin_user_id();
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT post_id FROM comments WHERE user_id = '{$id}') AND user_id != '{$id}' AND status = 0 OR post_id IN (SELECT post_id FROM requests WHERE user_id = '{$id}') AND user_id != '{$id}' AND status = 0 ORDER BY id DESC LIMIT 0,10";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<li style='text-align:left'><a href='notification_post.php?post_ref={$r['post_id']}'><img src='uploads/".get_user_dp($r['user_id'])."' height='40' width='40'/> <b>".get_user_name($r['user_id'])." </b>";
			if($r['action']=="commented")
			{
				echo "also commented on the post<br/> you commented on/ requested to write on";
			}
			if($r['action']=="requested")
			{
				echo "also requested to write on the post<br/> you commented on/ requested to write on";
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