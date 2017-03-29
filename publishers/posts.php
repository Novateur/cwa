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
                  <span style='font-size: 30px'><i class="ion-clipboard"></i> Posts</span>&nbsp;&nbsp;&nbsp;<span class="pull-right"><a href='create_post.php' data-role='button' class='btn' data-toggle='tooltip' title='Create new post' style="background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff">Create Post</a></span><br/><br/><br/>
                  <?php
                    get_publisher_posts();
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="margin-top: 200px;width:400px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='ion-ios-trash-outline'></i> Delete post</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this post ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <span id="paste_btn"></span>
      </div>
    </div>

  </div>
</div>

<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width:750px">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='ion-edit'></i> Edit post</h4>
      </div>
      <div class="modal-body">
        <div id="paste_response"></div>
        <form id="edit_submit" method="post">
        <div id="paste_edit_details">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn" style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff'>Update</button>
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

 function delete_post(id,row)
 {
    $('#paste_btn').html("<button class='btn btn-danger' onclick=\"cont_post_del("+id+")\">Proceed</button>");
    $('#myModal').modal('show');
 }

  function edit_post(id,row)
 {
    $.post("handler/get_edit_post.php",{id:id},function(response){
      $('#paste_edit_details').html(response);
      $("#editor").kendoEditor({ resizable: {
        content: true,
        toolbar: true
      }});
      $('#editModal').modal('show');
    })
 }

 function cont_post_del(id)
 {
    $.post("handler/delete_post.php",{id:id},function(response){
      if(response=="deleted")
      {
        $('#myModal').modal('hide');
        $("#t"+id).remove();
      }
    })
 }

 $('#edit_submit').submit(function(e){
  e.preventDefault();
  var name,editor,type,price;
  name = $('#name').val();
  editor = $('#editor').val();
  type = $('#type').val();
  price = $('#price').val();

  if(name == "" || editor == "" || type == "" || price == "")
  {
    if(name=="")
    {
      document.getElementById("name").style.border="1px solid red";
      document.getElementById("name").style.borderLeft="5px solid red";
    }
    if(editor=="")
    {
      document.getElementById("editor").style.border="1px solid red";
      document.getElementById("editor").style.borderLeft="5px solid red";
    }
    if(type=="")
    {
      document.getElementById("type").style.border="1px solid red";
      document.getElementById("type").style.borderLeft="5px solid red";
    }
    if(price=="")
    {
      document.getElementById("price").style.border="1px solid red";
      document.getElementById("price").style.borderLeft="5px solid red";
    }
  }
  else
  {
          $.ajax({
            url:"handler/update_post.php",
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
                $('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>"+data+"</b></div>");
              }
            }
          })
  }
 })

 $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
 });
  </script>
</body>
</html>