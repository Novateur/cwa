<?php
  ob_start();

  require_once("includes/functions.php");

  if(!isset($_SESSION['user']))
  {
    header("location:login.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>C W A</title>
  <meta name="description" content="exchange rate, values, money rate" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/animate.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
  <link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css" />
      <style>
        @import url(//fonts.googleapis.com/css?family=Raleway);
        body {
            font-family:'Raleway', sans-serif;            
            font-size: 13px
        }
    </style>
</head>
<body class="" onload="get_all()">
  <section class="vbox">
    <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">
      <div class="navbar-header aside-md dk col-sm-6">
        <a href="index.php" class="navbar-brand">C W A</a>
      </div>
      <ul class="nav navbar-nav pull-right">
        <li><a class="dropdown-toggle" data-toggle="dropdown" href="notifications.php"><span class="label label-success" id='paste_num_notifs'></span> <i class="ion-ios-bell-outline"></i> Notifications</a>
          <ul class="dropdown-menu" style="min-width: 450px;max-width: 450px;max-height: 400px; overflow: scroll" id="paste_notifs_dropdown">


          </ul>
        </li>
        <li class="active" style="background-color: rgba(50,50,50,0.05)"><a href="index.php"><i class="ion-ios-home"></i> Home</a></li>
        <li><a href="profile.php"><i class="ion-person"></i> Account</a></li>
        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
      </ul>     
    </header>
    <section>
      <section class="hbox stretch">
        
        <!-- /.aside -->
        <section id="content">
          <section class="hbox stretch">
            <section>
              <section class="vbox">
                <section class="scrollable padder">
                    
                    <div class="row" style="margin-top:50px"> 
                    </div>
                    <div class="container">
                      <div class="row">
                          <div class="col-md-4">
                              <?php echo "<a href='profile.php'><img src='uploads/".get_loggedin_user_dp()."' class='img-circle' height='120' width='120'/></a><span style='font-size:15px'> <b>".get_loggedin_user_name()."</b></span><br/><br/><br/>"; ?>
                              <div class="panel panel-default">
                                <div class="panel-heading"><span style="font-size:18px">Requests made</span></div>
                                <div class="panel-body" id="paste_requested_posts">

                                </div>
                              </div>
                              <div class="panel panel-default">
                                <div class="panel-heading"><span style="font-size:18px">Assigned posts</span></div>
                                <div class="panel-body" id="paste_assigned_posts">

                                </div>
                              </div>
                              <div class="panel panel-default">
                                <div class="panel-heading"><span style="font-size:18px">Written articles</span> <span class="pull-right"><a href='#'>View all</a></span></div>
                                <div class="panel-body" id="paste_written">
                                </div>
                              </div>
                          </div>
                          <div class="col-md-7">
                            <div id="paste_posts">

                            </div>
                          </div>
                          <div class="col-md-1">

                          </div>
                      </div>
                      <div class="row">    
                      </div>
                    </div>                   
    
                </section>
              </section>
            </section>
            <!-- side content -->

            <!-- / side content -->
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
      </section>
    </section>
  </section>
  <div id="upload_content_Modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="background-color: #5fcf80;color:#ffffff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><i class="ion-ios-cloud-upload-outline"></i> Upload your content</h4>
        </div>
        <div class="modal-body">
          <div id="paste_response"></div>
          <form id="file_upload_form">
            <input type="hidden" class="form-control" name="post_id" id="post_id"/>
            <b>Choose a file<span style="color:red">*</b></span><br/>
            <input type="file" class="form-control" name="file" id="file"/><br/>
            <b>Leave a short note</b><br/>
            <textarea rows="6" name="notes" id="notes" class="form-control" ></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn" style="background-color: #5fcf80;color:#ffffff">Upload</button>
          </div>
          </form>
      </div>

    </div>
  </div>
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>

  <script src="js/calendar/bootstrap_calendar.js"></script>
  <script src="js/calendar/demo.js"></script>

  <script src="js/sortable/jquery.sortable.js"></script>
  <script src="js/app.plugin.js"></script>
  <script>
      setInterval(get_notifs,1000);
      
      function get_notifs()
      {
        $.get("handler/get_num_notifis.php",function(response){
          $('#paste_num_notifs').html(response);
        });

        $.get("handler/get_notifs_dropdown.php",function(response){
          $('#paste_notifs_dropdown').html(response);
        });

        $.get("handler/get_written_post.php",function(response){
          $('#paste_written').html(response);
        });
      }

      function get_all()
      {
        $.get("handler/get_num_notifis.php",function(response){
          $('#paste_num_notifs').html(response);
        });

        $.get("handler/get_notifs_dropdown.php",function(response){
          $('#paste_notifs_dropdown').html(response);
        });

        $.get("handler/get_assigned_post.php",function(response){
          $('#paste_assigned_posts').html(response);
        });

        $.get("handler/get_requested_post.php",function(response){
          $('#paste_requested_posts').html(response);
        });

        $.get("handler/get_posts.php?page=1",function(response){
          $('#paste_posts').html(response);
        });
      }

      function fetch_comments(post_id, field_to_paste)
      {
        $.post("handler/get_comments.php",{post_id:post_id},function(response){
          $(field_to_paste).html(response).slideToggle('fast');
        })
      }
      
      function add_comment(event,val,post_id,self,paste)
      {
        event.preventDefault();
        if(event.keyCode == 13)
        {
          if(val=="")
          {
              $(self).css({"border":"1px solid red","borderLeft":"5px solid red"});
          }
          else
          {
            $.post("handler/add_comments.php",{val:val,post_id:post_id},function(response){
              if(response=="inserted")
              {
                //fetch_comments(post_id,paste);
                $.post("handler/get_comments.php",{post_id:post_id},function(response){
                  $(paste).html(response);
                })
              }
            }) 
          }
        }
      }
      
      function delete_comment(comment_id,post_id,paste)
      {
        $.post("handler/delete_comment.php",{comment_id:comment_id},function(response){
              if(response=="deleted")
              {
                //fetch_comments(post_id,paste);
                $.post("handler/get_comments.php",{post_id:post_id},function(response){
                  $(paste).html(response);
                })
              }
        })
      }

      function send_request(post_id)
      {
        $.post("handler/send_request.php",{post_id:post_id},function(response){
          if(response=="sent")
          {
            location.reload(true);
          }
        })
      }

      function cancel_request(post_id,user_id)
      {
        $.post("handler/cancel_request.php",{post_id:post_id,user_id:user_id},function(response){
          if(response=="cancelled")
          {
            $.get("handler/get_requested_post.php",function(response){
              $('#paste_requested_posts').html(response);
            });
          }
          else
          {
            alert("Request could not be cancelled");
          }
        })
      }

      function edit_comment(id,comment,paste_edit,paste,post_id)
      {
        $(paste_edit).html("<textarea rows='4' class='form-control' onblur=\"submit_edit(this,this.value,"+id+",'"+paste+"',"+post_id+")\">"+comment+"</textarea>");
      }

      function submit_edit(self,val,id,paste,post_id)
      {
        if(val=="")
        {
          //Validate the textarea....make sure it not empty
          $(self).css({"border":"1px solid red","borderLeft":"5px solid red"});
        }
        else
        {
          $.post("handler/update_comment.php",{val:val,id:id},function(response){
            (response=="updated")
            {
              $.post("handler/get_comments.php",{post_id:post_id},function(response){
                $(paste).html(response);
              })
            }
          })
        }
      }

      function upload_content(id)
      {
        $('#post_id').val(id);
        $('#upload_content_Modal').modal('show'); 
      }

      $('#file_upload_form').submit(function(e){
        e.preventDefault();
        if($('#file').val() =="")
        {
          document.getElementById("file").style.border="1px solid red";
          document.getElementById("file").style.borderLeft="5px solid red";
        }
        else
        {
          $.ajax({
            url:"handler/upload_content.php",
            type:"POST",
            data: new FormData(this),
            cache:false,
            contentType:false,
            processData:false,
            success:function(data)
            {
              if(data=="upload")
              {
                $('#file').val("");
                $('#notes').val("");
                $('#paste_response').html("<div class='alert alert-success alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>You've successfully uploaded your content, the publisher will review it and get back to you</b></div>");
              }
              else
              {
                $('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Error: file must be in pdf format and must be less than 5MB</b></div>");
              }
            }
          })
        }
      })
      
      function get_more(page)
      {
        $('#next_button').html("<b>Loading more...</b>");
        $.get("handler/get_posts.php?page="+page,function(response){
          $('#next_button').remove();

          $('#paste_posts').append(response);
        })
      }

  </script>
</body>
</html>