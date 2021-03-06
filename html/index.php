 <?php 
 session_start();
include_once('db_conn/config.php');


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
            <li><a href="edit_product.php">Edit Settings</a></li>
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


      <div class="row">
        <div class="col-md-12">
          <?php 
             if (!isset($_SESSION['username'])) { ?>
  <p>Please Sign in to View Your Account Info.</p>
           <?php ?>
          <?php }else{ ?>
          <?php  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
                    if($row['user_type'] == 'user'){?>
          <p>Your product ID: <strong style="color: lightgreen;"><?php echo $row['product_id']; ?></strong></p>
          <p>Sunlight: <strong style="color: lightgreen;"><?php echo $row['user_rank']; ?></strong></p>
          <p>Fertilizer Interval: <strong style="color: lightgreen;"><?php echo $row['user_integer_value']; ?></strong></p><br>
          <a href="edit_product.php" class="btn btn-success"><p>Update Your Settings</p></a>
          <?php }} ?>
        </div>
    </div>
</div>
</section>

<script src="tools/js/jquery.min.js"></script>
  <script src="tools/js/carouselCaption.js"></script>
  <script src="tools/js/bootstrap.min.js"></script>
</body>
</html>