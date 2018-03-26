  <?php include_once('db_conn/config.php') ?>
  <?php include_once('includes/register_inc.php') ?>

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
  <link rel="stylesheet" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
  <div class="container">
    
    <div class="login_header animated slideInUp">
       <a href="index" title="Go to Home Page"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
      <center>
      <h2 align="center">KARIBU</h2>
       <h3 align="center">Register Here</h3></center>
    </div>
    <form method="post" class="login_form animated slideInUp" action="register" >

      <!-- registered  user notification message -->
    <?php if (isset($_SESSION['subscribe'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['subscribe']; 
            unset($_SESSION['subscribe']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- registered  user information -->

    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
    <center>
          <div class="form-group">
          <input type="text" class="form-control" name="username" placeholder="Username" value="<?php if(isset($username)): echo $username; endif;?>">
         </div>
         <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="E-mail" value="<?php if(isset($email)): echo $email; endif;?>">
         </div>
         <div class=" form-group">
          <input type="password" class="form-control" name="password_1" placeholder="Password">
         </div>
         <div class=" form-group">
          <input type="password" class="form-control" name="password_2" placeholder="Confirm Password">
         </div>
         <div class=" form-group">
          <button type="submit" name="reg_user" class="btn btn-success custom_btn">Register</button>
        </div></center>
        <br><p style="float: left; position: absolute; bottom: 5px;">
      Already a member? <a href="login" style="color: brown !important;"><strong>Sign in</strong></a>
    </p>
      </form>
      
  </div>
  
</body>
</html>