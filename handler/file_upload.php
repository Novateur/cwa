<?php

session_start();
require_once("../includes/db.inc");

	$tmp_file2=$_FILES['file1']['tmp_name'];
	$target_file2=basename($_FILES['file1']['name']);
	$size=$_FILES['file1']['size'];
	$type=$_FILES['file1']['type'];
	$extension=strtolower(substr($target_file2,strpos($target_file2,'.')+1));
	
	if($extension=="jpg" || $extension=="jpeg" && $type=="image/jpeg" && $size<=2000000){
		$upload_dir2="../uploads";
		$db_upload=move_uploaded_file($tmp_file2, $upload_dir2."/".$target_file2);
		$query=$connection->query("UPDATE users SET photo='{$target_file2}' WHERE email='{$_SESSION['user']}'");
		if($query){
			echo "Your upload was successful";
		}
	}
	else{
		echo "An error occurred";
	}
?>