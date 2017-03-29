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
  <link rel="stylesheet" href="css/icon.css" type="text/css" />
  <link rel="stylesheet" href="css/font.css" type="text/css" />
  <link rel="stylesheet" href="css/app.css" type="text/css" />  
      <style>
        @import url(//fonts.googleapis.com/css?family=Raleway);
        body {
            font-family:'Raleway', sans-serif;
            font-size: 15px
        }
    </style>
</head>
<body class="">
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xl">
      <a class="navbar-brand block" href="index.html">C W A</a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Create Account</strong>
        </header>
        <div id="paste_response"></div>
        <form action="" id="register_form" method="post">
          <div class="list-group">
            <div class="list-group-item">
               <input type="text" placeholder="Full Name" id="name" name="name" class="form-control no-border">
            </div>
            <div class="list-group-item">
               <input type="text" placeholder="Contact detail" id="phone" name="phone" class="form-control no-border">
            </div>
            <div class="list-group-item">
              <input type="email" placeholder="Email" id="email" name="email" class="form-control no-border">
            </div>
            <div class="list-group-item">
               <input type="password" placeholder="Password" id="password" name="password" class="form-control no-border">
            </div>
          </div>
          <button type="submit" class="btn btn-lg btn-primary btn-block" style="background-color: #5fcf80;border:1px solid #5fcf80" name="submit">Create account</button>
          <!--<div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Do not have an account?</small></p>-->
          <a href="login.php" class="btn btn-lg btn-default btn-block">Sign in</a>
        </form>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>Novateur Nigeria<br>&copy; <?php echo date("Y"); ?></small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="js/bootstrap.js"></script>
  <script src="js/custom.js"></script>
  <!-- App -->
  <script src="js/app.js"></script>  
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  <script src="js/app.plugin.js"></script>
  <script type="text/javascript">
    $('#register_form').submit(function(e){
      e.preventDefault();
      var name,phone,email,password;
      name = $('#name').val();
      phone = $('#phone').val();
      email = $('#email').val();
      password = $('#password').val();
      if(name=="" || phone=="" || email=="" || password=="")
      {
        if(name=="")
        {
          document.getElementById("name").style.border="1px solid red";
        }
        if(phone=="")
        {
          document.getElementById("phone").style.border="1px solid red";
        }
        if(email=="")
        {
          document.getElementById("email").style.border="1px solid red";
        }
        if(password=="")
        {
          document.getElementById("password").style.border="1px solid red";
        }
      }
      else
      {
          $.ajax({
            url:"handler/register.php",
            type:"POST",
            data: new FormData(this),
            cache:false,
            contentType:false,
            processData:false,
            success:function(data)
            {
              $('#paste_response').html(data);
              if(data=="inserted")
              {
                //$('#paste_response').html("<div class='alert alert-success alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Your exchange rate has been been updated successfully</b></div>");
                location.replace("index.php");
              }
              else
              {
                $('#paste_response').html("<div class='alert alert-danger alert-dismissable' data-dismiss='alert'><a href='#' class='close' data-dismiss='alert'aria-label='close'>&times;</a><b>Error: Sorry we couldn't create your account</b></div>");
              }
            }
          })
      }
    })
  </script>
</body>
</html>