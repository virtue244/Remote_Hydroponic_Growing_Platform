  <?php include_once('db_conn/config.php') ?>
  <?php include_once('includes/new_password_inc.php') ?>

  <!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PASSWORD RESET</title>
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
       <h3 align="center">New Password</h3></center>
    </div>
    <form method="post" class="login_form animated slideInUp" action="new_password" >

      <!-- registered  user notification message -->
    <?php if (isset($_SESSION['new_password'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['new_password']; 
            unset($_SESSION['new_password']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- registered  user information -->

    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
    <center>
         <div class=" form-group">
          <input type="password" class="form-control" name="password_reset" placeholder="Current Password" value="<?php if(isset($password_reset)): echo $password_reset; endif;?>">
         </div>
         <div class=" form-group">
          <input type="password" class="form-control" name="password_1" placeholder="New Password">
         </div>
         <div class=" form-group">
          <input type="password" class="form-control" name="password_2" placeholder="Confirm New Password">
         </div>
         <div class=" form-group">
          <button type="submit" name="btn_new_password" class="btn btn-success custom_btn">Submit</button>
        </div></center>
      </form>
      
  </div>
  
</body>
</html>