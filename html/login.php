  <?php include_once('db_conn/config.php') ?>
  <?php include_once('includes/login_inc.php') ?>

  <!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <!--For Title Ico-->
<link rel="icon" type="icon" href="../images/icon.ico">
  <link rel="stylesheet" href="admin/css/style.css">
  <link rel="stylesheet" href="tools/css/animate.css">
  <link href="tools/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="tools/fonts/font-awesome/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
    
    <div class="login_header animated slideInUp">
      <a href="index" title="Go to Home Page"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
      <center><h2 align="center">KARIBU</h2>
       <h3 align="center">Sign In</h3></center>
    </div>
    <form method="post" class="login_form animated slideInUp" action="login" >
      <center>
        <!-- notification message -->
    <?php if (isset($_POST['code_verify'])){ ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['verified']; 
            unset($_SESSION['verified']);
          ?>
        </h3>
      </div>
    <?php }else{ if (isset($_SESSION['new_password_verified'])){ ?>

      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['new_password_verified']; 
            unset($_SESSION['new_password_verified']);
          ?>
        </h3>
      </div>
    <?php }} ?>

    <!-- logged in user information -->
    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
          <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($username)): echo $username; endif;?>">
         </div>
         <div class=" form-group">
          <input type="hidden" class="form-control" name="status" value="<?php echo 'verified'; ?>">
         </div>
         <div class=" form-group">
          <input type="password" class="form-control" name="password" placeholder="Password">
         </div>
         <div class=" form-group">
          <button type="submit" value="login" name="login_user" class="btn btn-success custom_btn">Login</button>
        </div></center>
        <br><p style="float: left; position: absolute; bottom: 5px;"><br>
          <!-- Password Renewal Message -->
          <?php include_once('includes/forgot_password_errors.php'); ?><br>
      Not yet a member? <a href="register" style="color: brown !important;"><strong>Sign up</strong></a>
    </p>
      </form>
      
  </div>
  
</body>
</html>