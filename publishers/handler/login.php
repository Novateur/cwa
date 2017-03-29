<?php
	ob_start();
	require_once("../../includes/db.inc");
	require_once("../../includes/publishers_functions.php");
	
	$email=sanitize($_POST['email']);
	$password=sha1(md5($_POST['password']));
	
	
	$sql="SELECT * FROM users WHERE email='{$email}' AND password='{$password}' AND priviledge='publisher'";
	$query = $connection->query($sql);
	if($query->rowCount()==1)
	{
		$_SESSION['publisher']=$email;
		echo "found";
	}
	else
	{
		echo "error";
	}
?>