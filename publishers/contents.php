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
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/animate.css" type="text/css" />
    <link href="../css/examples-offline.css" rel="stylesheet">
      <link href="../css/kendo.common.min.css" rel="stylesheet">
    <link href="../css/kendo.rtl.min.css" rel="stylesheet">
    <link href="../css/kendo.default.min.css" rel="stylesheet">
    <link href="../css/kendo.default.mobile.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" type="text/css" />
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
              	<div class="col-md-12 panel panel-default" style="padding:40px;padding-bottom:50px">
                  <span style='font-size: 30px'><i class="ion-compose"></i> Contents</span><br/><br/><br/>
                  <div id="paste_response"></div>
                  <?php
                    get_publisher_contents();
                  ?>              		
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
  <div id="send_reportModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="margin-top: 150px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background-color: #5fcf80;color:#ffffff">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="ion-speakerphone"></i> Send a report</h4>
      </div>
      <div class="modal-body">
        <form id="report_form">
        <b>Make a report</b><br/>
        <textarea name="report" id="report" class="form-control" rows="7" Placeholder="Report this writer..."></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn" style="background-color: #5fcf80;color:#ffffff">Send report</button>
        </form>
      </div>
    </div>

  </div>
</div>

  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.js"></script>
    <script src="../js/jszip.min.js"></script>
  <script src="../js/kendo.all.min.js"></script>
  <script src="../js/console.js"></script>
  <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
<!--script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../js/charts/easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="../js/charts/sparkline/jquery.sparkline.min.js"></script>-->
  <script src="../js/app.plugin.js"></script>
  <script>
     var table = $("#grid-basic").DataTable();

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

     $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
     });

     function send_report()
     {
        $('#send_reportModal').modal('show');
     }

     $('#report_form').submit(function(e){
      e.preventDefault();
      alert('Am submitting bitch!!');
     })

     function accept_content(id,post_id,user_id)
     {
        $.post("handler/accept_content.php",{id:id,post_id:post_id,user_id:user_id},function(response){
          if(response=="accepted")
          {
            location.reload(true);
          }
          else
          {
            alert("Sorry, an error occured.We could not perform your request");
          }
        })
     }

  </script>
</body>
</html>