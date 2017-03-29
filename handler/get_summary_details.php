<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$sql = "SELECT qualifications FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<b>Summary:</b><br/>
			<textarea class='form-control' rows='10' name='summary' id='summary'>{$r['qualifications']}</textarea>";
		}
	}
	else
	{
			echo "<div class='alert alert-danger'>User summary was not found</div>";

	}
?>