<?php
	
	$file = $_GET['file'];
	
	header('Content-type: application/octet-stream');
	header('Content-Disposition: attachment;filename="'.$file.'"');
	readfile('../contents/'.$file);
	exit();
	
?>