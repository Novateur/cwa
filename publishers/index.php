<?php

	ob_start();
	require_once("../includes/publishers_functions.php");

	if(!isset($_SESSION['publisher']))
  	{
    	header("location:login.php");
  	}
	
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
                      <div class="row">
                        <div class="col-md-12"><div class="panel panel-success" style="padding:20px"><span style='font-size:24px'>Welcome back <?php echo get_loggedin_publisher_name();?></span>
                          <span class="pull-right"><?php echo "<img src='../uploads/".get_loggedin_publisher_dp()."' class='img-circle' height='50' width='50'>";?></span></div></div>
                      </div>

              <div class="row">              
						<a href='requests.php'><div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-primary lt text-center">
								  
									<i class="ion-email-unread" style='font-size:50px'></i>
								  
								</div>
								<div class="padder-v text-center clearfix">                            
								  <div class="col-xs-12 b-r">
									<h4 class="text-muted"><?php echo "(".get_num_requests().")"; ?> Requests</h4>
								  </div>
								</div>
							  </div>
						</div></a>						
						<a href="posts.php"><div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-danger lt text-center">
								  
									<i class="ion-clipboard" style='font-size:50px'></i>

								</div>
								<div class="padder-v text-center clearfix">                            
								  <div class="col-xs-12 b-r">
									<h4 class="text-muted"><?php echo "(".get_num_posts().")"; ?> Posts</h4>
								  </div>
								</div>
							  </div>
						</div></a>						
						<a href="notifications.php"><div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-info lt text-center">
								  
									<i class="ion-ios-bell-outline" style='font-size:50px'></i>
								  
								</div>
								<div class="padder-v text-center clearfix">                            
								  <div class="col-xs-12 b-r">
									<h4 class="text-muted"><?php echo "(<span id='notif_big'></span>)"; ?> Notifications</h4>
								  </div>
								</div>
							  </div>
						</div></a>						
						<a href='contents.php'><div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-warning lt text-center">
								  
									<i class="ion-compose" style='font-size:50px'></i>
								  
								</div>
								<div class="padder-v text-center clearfix">                            
								  <div class="col-xs-12 b-r">
									<h4 class="text-muted"><?php echo "(".get_num_contents().")"; ?> Contents</h4>
								  </div>
								</div>
							  </div>
						</div></a>
						<a href='assigned_posts.php'><div class="col-md-3 col-sm-6">
							  <div class="panel b-a">
								<div class="panel-heading no-border bg-danger lt text-center">
								  
									<i class="ion-checkmark-round" style='font-size:50px'></i>
								  
								</div>
								<div class="padder-v text-center clearfix">                            
								  <div class="col-xs-12 b-r">
									<h4 class="text-muted"><?php echo "(".get_num_assigned_posts().")"; ?> Assigned posts</h4>
								  </div>
								</div>
							  </div>
						</div></a>
		              <a href='create_post.php'><div class="col-md-3 col-sm-6">
		                <div class="panel b-a">
		                <div class="panel-heading no-border bg-info lt text-center">
		                  
		                  <i class="ion-edit" style='font-size:50px'></i>
		                  
		                </div>
		                <div class="padder-v text-center clearfix">                            
		                  <div class="col-xs-12 b-r">
		                  <h4 class="text-muted">Create Post</h4>
		                  </div>
		                </div>
		                </div>
		            </div></a>
		            <a href='#'><div class="col-md-3 col-sm-6">
						<div class="panel b-a">
							<div class="panel-heading no-border bg-warning lt text-center">
								  
								<i class="ion-settings" style='font-size:50px'></i>
								  
							</div>
							<div class="padder-v text-center clearfix">                            
							    <div class="col-xs-12 b-r">
									<h4 class="text-muted">Settings</h4>
								</div>
							</div>
						</div>
					</div></a>
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
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="../js/charts/sparkline/jquery.sparkline.min.js"></script>
  <script src="../js/charts/flot/jquery.flot.min.js"></script>
  <script src="../js/charts/flot/jquery.flot.tooltip.min.js"></script>
  <script src="../js/charts/flot/jquery.flot.spline.js"></script>
  <script src="../js/charts/flot/jquery.flot.pie.min.js"></script>
  <script src="../js/charts/flot/jquery.flot.resize.js"></script>
  <script src="../js/charts/flot/jquery.flot.grow.js"></script>
  <script src="../js/charts/flot/demo.js"></script>
  <script src="../js/app.plugin.js"></script>
  <script>

  	setInterval(get_notifs,1000);

  	function get_notifs()
  	{
  		$.get("handler/get_num_notifis.php",function(response){
          $('#paste_num_notifs').html(response);

          $('#notif_big').html(response);
        });

        $.get("handler/get_notifs_dropdown.php",function(response){
          $('#paste_notifs_dropdown').html(response);
        })
  	}

	function get_settings()
	{
		$.get("settings.html",function(response){
			$('#paste_fetched').html(response);
		})
	}
	function show_profile()
	{
		$.get("handler/get_user_profile.php",function(response){
			$('#paste_profile').html(response);
			$('#user_setings_main').modal('show');
		})
	}
	$('#user_setings_form').submit(function(e){
		e.preventDefault();
		var image = $('#file1').val();
		if(image=="")
		{
			alert("This field can't be empty");
		}
		else
		{
			$.ajax({
					url:"handler/update_profile_pic.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="updated")
						{
							location.reload(true);
						}
						else
						{
							alert(data);
						}
					}
				})
		}
	})
	function change_ma_dp()
	{
		$('#user_setings_main').modal('hide');
		$('#user_setings').modal('show');
	}	
	function change_ma_pass()
	{
		$('#user_setings_main').modal('hide');
		$('#change_pass').modal('show');
	}
	$('#change_pass_form').submit(function(e){
		e.preventDefault();
		var cur_pass = $('#cur_pass').val();
		var new_pass = $('#new_pass').val();
		var con_pass = $('#con_pass').val();
		
		if(cur_pass=="" || new_pass=="" || con_pass=="")
		{
			if(cur_pass=="")
			{
				$('#cur_pass_msg').html("Your current password is required");
			}			
			if(new_pass=="")
			{
				$('#new_pass_msg').html("Your new password is required");
			}			
			if(con_pass=="")
			{
				$('#con_pass_msg').html("Kindly confirm your password");
			}
		}
		else
		{
				$.ajax({
					url:"handler/change_pass.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="updated")
						{
							location.reload(true);
						}
						else
						{
							alert(data);
						}
					}
				})
		}
	})
  </script>
</body>
</html>