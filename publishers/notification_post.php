<?php
  ob_start();

  require_once("../includes/publishers_functions.php");

  if(!isset($_SESSION['publisher']))
  {
    header("location:login.php");
  }

  if(isset($_GET['post_ref']))
  {
    if(empty($_GET['post_ref']))
    {
      header("location:404.php");
    }
    else if(check_post_exist($_GET['post_ref']))
    {
      $id = $_GET['post_ref'];
    }
    else
    {
      header("location:404.php");
    }
  }
  else
  {
    header("location:notifications.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en" class="app">
<head>  
  <meta charset="utf-8" />
  <title>C W A</title>
  <meta name="description" content="exchange rate, values, money rate" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="../css/animate.css" type="text/css" />
  <link rel="stylesheet" href="../css/font-awesome.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/ionicons.min.css" type="text/css" />
  <link rel="stylesheet" href="../css/icon.css" type="text/css" />
  <link rel="stylesheet" href="../css/font.css" type="text/css" />
  <link rel="stylesheet" href="../css/app.css" type="text/css" />  
  <link rel="stylesheet" href="../js/calendar/bootstrap_calendar.css" type="text/css" />
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
                          <div class="col-md-2">

                          </div>
                          <div class="col-md-8">
                            <?php
                              get_posts_notif($id);
                            ?>
                          </div>
                          <div class="col-md-2">

                          </div>
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
  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
  <script>

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
  </script>
</body>
</html>