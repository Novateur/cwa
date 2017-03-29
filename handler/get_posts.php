<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");


	$sql_pag="SELECT COUNT(*) FROM posts";
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

	$sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $start, $limit";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default' style='padding:20px'>";
			echo "<span class='pull-right'><i class='ion-clock'></i> ".get_time_interval_sm($r['date_time'])."</span><br/><br/>";
			echo "<span style='font-size:18px'>{$r['title']}</span><small> Posted by <b>".get_user_name($r['publisher_id'])."</b></small><span class='pull-right'>&#8358;".number_format($r['price'])." <span class='label label-warning'>{$r['type_of_content']}</span></span><br/><br/>";
			echo htmlspecialchars_decode($r['post'])."<br/><br/>";
			echo "<span>".get_num_comments($r['id'])." <a href='#' onclick=\"fetch_comments({$r['id']},'#p{$r['id']}')\"><i style='font-size:17px' class='ion-ios-chatboxes-outline'></i> Comments</a></span> &nbsp;&nbsp;";
			if(check_request($r['id']))
			{ 
				echo "<span class='pull-right label label-warning'>Request sent</span><br/><br/>";
			}
			else
			{
				echo "<button class='btn pull-right' style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff' onclick=\"send_request({$r['id']})\">Request</button><br/><br/>";
			}
			echo "<div id='p{$r['id']}' style='display:none'></div>";
			echo "</div>";
		}
		$previous=$page-1;
		$next=$page+1;
		$total_num_pages=ceil($totalpage1/$limit);
		if($total_num_pages>1)
		{										
			if($next<=$total_num_pages)
			{
				echo "<div align='center' id='next_button'><button onclick=\"get_more({$next})\" class='btn' type='button' style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff'>Load more</button><br/><br/></div>";
			}
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>No post found</div>";
	}

?>