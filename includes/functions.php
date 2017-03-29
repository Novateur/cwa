<?php
session_start();
require_once("db.inc");

function sanitize($input)
{
	$my_input=htmlspecialchars(addslashes(trim($input)));
	return $my_input;
}
function sanitize_content($input)
{
	$my_input = strip_tags(addslashes(trim($input)));
	return $my_input;
}

function get_time_interval_sm($date){
	$mydate=date("Y-m-d h:i:s");
	$theDiff="";
	$datetime1 = date_create($date);
	$datetime2 = date_create($mydate);
	$interval = date_diff($datetime1, $datetime2);
	$min = $interval->format('%i');
	$sec = $interval->format('%s');
	$hour = $interval->format('%h');
	$mon = $interval->format('%m');
	$day = $interval->format('%d');
	$year = $interval->format('%y');
	if($interval->format('%i%h%d%m%y')=="00000"){
		if($sec<10){
			return "just now";
		}
		else{
			return $sec." seconds ago ";
		}
	}
	else if($interval->format('%h%d%m%y')=="0000"){
		if($min==1){
			return $min." minute ago";
		}
		else{
			return $min." minutes ago";
		}
	}
	else if($interval->format('%d%m%y')=="000"){
		if($hour==1){
			return $hour." hour ago";
		}
		else{
			return $hour." hours ago";
		}
	}
	else if($interval->format('%m%y')=="00"){
		if($day==1){
			return "Yesterday";
		}
		else if($day < 7){
			return $day." days ago";
		}
		else if($day==7){
			return "1 week ago";
		}
		else if($day < 14){
			$rem_day = $day-7;
			return "1 week ".$rem_day." days ago";
		}
		else if($day==14){
			return "2 weeks ago";
		}
		else if($day<21){
			$rem_day = $day-14;
			return "2 weeks ".$rem_day." days ago";
		}
		else if($day==21){
			return "3 weeks ago";
		}
		else{
			$rem_day = $day-21;
			return "3 weeks ".$rem_day." days ago";
		}
	}
	else if($interval->format('%y')=="0"){
		if($mon==1){
			return $mon." month ago";
		}
		else{
			return $mon." months ago";
		}
	}
	else{
		if($year==1){
			return $year." year";
		}
		else{
			return $year." years ago";
		}
	}
}

function get_time_interval($date){
	$mydate=date("Y-m-d h:i:s");
	$theDiff="";
	$datetime1 = date_create($date);
	$datetime2 = date_create($mydate);
	$interval = date_diff($datetime1, $datetime2);
	$min = $interval->format('%i');
	$sec = $interval->format('%s');
	$hour = $interval->format('%h');
	$mon = $interval->format('%m');
	$day = $interval->format('%d');
	$year = $interval->format('%y');
	if($interval->format('%i%h%d%m%y')=="00000"){
		if($sec<10){
			return "just now";
		}
		else{
			return $sec." secs";
		}
	}
	else if($interval->format('%h%d%m%y')=="0000"){
		if($min==1){
			return $min." min";
		}
		else{
			return $min." mins ";
		}
	}
	else if($interval->format('%d%m%y')=="000"){
		if($hour==1){
			return $hour." hr";
		}
		else{
			return $hour." hrs";
		}
	}
	else if($interval->format('%m%y')=="00"){
		if($day==1){
			return "Yesterday";
		}
		else if($day < 7){
			return $day." days";
		}
		else if($day==7){
			return "1 wk";
		}
		else if($day < 14){
			$rem_day = $day-7;
			return "1 wk ".$rem_day." days";
		}
		else if($day==14){
			return "2 wks ago";
		}
		else if($day<21){
			$rem_day = $day-14;
			return "2 wks ".$rem_day." days";
		}
		else if($day==21){
			return "3 wks";
		}
		else{
			$rem_day = $day-21;
			return "3 weeks ".$rem_day." days";
		}
	}
	else if($interval->format('%y')=="0"){
		if($mon==1){
			return $mon." mth";
		}
		else{
			return $mon." mths";
		}
	}
	else{
		if($year==1){
			return $year." yr";
		}
		else{
			return $year." yrs";
		}
	}
}

function get_loggedin_user_dp()
{
	global $connection;
	$sql = "SELECT photo FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['photo'];
		}
	}
	else
	{
		return "User photo not found";
	}
}

function get_loggedin_user_email()
{
	global $connection;
	$sql = "SELECT email FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['email'];
		}
	}
	else
	{
		return "User email not found";
	}
}

function get_loggedin_user_id()
{
	global $connection;
	$sql = "SELECT id FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['id'];
		}
	}
	else
	{
		return "User id not found";
	}
}

function get_loggedin_user_name()
{
	global $connection;
	$sql = "SELECT name FROM users WHERE email='{$_SESSION['user']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['name'];
		}
	}
	else
	{
		return "User's name not found";
	}
}

function check_request($id)
{
	$user_id = get_loggedin_user_id();
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id = '{$id}' AND user_id = '{$user_id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_user_dp($id)
{
	global $connection;
	$sql = "SELECT photo FROM users WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['photo'];
		}
	}
	else
	{
		return "User photo not found";
	}
}

