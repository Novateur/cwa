<?php
session_start();
require_once("db.inc");

function sanitize($input)
{
	$my_input=htmlspecialchars(addslashes(trim($input)));
	return $my_input;
}

function sanitize_desc($input)
{
	$my_input= addslashes(trim($input));
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

function get_loggedin_publisher_dp()
{
	global $connection;
	$sql = "SELECT photo FROM users WHERE email='{$_SESSION['publisher']}'";
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
		return "Publisher photo not found";
	}
}

function get_loggedin_publisher_name()
{
	global $connection;
	$sql = "SELECT name FROM users WHERE email='{$_SESSION['publisher']}'";
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
		return "Publisher name not found";
	}
}

function get_loggedin_publisher_id()
{
	global $connection;
	$sql = "SELECT id FROM users WHERE email='{$_SESSION['publisher']}'";
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
		return "Publisher id not found";
	}
}

function check_request($id)
{
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id='{$id}'";
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

function get_post_title($id)
{
	global $connection;
	$sql = "SELECT title FROM posts WHERE id={$id}";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['title'];
		}
	}
	else
	{
		return "Post title was not found";
	}
}

function get_user_username($id)
{
	global $connection;
	$sql = "SELECT username FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			return $r['username'];
		}
	}
	else
	{
		return "Username was not found";
	}
}

function get_requests()
{
	$id = get_loggedin_user_id();
	global $connection;
	$sql = "SELECT title,id FROM posts WHERE id IN (SELECT post_id FROM requests WHERE user_id={$id})";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo $r['title']."<span style='font-size:22px' class='pull-right'><a href='#' onclick=\"cancel_request({$r['id']},{$id})\"><i class='ion-ios-close-empty'></i></a></span><br/><br/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger' style='font-size:14px'>Request box is empty</div>";
	}
}

function get_num_posts()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM posts WHERE publisher_id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}
	else
	{
		return 0;
	}
}

function get_num_requests()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}
	else
	{
		return 0;
	}
}

function get_num_assigned_posts()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 1";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}
	else
	{
		return 0;
	}
}

function get_num_contents()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM contents WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}')";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}
	else
	{
		return 0;
	}
}

function get_num_notifications()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0 AND caused_by = 'writer'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		return $query->rowCount();
	}
	else
	{
		return 0;
	}
}

function get_num_notifications_dropdown()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM notifications WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0 AND caused_by = 'writer' ORDER BY id DESC LIMIT 0,10";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<li style='text-align:left'><a href='notification_post.php?post_ref={$r['post_id']}'><img src='../uploads/".get_user_dp($r['user_id'])."' height='40' width='40'/> <b>".get_user_name($r['user_id'])." </b>";
			if($r['action']=="commented")
			{
				echo "commented on your post";
			}
			if($r['action']=="requested")
			{
				echo "requested to write on your post";
			}
			echo "</a></li>";
		}
	}
	else
	{
		echo "<li><a>You have no new notification</a></li>";
	}
}

function get_publisher_posts()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM posts WHERE publisher_id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table id='grid-basic' class='table table-condensed table-hover table-striped table-bordered' style='border-radius:7px'>
			<thead>
				<tr>
				<th data-column-id='title'><b>Title</b></th>
				<th data-column-id='post'><b>Description</b></th>
				<th data-column-id='type_of_content'><b>Type</b></th>
				<th data-column-id='price'><b>Price</b></th>
				<th data-column-id='date_time'><b>Date created</b></th>
				<th><b>Edit</b></th>
				<th><b>Delete</b></th>
				</tr>
			</thead>
			<tbody>";
		foreach($query as $r)
		{	echo "<tr id='t{$r['id']}'>
			<td>{$r['title']}</td>
			<td>".htmlspecialchars_decode(substr($r['post'], 0, 100))."...</td>
			<td>{$r['type_of_content']}</td>
			<td>&#8358;".number_format($r['price'])."</td>
			<td>{$r['date_time']}</td>
			<td><button type='button' data-toggle='tooltip' title='Edit post' onclick=\"edit_post({$r['id']})\" class='btn btn-sm' style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff'><i class='ion-edit'></i></button></td>
			<td><button type='button' data-toggle='tooltip' title='Delete post' onclick=\"delete_post({$r['id']},'#t{$r['id']}')\" class='btn btn-sm btn-danger'><i class='ion-ios-trash-outline'></i></button></td>
			</tr>";
		}
		echo "</tbody>
		</table>";
	}
	else
	{
		return "<div class='alert alert-danger'>No post found</div>";
	}
}

function get_publisher_requests()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 0";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table id='grid-basic' class='table table-condensed table-hover table-striped table-bordered' style='border-radius:7px'>
			<thead>
				<tr>
				<th><b>Post title</b></th>
				<th><b>Requested user</b></th>
				<th><b>Date requested</b></th>
				<th><b>Operation</b></th>
				</tr>
			</thead>
			<tbody>";
		foreach($query as $r)
		{	echo "<tr id='t{$r['id']}'>
			<td>".get_post_title($r['post_id'])."</td>
			<td><a href='writer_profile.php?user={$r['user_id']}'>".get_user_name($r['user_id'])."</a></td>
			<td>{$r['date_time']}</td>
			<td>
				<span><button type='button' data-toggle='tooltip' title='Reject request' onclick=\"reject_request({$r['id']},this)\" class='btn btn-sm btn-danger'><i class='ion-ios-trash-outline'></i></button></span>
				<span><button type='button' data-toggle='tooltip' title='Accept request' onclick=\"accept_request({$r['id']},this)\" class='btn btn-sm btn-default'><i class='ion-checkmark-round'></i></button></span>
			</td>
			</tr>";
		}
		echo "</tbody>
		</table>";
	}
	else
	{
		echo "<div class='alert alert-danger'><h4>You have no request</h4></div>";
	}
}

