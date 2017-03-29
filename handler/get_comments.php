<?php
	ob_start();
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");
	
	$post_id = $_POST['post_id'];

	
	
	$sql="SELECT * FROM comments WHERE post_id='{$post_id}' ORDER BY id DESC";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<div id='all_comments' style='max-height:400px;overflow:scroll'>";
		foreach($query as $r)
		{
			echo "<div class='comments' style='font-size:13px;background-color: #f2dede;border-color: #eed3d7;padding:7px;border-radius:5px'>";
			echo "<span class='pull-right'><i class='ion-clock'></i> ".get_time_interval($r['date_time'])."</span>";
			echo "<span><img src='uploads/".get_user_dp($r['user_id'])."' class='img-circle' height='35' width='35'/> <b><a href='profile.php?user={$r['user_id']}'>".get_user_name($r['user_id']).":</a> </b></span>";
			echo "<span id='pc{$r['id']}'>".$r['comment']."</span><br/>";
			if(get_loggedin_user_id()==$r['user_id']){ echo "<a href='#' onclick=\"delete_comment({$r['id']},{$post_id},'#p{$post_id}')\"><i class='ion-ios-trash-outline' style='font-size:17px'></i> Delete</a> &nbsp;&nbsp;<a href='#' onclick=\"edit_comment({$r['id']},'{$r['comment']}','#pc{$r['id']}','#p{$post_id}',{$post_id})\"><i class='ion-edit' style='font-size:15px'></i> Edit</a>";}
			echo "</div><br/>";
		}
		echo "</div>";
			echo "<input type='text' onkeyup=\"add_comment(event,this.value,{$post_id},this,'#p{$post_id}')\" class='form-control' placeholder='Share what you feel about this topic...' id='comment' name='comment'/>";
	}
	else
	{
		echo "<input type='text' onkeyup=\"add_comment(event,this.value,{$post_id},this,'#p{$post_id}')\" class='form-control' placeholder='Share what you feel about this topic...' id='comment' name='comment'/>";
	}
?>