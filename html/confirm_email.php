<?php 
include_once('db_conn/config.php'); 
include_once'includes/confirm_email_inc.php';


  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CODE VERIFICATION</title>
   <link rel="stylesheet" href="admin/css/style.css">
  <link href="tools/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="admin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<?php
  include_once('includes/custom_css.php');
  ?>
</head>
<body>

<div class="container" style="margin-top: 50px;">
  

					
				<center>
				<form method="post" class="login_form" action="confirm_email.php" style="color: #000;">
          <div class="login_header animated slideInUp">
      <a href="index.php" title="Go to Home Page"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> </a>
      <center><h2>E-mail Verification</h2></center>
    </div>

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
          <input type="password" class="form-control" name="code" placeholder="Enter Your Code" value="<?php if(isset($code)): echo $code; endif;?>">
         </div>
         <div class="form-group">
          <input type="hidden" class="form-control" name="status" value="<?php echo 'verified';?>">
         </div>
         <div class=" form-group">
          <button type="submit" value="Login" name="code_verify" class="btn btn-success custom_btn">Verify Account</button>
        </div><br>
      </form></center>
		
	</div><!--End Container-->

</body>
</html>

