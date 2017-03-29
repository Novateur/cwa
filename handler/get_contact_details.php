<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$sql = "SELECT phone,email,add1,add2 FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<b>Phone:</b><br/>
			<input type='text' name='phone' id='phone' value='{$r['phone']}' class='form-control'/><br/>";
			echo "<b>Email:</b><br/>
			<input type='email' name='email' id='email' value='{$r['email']}' class='form-control'/><br/>";
			echo "<b>Address:</b><br/>
			<input type='text' name='add1' id='add1' value='{$r['add1']}' class='form-control'/><br/>";
			echo "<b>Address 2:</b><br/>
			<input type='text' name='add2' id='add2' value='{$r['add2']}' class='form-control'/><br/>";
		}
	}
	else
	{
			echo "<div class='alert alert-danger'>User contact details was not found</div>";

	}
?>