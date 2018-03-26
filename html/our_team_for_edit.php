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
include_once('db_conn/config.php');
include_once('includes/classes.php');

$service = new Services;
$services = $service->fetch_all();


$teamContent = new ContentOurTeam;
$teamContents = $teamContent->fetch_all();

$navLinking = new NavLinking;
$navLinkings = $navLinking->fetch_all();

$slider = new Slider;
$sliders = $slider->fetch_all();

$pickupScheduleSection = new PickupScheduleSection;
$pickupScheduleSections = $pickupScheduleSection->fetch_all();

$footerSection = new FooterSection;
$footerSections = $footerSection->fetch_all();

$blogPost = new BlogPost;
$blogPosts = $blogPost->fetch_all();


$blogPostRecentSection = new BlogPostRecentSection;
$blogPostRecentSections = $blogPostRecentSection->fetch_all();

$blogPostMostRead = new BlogPostMostRead;
$blogPostMostReads = $blogPostMostRead->fetch_all();
//CODE for slug
  function create_slug($string){
     $slug=preg_replace('/[^A-Za-z0-9-!?]+/', '-', $string);
     return $slug;
  }
  //END CODE for slug
 
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
<center><h4 style="color: #fff;" >Call Us On <strong style="color: orange !important;"><?php echo $navLinking['contact_mobile_phone']; ?></strong></h4></center>

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
          <li><a ><?php echo $navLinking['home']; ?></a></li> 
           <?php }?>
        
        <li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown">About Us<span class="caret"></span></a>
            <ul class="dropdown-menu">
           <?php foreach ($navLinkings as $navLinking){?>
       <li><a ><?php echo $navLinking['our_team']; ?></a></li>
       
           <li><a ><?php echo $navLinking['contact_us']; ?></a></li>   
           <?php }?>      
            </ul>
          </li>
          <?php foreach ($navLinkings as $navLinking){?>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $navLinking['our_services']; ?><span class="caret"></span></a>
            <?php }?>
            <ul class="dropdown-menu">
      <?php foreach ($services as $service){?>
          <li><a ><?php echo ucfirst($service['title']); ?></a></li>
           <?php }?>
            </ul>
          </li><?php foreach ($navLinkings as $navLinking){?>
          <li><a ><?php echo $navLinking['schedule_pickup']; ?></a></li>


          <li><a ><?php echo $navLinking['blog']; ?></a></li>
          <?php }?>
        </ul>
    </div>
  </div>
</nav>




<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
        <!--END TOGGLE COLLAPSE LIST-->
  <center><a href='#section_one' data-toggle='collapse' >
    <button type='button' name='add_comment' id='add_comment' class='btn btn-danger ' aria-hidden='true'> <span class="glyphicon glyphicon-edit" ></span> EDIT TEXTUAL SECTION </button>
    </a>
<div id='section_one' class='collapse' style='text-align: center;'>
    <form method="post" class="home_page_edit_form" action="our_team_for_edit.php" autocomplete="off">
    <!-- Display Validation Here -->
    <?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
    <?php } ?>
    <?php foreach ($teamContents as $teamContent){?>
          <div class="form-group">
            <label style="float: left !important;">Edit Brand Name:</label>
          <textarea  class="form-control" rows="12" name="textual_content" ><?php echo $teamContent['textual_content']; ?></textarea>
         </div>
         <?php }?>
         <div class="form-group">
          <br><button type="submit" value="Login" name="btn_our_team_edit" class="btn btn-success">Submit</button><br>
        </div>
        <?php if (isset($error_two)) {?>
        <h4 class="error"><?php echo $error_two; ?></h4>
    <br/><br/>
    <?php } ?>
      </form>
    </div>
</div></center><!--END TOGGLE COLLAPSE LIST-->
    <div class="col-md-12">
    <div class="well">
