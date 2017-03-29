<?php

	ob_start();
	require_once("../includes/publishers_functions.php");
	
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>C W A</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../css/animate.css" type="text/css" />
  <link href="../css/examples-offline.css" rel="stylesheet">
      <link href="../css/kendo.common.min.css" rel="stylesheet">
    <link href="../css/kendo.rtl.min.css" rel="stylesheet">
    <link href="../css/kendo.default.min.css" rel="stylesheet">
    <link href="../css/kendo.default.mobile.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="../css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/icon.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />
      <style>
        @import url(//fonts.googleapis.com/css?family=Raleway);
        body {
            font-family:'Raleway', sans-serif;     
            font-size: 13px
        }
    </style>
</head>
<body class="" onload="get_notifs()">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk col-sm-6">

        <a href="index.php" class="navbar-brand">C W A</a>
        
      </div>
      <ul class="nav navbar-nav pull-right">
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="notifications.php"><span class="label label-success" id="paste_num_notifs"></span> <i class="ion-ios-bell-outline"></i> Notifications</a>
          <ul class="dropdown-menu" style="min-width: 450px;max-width: 450px;max-height: 400px" id="paste_notifs_dropdown">

          </ul>
        </li>
        <li style='font-size:15px;background-color: rgba(50,50,50,0.05)'><a href="index.php"><i class="ion-speedometer"></i> Dashboard</a></li>
        <li style='font-size:15px' class="active"><a href="profile.php"><i class="ion-person"></i> Account</a></li>
        <li style='font-size:15px'><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>       
    </header>
    <section>
      <section class="hbox stretch">
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable padder" id="paste_fetched"><br/>
                    <div class="row" style="margin-top:30px"> 
                    </div>
                    <div class="container">
                      <!--<div class="row">
                        <div class="col-md-12"><div class="panel panel-success" style="padding:20px"><span style='font-size:24px'>Welcome back <?php echo get_loggedin_publisher_name();?></span>
                          <span class="pull-right"><?php echo "<img src='../uploads/".get_loggedin_publisher_dp()."' class='img-circle' height='50' width='50'>";?></span></div></div>
                      </div>-->

              <div class="row">              
              	<div class="col-md-2">
              	</div>
              	<div class="col-md-8 panel panel-default" style="padding:30px;padding-bottom:50px">
	              	<form method="post" action="" id="create_post_form">
	              		<h2><i class="ion-edit"></i> Create Post</h2><br/>
	              		<div id="paste_response"></div>
	              		<b>Title:</b><br/>
	              		<input type='text' name='title' id='title' class='form-control' placeholder='Title'/><br/>
	              		<b>Description:</b><br/>
	              		<textarea class="form-control" rows="8" id="editor" name="desc"></textarea><br/>
	              		<b>Type of Content:</b><br/>
	              		<select class="form-control" name="type" id="type">
	              			<option value="">--Select content type--</option>
	              			<option value="Written">Written</option>
	              			<option value="Video">Video</option>
	              		</select><br/>
	              		<b>Price:</b><br/>
	              		<input type='text' name='price' id='price' class='form-control' placeholder='Price'/><br/>
	              		<button class="btn" type="submit" style="background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff">Create post</button>
	              	</form>
              		
              	</div>
              	<div class="col-md-2">
              	</div>
          	  </div>
        </div>
                </section>
              </section>
            </section>

          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/jszip.min.js"></script>
  <script src="../js/kendo.all.min.js"></script>
  <script src="../js/console.js"></script>
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="../js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="../js/app.plugin.js"></script>
  <script>
  	$(document).ready(function() {
        // create Editor from textarea HTML element with default set of tools
        $("#editor").kendoEditor({ resizable: {
            content: true,
            toolbar: true
        }});
    });

        setInterval(get_notifs,1000);

    function get_notifs()
    {
      $.get("handler/get_num_notifis.php",function(response){
          $('#paste_num_notifs').html(response);
        });

        $.get("handler/get_notifs_dropdown.php",function(response){
          $('#paste_notifs_dropdown').html(response);
        })
    }

    $('#create_post_form').submit(function(e){
    	e.preventDefault();
    	var title,desc,type,price;
    	title = $('#title').val();
    	desc = $('#editor').val();
    	type = $('#type').val();
    	price = $('#price').val();

    	if(price=="" || title=="" || desc=="" || type=="")
    	{
    		if(price=="")
    		{
    			document.getElementById("price").style.border="1px solid red";
    			document.getElementById("price").style.borderLeft="5px solid red";
    		}
    		if(type=="")
    		{
    			document.getElementById("type").style.border="1px solid red";
    			document.getElementById("type").style.borderLeft="5px solid red";
    		}
    		if(desc=="")
    		{
    			document.getElementById("editor").style.border="1px solid red";
    			document.getElementById("editor").style.borderLeft="5px solid red";
    		}
    		if(title=="")
    		{
    			document.getElementById("title").style.border="1px solid red";
    			document.getElementById("title").style.borderLeft="5px solid red";
    		}
    	}
    	else
    	{
    		$.ajax({
	            url:"handler/create_post.php",
	            type:"POST",
	            data: new FormData(this),
	            cache:false,
	            contentType:false,
	            processData:false,
	            success:function(data)
	            {
	              if(data=="created")
	              {
	              	$('#title').val("");
          				$('#editor').html("");
          				$('#type').val("");
          				$('#price').val("");
	               	$('#paste_response').html("<div class='alert alert-success alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>You have successfully created a post | <a href='posts.php'>View posts</a></b></div>");
	              }
	              else
	              {
	                $('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Invalid Username/Password Combination</b></div>");
	              }
	            }
          	})
    	}
    });
  </script>
</body>
</html>