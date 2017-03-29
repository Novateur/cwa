<?php

	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");


	$id = get_loggedin_publisher_id();

	$sql_pag="SELECT COUNT(*) FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND caused_by = 'writer'";
	$totalpage=$connection->query($sql_pag);
	$totalpage->setFetchMode(PDO::FETCH_ASSOC);
	foreach($totalpage as $t)
	{
		$totalpage1=array_shift($t);
	}
	$limit=15;
	$page=$_GET['page'];
	if($page)
	{
		$start=($page-1) * $limit;
	}
	else
	{
		$start=0;
	}
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND caused_by = 'writer' ORDER BY id DESC LIMIT $start, $limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<a href='notification_post.php?post_ref={$r['post_id']}'><div class='panel panel-default' style='padding:15px'>
			<span class='pull-right'>".get_time_interval_sm($r['date_time'])."</span><br/>
			<img src='../uploads/".get_user_dp($r['user_id'])."' height='50' width='50'/> <b>".get_user_name($r['user_id'])." </b>";
			if($r['action']=="commented")
			{
				echo "commented on your post";
			}
			if($r['action']=="requested")
			{
				echo "requested to write on your post";
			}
			echo "</div></a>";
		}
		$previous=$page-1;
		$next=$page+1;
		$total_num_pages=ceil($totalpage1/$limit);
		if($total_num_pages>1)
		{										
			if($next<=$total_num_pages)
			{
				echo "<div align='center' id='next_button'><button onclick=\"get_more({$next})\" class='btn' type='button' style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff'>Load more</button></div>";
			}
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>You currently have no new notification</div>";
	}

?>