<?php 
include_once('db_conn/config.php'); 
include_once'includes/confirm_password_reset_inc.php';


  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Code Verification</title>
   <link rel="stylesheet" href="admin/css/style.css">
  <link href="tools/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<?php
  include_once('includes/custom_css.php');
  ?>
</head>
<body>

<div class="container" style="margin-top: 50px;">
  <div class="login_header animated slideInUp">
      <a href="index" title="Go to Home Page"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
      <center><h2>Password Reset Verification</h2><hr></center>
    </div>

					<center>
				
				<form method="post" class="login_form" action="confirm_password_reset" >

<!-- registered  user notification message -->
    <?php if (isset($_SESSION['registered'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['registered']; 
            unset($_SESSION['registered']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <!-- registered  user information -->

<!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
          <div class="form-group">
          <input type="password" class="form-control" name="password_reset" placeholder="Enter Your New Password" value="<?php if(isset($password_reset)): echo $password_reset; endif;?>">
         </div>
         <div class="form-group">
          <input type="hidden" class="form-control" name="verify_new_password" value="<?php echo 'verified';?>">
         </div>
         <div class=" form-group">
          <button type="submit" value="Login" name="btn_password_reset_verify" class="btn btn-success custom_btn">Verify New Password</button>
        </div><br>
      </form></center>
		
	</div><!--End Container-->

</body>
</html>

