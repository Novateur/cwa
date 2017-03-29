<?php	
	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$post_id = $_POST['post_id'];
	$id = get_loggedin_user_id();
	$mydate = date("Y-m-d h:i:s");

	$query=$connection->query("INSERT INTO requests(user_id, post_id, status, date_time) VALUES ('{$id}', '{$post_id}', 0, '{$mydate}')");
	if($query)
	{
		$query2=$connection->query("INSERT INTO notifications(user_id, post_id, action, date_time, status, caused_by) VALUES ('{$id}', '{$post_id}', 'requested', '{$mydate}', 0, 'writer')");
		if($query2)
		{
			echo "sent";
		}
		else
		{
			echo "error";
		}
	}
	else
	{
		echo "Error";
	}

?>
