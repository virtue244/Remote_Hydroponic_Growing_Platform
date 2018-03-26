  <?php 
  include_once('db_conn/config.php');
  include_once('includes/subscribe_inc.php');
   ?>

  <!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subscribe</title>
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
       <h3 align="center">Subscribe for our Newsletter</h3></center>
    </div>
    <form method="post" class="login_form animated slideInUp" action="subscribe" >

    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
    <center>
         <div class="form-group">
          <input type="text" class="form-control" name="email" placeholder="Enter Your E-mail Here" value="<?php if(isset($email)): echo $email; endif;?>">
         </div>
         <div class=" form-group">
          <button type="submit" name="btn_subscribe" class="btn btn-success custom_btn">Subscribe</button>
        </div></center>
      </form>
      
  </div>
  
</body>
</html>