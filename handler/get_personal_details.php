<?php

	require_once("../includes/db.inc");
	require_once("../includes/functions.php");

	$sql = "SELECT name,gender,title,state_origin FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<b>Title:</b><br/>
			<select name='title' id='title' class='form-control'>
				<option value='{$r['title']}'>{$r['title']}</option>
				<option value='Mrs'>Mrs</option>
				<option value='Doc'>Doc</option>
				<option value='Prof'>Prof</option>
				<option value='Engr'>Engr</option>
			</select><br/>";
			echo "<b>Name:</b><br/>
			<input type='text' name='name' id='name' value='{$r['name']}' class='form-control'/><br/>";
			echo "<b>Gender:</b><br/>
			<select name='gender' id='gender' class='form-control'>
				<option value='{$r['gender']}'>{$r['gender']}</option>
				<option value='Male'>Male</option>
				<option value='Female'>Female</option>
			</select><br/>";
			echo "<b>State of Origin:</b><br/>
			<select name='state_origin' id='state_origin' class='form-control'>
				<option value='{$r['state_origin']}'>{$r['state_origin']}</option>
				<option value='Abia'>Abia</option>
				<option value='Adamawa'>Adamawa</option>
				<option value='Anambara'>Anambara</option>
				<option value='Bauchi'>Bauchi</option>
				<option value='Benue'>Benue</option>
				<option value='Cross-River'>Cross-River</option>
			</select><br/>";
		}
	}
	else
	{
			echo "<div class='alert alert-danger'>User personal details was not found</div>";

	}
?>