 <?php 
 session_start();
include_once('db_conn/config.php');

//Create insert data into header_links
          include_once('includes/create_tables.php');

      $id = 1;
      $Check_id = $db_conn->prepare("SELECT id FROM header_links WHERE id = ?");
            $Check_id->execute([$id]);
            if($Check_id->rowCount() != 1)
            {
              //Create insert data into navigation
      $sql = "INSERT INTO header_links (brand_name, image, home, our_services, price_list, our_team, our_branches, contact_us, subscribe, schedule_pickup, blog, sign_in, contact_mobile_phone, last_time_edited_by)
          VALUES ('Raspberry', '67705.png', 'Home', 'Services', 'Price List', 'Team', 'Branches', 'Contact', 'Subscribe', 'Schedule a Business', 'Blog', 'Sign In', '+12395672324', 'Doe')";  
          $db_conn->exec($sql);
            }else{
              echo " ";
            }
//Create insert data into header_links

//Create insert data into header_links

      $id = 1;
      $Check_id = $db_conn->prepare("SELECT id FROM slider WHERE id = ?");
            $Check_id->execute([$id]);
            if($Check_id->rowCount() != 1)
            {
              //Create insert data into navigation
      $sql = "INSERT INTO slider (indicators, item, title, subtitle, image, last_time_edited_by)
          VALUES ('0', 'item active', 'Welcome to Raspberry PI!', 'Subscribe to receive our newsletter!', '66153.gif', 'Doe')";  
          $db_conn->exec($sql);

          $sql_two = "INSERT INTO slider (indicators, item, title, subtitle, image, last_time_edited_by)
          VALUES ('1', 'item', 'Any Questions or Concerns?', 'Get in touch with us ASAP!', '72493.jpg', 'Doe')";  
          $db_conn->exec($sql_two);

          $sql_three = "INSERT INTO slider (indicators, item, title, subtitle, image, last_time_edited_by)
          VALUES ('2', 'item', 'Technology is evolving, and so we are!', 'Advancement of commencement!', '760765.jpg', 'Doe')";  
          $db_conn->exec($sql_three);
            }else{
              echo " ";
            }
//Create insert data into header_links

include_once('includes/classes.php');


 if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../index");
  }

$service = new Services;
$services = $service->fetch_all();

$price_list = new PricesList;
$price_lists = $price_list->fetch_all();

$team = new OurTeam;
$teams = $team->fetch_all();

$teamContent = new ContentOurTeam;
$teamContents = $teamContent->fetch_all();

$branch = new OurBranches;
$branches = $branch->fetch_all();

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

  function create_slug($string){
     $slug=preg_replace('/[^A-Za-z0-9-!?]+/', '-', $string);
     return $slug;
  }
 
?>
<!DOCTYPE html>

<html lang="en">
<head>
   <title>Raspberry PI: Where Technology Lives</title>
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

  <?php include_once('custom_css.php'); ?>
  <link rel="stylesheet" href="tools/css/animate.css">
  <link rel="stylesheet" href="tools/css/bootstrap.min.css">
   <!--- <link rel="stylesheet" href="tools/css/bootstrap.css">-->
  <link rel="stylesheet" href="tools/font-awesome/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>

   <script src="tools/js/jquery.min.js"></script>
  <script src="tools/js/carouselCaption.js"></script>
  <script src="tools/js/bootstrap.min.js"></script>
  <script src="tools/js/bootstrap.js"></script>

</head>

<body>
  <?php include_once('includes/ip_address.php'); ?>
<?php foreach ($navLinkings as $navLinking){?>
<div style='color: orange; padding-right: 15px; top: -36px !important; position: relative; float: right;' class='glyphicon glyphicon-phone'><strong> <em><?php echo $navLinking['contact_mobile_phone']; ?></em></strong></div>

  <!--- NAVIGATION-->
<nav class="navbar navbar-default ">
  <div class="container-fluid" >
    <div class="navbar-header" >
      
      <?php }?>

      <?php foreach ($navLinkings as $navLinking){?>
<!--LOGO-->
<div class="brand_name_logo"><a href="index" style="text-decoration: none;"><img src="uploads/<?php echo $navLinking['image']; ?>" class="img-responsive animated slideInLeft"></a></div>
 <!--/LOGO--><?php }?>
        <button type="button" class="navbar-toggle mobile_menu" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      
    </div>
      <div class="collapse navbar-collapse" id="myNavbar" >
        <ul class="nav navbar-nav navbar-right" >
          <?php foreach ($navLinkings as $navLinking){?>
          <li><a href="index"><?php echo $navLinking['home']; ?></a></li> 
           <?php }?>
        
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<span class="caret"></span></a>
            <ul class="dropdown-menu">
           <?php foreach ($navLinkings as $navLinking){?>
       <li><a href="our_team?id="><?php echo $navLinking['our_team']; ?></a></li>
       <li><a href="our_branches?id="><?php echo $navLinking['our_branches']; ?></a></li>
       
           <li><a href="contact"><?php echo $navLinking['contact_us']; ?></a></li>
           <?php 
             if (!isset($_SESSION['username'])) {
  
            ?>
           <li><a href="subscribe"><?php echo $navLinking['subscribe']; ?></a></li>   
           <?php }?> 
           <?php }?>       
            </ul>
          </li>
          <?php foreach ($navLinkings as $navLinking){?>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $navLinking['our_services']; ?><span class="caret"></span></a>
            <?php }?>
            <ul class="dropdown-menu">
      <?php foreach ($services as $service){?>
          <li><a href="our_services?id=<?php echo $service['id'];?>"><?php echo ucfirst($service['title']); ?></a></li>
           <?php }?>
            </ul>
          </li><?php foreach ($navLinkings as $navLinking){?>
          <li><a href="price_list"><?php echo $navLinking['price_list']; ?></a></li>
          <li><a href="pickup_schedule"><?php echo $navLinking['schedule_pickup']; ?></a></li>
          <li><a href="blog"><?php echo $navLinking['blog']; ?></a></li>
            <?php 
             if (!isset($_SESSION['username'])) {

            ?>
          <li><a href="login"><?php echo $navLinking['sign_in']; ?></a></li>
          <?php }else{ ?>
          <?php  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
                      $row['user_type'] ='user';

                    if($row['user_type'] == 'user'){?>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> <strong style="color: #001; cursor: pointer;">Hi <?php echo ucfirst($_SESSION['username']); ?></strong></a>
              <ul class="dropdown-menu">
          <li><a href="includes/logout.php?logout='1'">Logout</a></li>
            </ul>
            </li>
          <?php }else{
            if($row['user_type'] == 'admin'){ ?>
              <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> <strong style="color: #001; cursor: pointer;">Hi <?php echo ucfirst($_SESSION['username']); ?></strong> <span class="label label-pill label-danger count" style="border-radius:10px;"></span></a>
              <ul class="dropdown-menu"> 
                <li><a href="admin/index?=Welcome <?php echo $_SESSION['username']; ?>!">Admin Page</a></li>
                <li><a href="includes/logout.php?logout='1'">Logout</a></li>
                <!--Show Notifications Here-->
                <li class=" pickup_schedule_message"><a href=""></a></li>
            </ul>
            </li>
                   <?php }}} ?>
                   <?php }?>
        </ul>
    </div>
  </div>
</nav><!--- End NAVIGATION-->




