<?php
  ob_start();

  require_once("../includes/publishers_functions.php");
  
  if(!isset($_SESSION['publisher']))
  {
    header("location:login.php");
  }

  if(isset($_GET['user']))
  {
    if(empty($_GET['user']))
    {
      $id = get_loggedin_publisher_id();
      header("location:profile.php?user={$id}");
    }
    else if(check_user_exist($_GET['user']))
    {
      $user = $_GET['user'];
    }
    else
    {
      header("location:404.php");
    }
  }
  else
  {
    $id = get_loggedin_publisher_id();
    header("location:profile.php?user={$id}");
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
                          <div class="col-md-4">
                              <?php echo "<div align='center'><img src='../uploads/".get_user_dp($user)."' class='' height='250' width='250'/></div><br/><br/>";?>
                              <div class="panel panel-default" style="padding:20px">
                                <h4>Written articles</h4>
                              </div>
                          </div>
                          <div class="col-md-7">
                            <?php
                              get_personal_details($user);
                              get_contact_details($user);
                              get_qualification_details($user);
                            ?>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='ion-person'></i> Personal Details</h4>
      </div>
      <div class="modal-body">
        <form id="personal_submit" method="post">
        <div id="paste_personal_details">

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

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='ion-clipboard'></i> Contact Details</h4>
      </div>
      <div class="modal-body">
        <form id="contact_submit" method="post">
        <div id="paste_contact_details">

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

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class='ion-university'></i> Summary Details</h4>
      </div>
      <div class="modal-body">
        <form id="summary_submit" method="post">
        <div id="paste_summary_details">
        
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
<div id="dp" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header" style='background-color: #5fcf80;color:#ffffff'>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
       <h4><i class="ion-person"></i> Update your profile picture</h4>
      </div>
      <div class="modal-body"><br/>
      <form>
        <input type="file"id="file1"name="file1"class="form-control"/><br/>
        <progress id="progressBar"value="0"max="100"style="width:300px;display:none;margin-left:10px"class="progress progress-success"></progress><p id="status"></p><br/>
        <p id="loaded_n_total"style="margin-left:10px"></p>
      </div>
      <div class="modal-footer">
            <div>
              <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
              <input type="button"value="Upload picture"onclick="uploadFile()"class="btn" style='background-color: #5fcf80;border:1px solid #5fcf80;color:#ffffff'/>
        </div>
      </form> 
      </div>
  </div>
  </div>
</div>

  <script src="../js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../js/bootstrap.js"></script>
  <!-- App -->
  <script src="../js/app.js"></script>  
  <script src="../js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="../js/app.plugin.js"></script>
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

    function edit_personal_details()
    {
      $.get("handler/get_personal_details.php",function(response){
        $('#paste_personal_details').html(response);
        $('#myModal').modal('show');
      })
    }

    function edit_contact_details()
    {
      $.get("handler/get_contact_details.php",function(response){
        $('#paste_contact_details').html(response);
        $('#myModal1').modal('show');
      })

    }

    function edit_summary_details()
    {
      $.get("handler/get_summary_details.php",function(response){
        $('#paste_summary_details').html(response);
        $('#myModal2').modal('show');
      })
    }

    $('#personal_submit').submit(function(e){
      e.preventDefault();
      var name = $('#name').val();
      var gender = $('#gender').val();
      if(gender=="" || name=="")
      {
        if(name=="")
        {
          document.getElementById("name").style.border="1px solid red";
          document.getElementById("name").style.borderLeft="5px solid red";
        }
        if(gender=="")
        {
          document.getElementById("gender").style.border="1px solid red";
          document.getElementById("gender").style.borderLeft="5px solid red";
        }
      }
      else
      {
          $.ajax({
            url:"handler/update_personal_details.php",
            type:"POST",
            data: new FormData(this),
            cache:false,
            contentType:false,
            processData:false,
            success:function(data)
            {
              //alert(data);
              if(data=="updated")
              {
                location.reload(true);
              }
              else
              {
                alert(data);
                //$('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Invalid Username/Password Combination</b></div>");
              }
            }
          })
      }
    })

    $('#contact_submit').submit(function(e){
      e.preventDefault();
      var phone = $('#phone').val();
      if(phone=="")
      {
          document.getElementById("phone").style.border="1px solid red";
          document.getElementById("phone").style.borderLeft="5px solid red";
      }
      else
      {
          $.ajax({
            url:"handler/update_contact_details.php",
            type:"POST",
            data: new FormData(this),
            cache:false,
            contentType:false,
            processData:false,
            success:function(data)
            {
              //alert(data);
              if(data=="updated")
              {
                location.reload(true);
              }
              else
              {
                alert(data);
                //$('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Invalid Username/Password Combination</b></div>");
              }
            }
          })
      }
    })

    $('#summary_submit').submit(function(e){
      e.preventDefault();
      alert("Summary submitting");
    })
  function changedp()
  {
    $('#dp').modal('show');
  }
  
  function _(el)
  {
    return document.getElementById(el);
  }
  function uploadFile()
  {
    var file=_("file1").files[0];
    //alert(file.name+"|"+file.size+"|"+file.type);
    if(file.size<=2000000 && file.type=="image/jpeg")
    {
      _("progressBar").style.display="block";
      var formdata=new FormData();
      formdata.append("file1",file);
      var ajax=new XMLHttpRequest();
      ajax.upload.addEventListener("progress",progressHandler,false);
      ajax.addEventListener("load",completeHandler,false);
      ajax.addEventListener("error",errorHandler,false);
      ajax.addEventListener("abort",abortHandler,false);
      ajax.open("POST","handler/file_upload.php");
      ajax.send(formdata);
    }
    else
    {
      _("status").innerHTML="<div class='alert alert-danger'>Image must be jpeg and less than 2MB</div>";
    }
  }
  function progressHandler(event)
  {
    _("loaded_n_total").innerHTML="Uploaded"+event.loaded+"bytes of"+event.total;
    var percent=(event.loaded/event.total)*100;
    _("progressBar").value=Math.round(percent);
    _("status").innerHTML=Math.round(percent)+"% uploaded...please wait";
  }
  function completeHandler(event)
  {
    _("status").innerHTML=event.target.responseText;
    _("progressBar").value=0;
    _("progressBar").style.display="none";
    location.reload(true);
  }
  function errorHandler(event)
  {
    _("status").innerHTML="Upload failed";
  }
  function abortHandler(event)
  {
    _("status").innerHTML="Upload aborted"
  }
  </script>
</body>
</html>