<div class="row" id="team"> 
    <?php foreach ($teamContents as $teamContent){?>
  <center><strong id="services"><?php echo ucfirst($teamContent['title']); ?></strong></center><br>
  
  <center><p style="font-size: 18px; text-align: left;"><?php echo ucfirst($teamContent['textual_content']); ?></p></center>
  <?php }?>
                      <?php 
                $stmt = $db_conn->prepare('SELECT * FROM team ORDER BY id ASC');
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) 
                  {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row);
                  
                ?>


      <div class="col-md-4" style="background-color: lightgrey;">
      <center>
       <img src="uploads/<?php echo $row['image']; ?>" class="img-responsive" width="60">
          <div class="our_team">          
            <h3><?php echo ucfirst($row['first_name']); ?> <?php echo ucfirst($row['last_name']); ?></h3>
          <p class="user_position"><strong><?php echo ucfirst($row['position']); ?></strong></p>
          <a target="_blank" href="" class="fa"><i class="fa fa-<?php echo $row['first_social_media_icon']; ?>"></i></a>
          <a target="_blank" href="" class="fa"><i class="fa fa-<?php echo $row['second_social_media_icon']; ?>"></i></a><br>
        </div>
        <br><a href="edit_our_team_page?edit_id=<?php echo $row['id']; ?>"><button type='button' class='btn btn-edit' aria-hidden='true'> <span class="glyphicon glyphicon-edit" ></span> EDIT THIS EMPLOYEE </button></a> 

      </center>      
    </div>

      <?php  } }?>


</div>
    
    </div>

      
    </div>
  </div><!--END First Row-->
</div><!--END First Container-->


<!-- FOOTER  -->
<div id="footer" >

  <div class="container" style="padding-top: 5%;">

    <hr>

      <div class="col-md-4">
        <?php foreach ($footerSections  as $footerSection ){?>
        <h3 style="color: #fff;"><strong><?php echo $footerSection['about_us_title']; ?></strong></h3>
        <p style="color: #fff;"><?php echo $footerSection['about_us_textual_content']; ?></p>
      </div>
      <div class="col-md-4">
        <h3 style="color: #fff;"><strong><?php echo $footerSection['contact_us']; ?></strong></h3>
        <h5 style="color: #fff;"><strong><?php echo $footerSection['position_name']; ?></strong></h5>
        <h5 style="color: #fff;"><strong><?php echo $footerSection['company_name']; ?></strong></h5>
        <p style="color: #fff;">P.O.BOX <?php echo $footerSection['physical_address']; ?></p>
        <p style="color: #fff;"><?php echo $footerSection['street']; ?></p>
        <p style="color: #fff;"><?php echo $footerSection['city']; ?></p>
        <p style="color: #fff;"><?php echo $footerSection['country']; ?></p>
        
        <p style="color: #fff;">Mobile Phone: <?php echo $footerSection['mobile_phone']; ?></p>
        
        <p style="color: #fff;">Email: <em style="color: #ffd700;"> <?php echo $footerSection['email']; ?></em></p>
      </div>
      <div class="col-md-4">
<center>
        <h3 style="color: #fff;"> <strong><?php echo $footerSection['connect_title']; ?></strong></h3><br/>
        <a target="_blank" title="Visit Our Page" class="fa"><i class="fa fa-<?php echo $footerSection['first_social_media_icon']; ?>"></i></a>

        <a target="_blank" title="Visit Our Page" class="fa"><i class="fa fa-<?php echo $footerSection['second_social_media_icon']; ?>"></i></a>

        <a class="" title="Send us a Message"><i class="fa fa-envelope"></i></a>

</center><?php }?>
      </div>
    </div>

    </br></br></br>
<center><div class="copyrightText" style="color: #fff; border: 1px solid #fff; border-radius: 20px; background-color: #000; padding: 10px;"><center><a href="admin/index">Admin </a>  Copyright © <?php
// if both years are the same, display only the current year ,
// if they are different display both with a dash between them
$startYear = 2018;
$thisYear = date("Y");
if ($startYear == $thisYear) {
echo $startYear;
} else {
echo "<strong>".$startYear."<strong> ~ </strong>".$thisYear."</strong>";
}
?>  All rights reserved. Designed & Developed by <a style="font-weight:bold; ">Powered By <em>Job Gondwe</em> </a></center></div></center></br></br></br>
  </div>
</div>

</body>
</html>
<!-- END FOOTER  -->
