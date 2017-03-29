<?php

require_once("../includes/db.inc");
require_once("../includes/functions.php");

	$user_id = get_loggedin_user_id();
	$tmp_file2=$_FILES['file']['tmp_name'];
	$target_file2=basename($_FILES['file']['name']);
	$size=$_FILES['file']['size'];
	$type=$_FILES['file']['type'];
	$post_id=sanitize($_POST['post_id']);
	$notes=sanitize($_POST['notes']);
	$mydate=date("Y-m-d h:i:s");
	$extension=strtolower(substr($target_file2,strpos($target_file2,'.')+1));
	
	if($extension=="pdf" && $type=="application/pdf" && $size<=5000000){
		$new_name= rand(0,10000)."CON".rand(0,10000).".".$extension;
		$upload_dir2="../contents";
		$db_upload=move_uploaded_file($tmp_file2, $upload_dir2."/".$new_name);
		$query=$connection->query("INSERT INTO contents (post_id, user_id, content, date_time, status) VALUES ('{$post_id}', '{$user_id}', '{$new_name}', '{$mydate}', 'Being reviewed')");
		if($query){
			echo "upload";
		}
	}
	else{
		echo "error";
	}
?>