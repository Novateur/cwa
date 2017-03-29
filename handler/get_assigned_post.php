<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	

	$id = get_loggedin_user_id();
	$sql = "SELECT title,id FROM posts WHERE id IN (SELECT post_id FROM requests WHERE user_id={$id} AND status = 1 AND update_level!='completed')";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo $r['title']."<span style='font-size:22px' class='pull-right'><button type='button' style='background-color: #5fcf80;color:#ffffff' class='btn btn-sm' onclick=\"upload_content({$r['id']})\"><i class='ion-ios-cloud-upload-outline'></i></button></span><br/><br/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger' style='font-size:14px'>Assigned box is empty</div>";
	}

?>