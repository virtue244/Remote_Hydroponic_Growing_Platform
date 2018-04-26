 <?php 
include_once('db_conn/config.php');
include_once('includes/edit_product_inc.php');


 if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('Location:../index.php');
  }
  ?>
  <!DOCTYPE html>
<html lang="en">
<head>
   <title>RASPBERRY PI</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="description" content="angemor, dry cleaner services and all laundry services."/>
<link rel="canonical" href="http://angemor.com/" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="angemor: Best Dry Cleaner and Laundry Services in Dar Es Salaam, Tanzania" />
<meta property="og:description" content="angemor, dry cleaner services and all laundry services." />
<meta property="og:url" content="http://angemor.com/" />
<meta property="og:site_name" content="angemor" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="angemor, dry cleaner services and all laundry services." />

  <?php include_once('includes/custom_css.php'); ?>
  <link rel="stylesheet" href="tools/css/animate.css">
  <link rel="stylesheet" href="tools/css/bootstrap.min.css">
  <link rel="stylesheet" href="tools/font-awesome/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
  <script src="tools/js/main.js"></script></head>
<body>
<section class="landing" >
  <div class="landing-inner">
     <!--- NAVIGATION-->
<nav class="navbar navbar-default ">
  <div class="container-fluid" >
    <div class="navbar-header" >
<!--LOGO-->
<div class="brand_name_logo"><a href="index.php" style="text-decoration: none;"><img src="uploads/logo.png" class="img-responsive animated slideInRight" alt="LOGO" width="60" height="60"></a></div>
 <!--/LOGO-->
        <button type="button" class="navbar-toggle mobile_menu" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      
    </div>
      <div class="collapse navbar-collapse animated slideInLeft" id="myNavbar" >
        <ul class="nav navbar-nav navbar-right" >
          <li><a href="index.php">Home</a></li> 
      <?php 
             if (!isset($_SESSION['username'])) {
  
            ?>
          <li><a href="login.php">Sign in</a></li>
          <?php }else{ ?>
          <?php  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
                    if($row['user_type'] == 'user'){?>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> <strong style="color: #001; cursor: pointer;">Hi <?php echo ucfirst($_SESSION['username']); ?></strong><span class="caret"></span></a>
              <ul class="dropdown-menu">
          <li><a href="includes/logout.php?logout='1'">Logout</a></li>
          <!--Link Edit Product Here-->
                
            </ul>
            </li>
          <?php }else{
            if($row['user_type'] == 'admin'){ ?>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> <strong style="color: #001; cursor: pointer;">Hi <?php echo ucfirst($_SESSION['username']); ?></strong> <span class="label label-pill label-danger count" style="border-radius:10px;"></span></a>
              <ul class="dropdown-menu"> 
                <li><a href="admin/index?=Welcome <?php echo $_SESSION['username']; ?>!">Admin Page</a></li>
                <li><a href="includes/logout.php?logout='1'">Logout</a></li>
                
            </ul>
            </li>
                   <?php }
               }} ?>
    </ul>
    </div>
  </div>
</nav><!--- End NAVIGATION-->
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


          <form method="post" class="login_form animated slideInUp" action="edit_product.php" style="color: #000;" autocomplete="off">
      <div class="login_header animated slideInUp">
      <center>
        <h2 align="center">Fertilizer Interval (Days)</h2></center><br>
       <h3 align="center">Edit Settings</h3></center>
    </div>
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
    <?php  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
                    if($row['user_type'] == 'user'){?>
         <div class="form-group">
            <label style="float: left !important;">Sunlight:</label>
            <select name="user_rank" class="form-control">
            <option selected data-default><?php echo $row['user_rank']; ?></option>
            <option>Low</option>
            <option>Medium</option>
            <option>High</option>
          </select>
         </div>
         <div class=" form-group">
          <input type="text" class="form-control" name="user_integer_value" placeholder="Fertilizer Interval (1+)" value="<?php echo $row['user_integer_value']; ?>">
         </div>
         <?php } ?>
         <div class=" form-group">
          <button type="submit" name="edit_product" class="btn btn-success custom_btn">Update</button><br>
        </div></center>
      </form>
</div>
</section>

<script src="tools/js/jquery.min.js"></script>
  <script src="tools/js/carouselCaption.js"></script>
  <script src="tools/js/bootstrap.min.js"></script>
</body>
</html>