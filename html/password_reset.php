  <?php include_once('db_conn/config.php') ?>
  <?php include_once('includes/password_reset_inc.php') ?>

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
       <h3 align="center">Password Reset</h3></center>
    </div>
    <form method="post" class="login_form animated slideInUp" action="password_reset" >

      <!-- registered  user notification message -->
    <?php if (isset($_SESSION['password_reset'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['password_reset']; 
            unset($_SESSION['password_reset']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- registered  user information -->

    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
    <center>
         <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="E-mail" value="<?php if(isset($email)): echo $email; endif;?>">
         </div>
         <div class=" form-group">
          <button type="submit" name="btn_pass_reset" class="btn btn-success custom_btn">Submit</button>
        </div></center>
      </form>
      
  </div>
  
</body>
</html>