function list_requests($id)
{
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id = '{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach ($query as $r)
		{
			echo "<a href='writer_profile.php?user={$r['user_id']}'><img src='../uploads/".get_user_dp($r['user_id'])."' class='img-circle' height='35' width='35'/> ".get_user_name($r['user_id'])."</a><br/>";
		}
	}
	else
	{
		echo "<div class='alert alert-danger'>You have no request yet</div>";
	}
}

function get_publisher_assigned_posts()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM requests WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}') AND status = 1";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table id='grid-basic' class='table table-condensed table-hover table-striped table-bordered' style='border-radius:7px'>
			<thead>
				<tr>
				<th><b>Post title</b></th>
				<th><b>Requested user</b></th>
				<th><b>Date requested</b></th>
				<th><b>Status</b></th>
				<th><b>Update status</b></th>
				</tr>
			</thead>
			<tbody>";
		foreach($query as $r)
		{	echo "<tr id='t{$r['id']}'>
			<td>".get_post_title($r['post_id'])."</td>
			<td><a href='writer_profile.php?user={$r['user_id']}'>".get_user_name($r['user_id'])."</a></td>
			<td>{$r['date_time']}</td>
			<td><span class='label label-danger'>{$r['update_level']}</span></td>
			<td>
				<span><button type='button' data-toggle='tooltip' title='Set progress status' onclick=\"update_level({$r['id']})\" class='btn btn-sm btn-default'><i class='ion-compose'></i></button></span>
			</td>
			</tr>";
		}
		echo "</tbody>
		</table>";
	}
	else
	{
		echo "<div class='alert alert-danger'><h4>You have not assigned any request</h4></div>";
	}
}

function get_publisher_contents()
{
	$id = get_loggedin_publisher_id();
	global $connection;
	$sql = "SELECT * FROM contents WHERE post_id IN (SELECT id FROM posts WHERE publisher_id='{$id}')";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		echo "<table id='grid-basic' class='table table-condensed table-hover table-striped table-bordered' style='border-radius:7px'>
			<thead>
				<tr>
				<th><b>Post title</b></th>
				<th><b>Assigned writer</b></th>
				<th><b>File name</b></th>
				<th><b>Date submitted</b></th>
				<th><b>Status</b></th>
				<th><b>Operations</b></th>
				</tr>
			</thead>
			<tbody>";
		foreach($query as $r)
		{	echo "<tr id='t{$r['id']}'>
			<td>".get_post_title($r['post_id'])."</td>
			<td><a href='writer_profile.php?user={$r['user_id']}'>".get_user_name($r['user_id'])."</a></td>
			<td>{$r['content']}</td>
			<td>{$r['date_time']}</td>";
			if($r['status']=="Being reviewed")
			{
				echo "<td><span class='label label-danger'>{$r['status']}</span></td>";
			}
			else
			{
				echo "<td><span class='label label-success'>{$r['status']}</span></td>";
			}
			
			echo "<td>";
				if($r['status']!="Accepted")
				{
					echo "<span><button type='button' data-toggle='tooltip' title='Accept content' onclick=\"accept_content({$r['id']},'{$r['post_id']}','{$r['user_id']}')\" class='btn btn-sm btn-default'><i class='ion-checkmark-round'></i></button></span>";
				}
				echo " <span><button type='button' data-toggle='tooltip' title='Make a report' onclick=\"send_report()\" class='btn btn-sm btn-danger'><i class='ion-speakerphone'></i></button></span>
				<span><a href='download.php?file={$r['content']}' data-role='button' data-toggle='tooltip' title='Download content' class='btn btn-sm btn-success'><i class='fa fa-cloud-download'></i></a></span>
			</td>
			</tr>";
		}
		echo "</tbody>
		</table>";
	}
	else
	{
		echo "<div class='alert alert-danger'><h4>You have no submitted content(s) yet</h4></div>";
	}
}

function get_publisher_details()
{
	global $connection;
	$sql = "SELECT * FROM users WHERE email='{$_SESSION['publisher']}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Publisher Details</span><span class='pull-right'><a href='#' onclick=\"edit_publisher_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>";
				echo "</div>";
				echo "<div class='panel-body' style='font-size:14px'>
				<b>Name: </b>{$r['name']}<br/><br/>
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
				<span style='font-size:18px'>Personal Details</span><span class='pull-right'><a href='#' onclick=\"edit_personal_details()\"><i class='ion-edit' style='font-size:17px'></i></a></span>
				</div>";
				echo "<div class='panel-body' style='font-size:15px'>
					<div class='alert alert-danger'>User personal details was not found</div>
				</div>";
			echo "</div>";
	}
}

function get_personal_details($id)
{
	global $connection;
	$sql = "SELECT id,name,gender,title,state_origin FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Personal Details</span>";
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
	$sql = "SELECT qualifications FROM users WHERE id='{$id}'";
	$query = $connection->query($sql);
	if($query->rowCount() > 0)
	{
		$query->setFetchMode(PDO::FETCH_ASSOC);
		foreach($query as $r)
		{
			echo "<div class='panel panel-default'>";
				echo "<div class='panel-heading'>
				<span style='font-size:18px'>Summary Details</span>";
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
			echo "<h4><a href='requests.php'>Requests</a></h4>";
			list_requests($r['id']);
			echo "<br/>";
			echo "<span>".get_num_comments($r['id'])." <a href='#' onclick=\"fetch_comments({$r['id']},'#p{$r['id']}')\"><i style='font-size:17px' class='ion-ios-chatboxes-outline'></i> Comments</a></span> &nbsp;&nbsp;";
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