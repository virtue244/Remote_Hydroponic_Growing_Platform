    
     <?php //Display Login Page
 //nl2br
//if (isset($_POST['database_btn'])){
  
  ?><?php
include_once('db_conn/config.php');
include_once('includes/classes.php');

$service = new Services;
$services = $service->fetch_all();

$team = new OurTeam;
$teams = $team->fetch_all();

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


       if (isset($_GET['id'])){
  //display blogPost
  $post_id = $_GET['id'];
  $post_data = $blogPost->fetch_post($post_id);

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
  <link rel="stylesheet" href="tools/css/animate.css">
  <link rel="stylesheet" href="tools/css/bootstrap.min.css">
  <link rel="stylesheet" href="tools/font-awesome/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>

   <script src="tools/js/jquery.min.js"></script>
  <script src="tools/js/carouselCaption.js"></script>
  <script src="tools/js/bootstrap.min.js"></script>

  <script type="text/javascript">
  $(window).load(function(){
    $(".loader").fadeOut("slow");
});

</script>
</head>

<body>

<div class="loader"></div>

<?php foreach ($navLinkings as $navLinking){?>
<h4 style='color: orange; padding-right: 15px; top: 6px !important; position: relative; float: right;' class='glyphicon glyphicon-phone'><strong> <em><?php echo $navLinking['contact_mobile_phone']; ?></em></strong></h4>

<nav class="navbar navbar-default ">
  <div class="container-fluid" >
    <div class="navbar-header" >
  <!--LOGO-->
 <a href="index" style="text-decoration: none;"><h1><img src="uploads/<?php echo $navLinking['image']; ?>" class="img-responsive brand_name_logo"></h1></a>
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
          <li><a href="index"><?php echo $navLinking['home']; ?></a></li> 
           <?php }?>
        
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<span class="caret"></span></a>
            <ul class="dropdown-menu">
           <?php foreach ($navLinkings as $navLinking){?>
       <li><a href="our_team?id="><?php echo $navLinking['our_team']; ?></a></li>
       
           <li><a href="contact"><?php echo $navLinking['contact_us']; ?></a></li>   
           <?php }?>      
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Our Services <span class="caret"></span></a>
            <ul class="dropdown-menu">
      <?php foreach ($services as $service){?>
          <li><a href="our_services?id=<?php echo $service['id'];?>"><?php echo ucfirst($service['title']); ?></a></li>
           <?php }?>
            </ul>
          </li><?php foreach ($navLinkings as $navLinking){?>
          <li><a href="pickup_schedule"><?php echo $navLinking['schedule_pickup']; ?></a></li>


          <li><a href="blog"><?php echo $navLinking['blog']; ?></a></li>
          <?php }?>
        </ul>
    </div>
  </div>
</nav>
    <div class="container"><!-- Container for all content begins here! -->



          <p style="text-align:center;
       font: 200 50px/1.3 'Arizonia', Helvetica, sans-serif;
      text-shadow: 4px 4px 0px rgba(0,0,0,0.1);
      color:#000; font-weight:bold;">Blog</p></center></br><hr><br>

<div class="row">

        <div class="col-md-8 animated slideInUp"> 

        <div class="well" style="">
          <p ><em><?php echo strtoupper($post_data['post_category']); ?> :</em></p>
        <center><h4><strong><?php echo strtoupper($post_data['post_title']); ?></strong></h4></center><hr><br>
        <center><img src="uploads/<?php echo $post_data['image']; ?>" class="img-responsive "></center><br><br>
        <P class="post_author"><img  style="width: 40px !important; height: 40px !important; border-radius: 100% !important; margin-right: 10px !important;" src="uploads/<?php echo $post_data['image']; ?>"><em> By <strong><?php echo $post_data['post_author']; ?></strong>, <?php echo $post_data['timestamp']; ?></em></P><br>
          
          <p><?php echo $post_data['post_textual_content'];?></p>

        </div>

        <br><hr><br>
          
        </div>


      <div class="col-md-4 animated slideInUp">
        
        <div class="well">
          <center><h5><strong><u>RECENT POSTS</u></strong></h5></center><br>
          <?php foreach ($blogPostRecentSections  as $blogPostRecentSection ){?> 
            <div class="well">
              <a href="blog_post?id=<?php echo $blogPostRecentSection['id'];?>-<?php echo create_slug($blogPostRecentSection['post_title']); ?>"><center><h4><strong><?php echo strtoupper($blogPostRecentSection['post_title']); ?></strong></h4><br>
          <img src="uploads/<?php echo $blogPostRecentSection['image']; ?>" class="img-responsive "></center></a>
            </div>
          <?php }?>
        </div>

        <div class="well">
          <center><h5><strong><u>MOST READ POST</u></strong></h5></center>
          <?php foreach ($blogPostMostReads  as $blogPostMostRead ){?> 
            <div class="well">
              <a href="blog_post?id=<?php echo $blogPostMostRead['id'];?>-<?php echo create_slug($blogPostMostRead['post_title']); ?>"><center><h4><strong><?php echo strtoupper($blogPostMostRead['post_title']); ?></strong></h4><br>
          <img src="uploads/<?php echo $blogPostMostRead['image']; ?>" class="img-responsive "></center></a>
            </div>
          <?php }?>
        </div>
          
      </div>

</div>
</div>


<?php
//include header';
include_once'includes/footer.php';
?>

<?php
  }else
  {
  header('Location: blog.php');
  exit();
}
?>