<?php 
include_once('db_conn/config.php');

session_start();
 if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login?=You must log in first!');
  }


  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index");
  }
  ?>

<?php
include_once('includes/classes.php');

$service = new Services;
$services = $service->fetch_all();

$branch = new OurBranches;
$branches = $branch->fetch_all();

$navLinking = new NavLinking;
$navLinkings = $navLinking->fetch_all();

 
?>
<!DOCTYPE html>

<html lang="en">
<head>
  <title>Angemor: Laundry and Dry Cleaning Services in Dar es Salaam, Tanzania</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

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

  <?php include_once('includes/custom_css.php'); ?><link rel="stylesheet" href="tools/css/style.css">
  <link rel="stylesheet" href="tools/css/bootstrap.min.css">
  <link rel="stylesheet" href="tools/font-awesome/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>

   <script src="tools/js/jquery.min.js"></script>
  <script src="tools/js/carouselCaption.js"></script>
  <script src="tools/js/bootstrap.min.js"></script>
</head>

<body>
<?php

      if (isset($_POST['btn_dashboard'])) 
      {
        ?>
      <script type="text/javascript">
        window.location.href="admin/index.php";
      </script>
      <?php

      }else{
        if (isset($_POST['btn_logout'])) 
      {
        ?>
      <script type="text/javascript">
        window.location.href="includes/logout.php";
      </script>
      <?php
      }
      }

?>
<center><h1><u>EDIT PAGE SECTIONS</u></h1></center>
 <form method="post" >
<center><button type=""   class="btn btn-default" name="btn_logout" >Logout</button><br><br>
</form>
 <form method="post" >
<button type="submit"   class="btn btn-default" name="btn_dashboard" >Go to Admin Dashboard</button></center>
</form>
<br><br>


<?php foreach ($navLinkings as $navLinking){?>
<h4 style='color: orange; padding-right: 10px; top: -36px !important; position: relative; float: right;' class='glyphicon glyphicon-phone'><strong> <em><?php echo $navLinking['contact_mobile_phone']; ?></em></strong></h4>

<nav class="navbar navbar-default ">
  <div class="container-fluid" >
    <div class="navbar-header" >
      <!--LOGO-->
 <a href="" style="text-decoration: none;"><h1><img src="uploads/<?php echo $navLinking['image']; ?>" class="img-responsive brand_name_logo"></h1></a>
 <!--/LOGO-->
      <?php }?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      
    </div>
      <div class="collapse navbar-collapse" id="myNavbar" >
        <ul class="nav navbar-nav navbar-right" >
          <?php foreach ($navLinkings as $navLinking){?>
          <li><a href=""><?php echo $navLinking['home']; ?></a></li> 
           <?php }?>
        
        <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown">About Us<span class="caret"></span></a>
            <ul class="dropdown-menu">
           <?php foreach ($navLinkings as $navLinking){?>
       <li><a href=""><?php echo $navLinking['our_team']; ?></a></li>
       <li><a href=""><?php echo $navLinking['our_branches']; ?></a></li>
       
           <li><a href=""><?php echo $navLinking['contact_us']; ?></a></li>   
           <?php }?>      
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Services <span class="caret"></span></a>
            <ul class="dropdown-menu">
      <?php foreach ($services as $service){?>
          <li><a href=""><?php echo ucfirst($service['title']); ?></a></li>
           <?php }?>
            </ul>
          </li><?php foreach ($navLinkings as $navLinking){?>
          <li><a href=""><?php echo $navLinking['schedule_pickup']; ?></a></li>


          <li><a href=""><?php echo $navLinking['blog']; ?></a></li>
          <?php }?>
        </ul>
    </div>
  </div>
</nav>




<div class="container"><!--First Container-->
    <div class="col-md-12">
    <div class="well">
<div class="row">
  <?php foreach ($navLinkings as $navLinking){?>
  <center><h3> <?php echo strtoupper($navLinking['our_branches']); ?></h3> </center><hr> <br>
  <?php }?>





            <?php 
            $stmt = $db_conn->prepare('SELECT * FROM branches ORDER BY id ASC');
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) 
                    {
                      while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                        {
                          extract($row);?>
      <div class="col-md-4" >
            <center><h4 class="our_branches_title"> <?php echo strtoupper($row['location_name']); ?></h4>  </center>
            <img src="uploads/<?php echo $row['image']; ?>" class="img-responsive our_branches_image"><br>
          <p class="our_branches_textual"><?php echo ucfirst($row['textual_content']); ?>
     <br> <a href="edit_our_branches_page?edit_id=<?php echo $row['id']; ?>"><button type='button' class='btn btn-edit' aria-hidden='true'> <span class="glyphicon glyphicon-edit" ></span> EDIT THIS EMPLOYEE </button></a>
          </p>

         
    </div>
     <?php }}?>
</div>
     
    </div>
 
    </div>

</div><!--END First Container-->