function get_user_name($id)
{
	global $connection;
	$sql = "SELECT name FROM users WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['name'];
		}
	}
	else
	{
		return "User name not found";
	}
}

function get_num_comments($id)
{
	global $connection;
	$sql = "SELECT * FROM comments WHERE post_id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		echo $query->rowCount();
	}
	else
	{
		echo "";
	}
}

function check_user_exist($id)
{
	global $connection;
	$sql = "SELECT * FROM users WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function check_post_exist($id)
{
	global $connection;
	$sql = "SELECT * FROM posts WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

function get_personal_details($id)
{
	global $connection;
	$sql = "SELECT email,name,gender,title,state_origin FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Personal Details</span>";
				if(isset($_SESSION['user']))
				{
					if($r['email']==$_SESSION['user'])
					{
						echo "<span class='pull-right'><a href='#' class='btn' data-toggle='tooltip' title='Edit personal details' onclick=\"edit_personal_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>";
					}
				}
				echo "</div>";
				echo "<div class='panel-body' style='font-size:14px'>
				<b>Title: </b>{$r['title']}<br/><br/>
				<b>Name: </b>{$r['name']}<br/><br/>
				<b>Gender: </b>{$r['gender']}<br/><br/>
				<b>State of Origin: </b>{$r['state_origin']}<br/>
				</div>";
			echo "</div>";
		}
	}
	else
	{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Personal Details</span><span class='pull-right'><a href='#' onclick=\"edit_personal_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>
				</div>";
				echo "<div class='panel-body' style='font-size:15px'>
					<div class='alert alert-danger'>User personal details was not found</div>
				</div>";
			echo "</div>";
	}
}

function get_contact_details($id)
{
	global $connection;
	$sql = "SELECT phone,email,add1,add2 FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Contact Details</span>";
				if(isset($_SESSION['user']))
				{
					if($r['email']==$_SESSION['user'])
					{
						echo "<span class='pull-right'><a href='#' data-toggle='tooltip' title='Edit contact details' onclick=\"edit_contact_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>";
					}
				}
				echo "</div>";
				echo "<div class='panel-body' style='font-size:14px'>
				<b>Phone: </b>{$r['phone']}<br/><br/>
				<b>Email: </b>{$r['email']}<br/><br/>
				<b>Address: </b>{$r['add1']}<br/><br/>
				<b>Address 2: </b>{$r['add2']}<br/>
				</div>";
			echo "</div>";
		}
	}
	else
	{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Contact Details</span><span class='pull-right'><a href='#' onclick=\"edit_contact_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>
				</div>";
				echo "<div class='panel-body' style='font-size:15px'>
					<div class='alert alert-danger'>User contact details was not found</div>
				</div>";
			echo "</div>";
	}
}

function get_qualification_details($id)
{
	global $connection;
	$sql = "SELECT email,qualifications FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Summary Details</span>";
				if(isset($_SESSION['user']))
				{
					if($r['email']==$_SESSION['user'])
					{
						echo "<span class='pull-right'><a href='#' data-toggle='tooltip' title='Edit summary details' onclick=\"edit_qualification_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>";
					}
				}
				echo "</div>";
				echo "<div class='panel-body' style='font-size:14px'>
				<b>Summary: </b>{$r['qualifications']}<br/><br/>
				</div>";
			echo "</div>";
		}
	}
	else
	{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Summary Details</span><span class='pull-right'><a href='#' onclick=\"edit_summary_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>
				</div>";
				echo "<div class='panel-body' style='font-size:15px'>
					<div class='alert alert-danger'>User summary details was not found</div>
				</div>";
			echo "</div>";
	}
}


function get_posts_notif($id)
{
	global $connection;
	$sql = "SELECT * FROM posts WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default' style='padding:20px'>";
			echo "<span class='pull-right'><i class='ion-clock'></i> ".get_time_interval_sm($r['date_time'])."</span><br/><br/>";
			echo "<span style='font-size:18px'>{$r['title']}</span><small> Posted by <b>".get_user_name($r['publisher_id'])."</b></small><span class='pull-right'>&#8358;".number_format($r['price'])." <span class='label label-warning'>{$r['type_of_content']}</span></span><br/><br/>";
			echo htmlspecialchars_decode($r['post'])."<br/><br/>";
			echo "<span>".get_num_comments($r['id'])." <a href='#' onclick=\"fetch_comments({$r['id']},'#p{$r['id']}')\"><i style='font-size:17px' class='ion-ios-chatboxes-outline'></i> Comments</a></span> &nbsp;&nbsp;";
			if(check_request($r['id']))
			{ 
				echo "<span class='pull-right label label-warning'>Request sent</span><br/><br/>";
			}
			else
			{
				echo "<button class='btn pull-right' style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff' onclick=\"send_request({$r['id']})\">Request</button><br/><br/>";
			}
			echo "<div id='p{$r['id']}' style='display:none'></div>";
			echo "</div>";
		}
	}
	else
	{
		return "<div class='alert alert-danger'>No post found</div>";
	}
}

?>