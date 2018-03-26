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

  <!--END TOGGLE COLLAPSE LIST-->
  <center><a href='#section_one' data-toggle='collapse' >
    <button type='button' name='add_comment' id='add_comment' class='btn btn-danger' aria-hidden='true'><span class="glyphicon glyphicon-edit" ></span> EDIT SECTION <span class="badge" title="CLICK TO EDIT THIS SECTION" > 1</span></button>
    </a>
<div id='section_one' class='collapse' style='text-align: center;'>
    <form method="post" class="home_page_edit_form" action="edit_home_page.php" autocomplete="off" enctype="multipart/form-data">
    <!-- Display Validation Here -->
    <?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
    <?php } ?>
          <div class="form-group">
            <?php foreach ($navLinkings as $navLinking){?>
            <p><em>Last Time Edited: <strong><?php echo date('F jS, Y', $navLinking['timestamp']); ?></strong> by <strong><?php echo ucfirst($navLinking['last_time_edited_by']); ?></strong></em></p>
            
            <label style="float: left !important;">Edit Company Logo:</label>
            <div class="col-md-3"><br><img src="uploads/<?php echo $navLinking['image']; ?>" style=" float: left; position: relative; margin-bottom: 40px; width: 237.5px; height: 118.75px;" class="img-responsive"><br></div>
          <input style=" float: left; position: relative; margin-bottom: 10px;" type="file"  name="image" accept="*/image" class="form-control" value="<?php echo $navLinking['image']; ?>" width="200">
         </div>
          <div class="form-group">
            <label style="float: left !important;">Edit Your Phone Number:</label>
          <input type="text" class="form-control" name="contact_mobile_phone" value="<?php echo $navLinking['contact_mobile_phone']; ?>">
          <?php }?>
         </div>
         <div class="form-group">
          <input type="hidden" class="form-control" name="last_time_edited_by" value="<?php echo $_SESSION['username']; ?>">
         </div>
         <div class="form-group">
          <br><button type="submit" value="Login" name="btn_section_one" class="btn btn-success">Submit</button><br>
        </div>
        <?php if (isset($error_two)) {?>
        <h4 class="error"><?php echo $error_two; ?></h4>
    <br/><br/>
    <?php } ?>
      </form>
    </div>
</div></center><!--END TOGGLE COLLAPSE LIST-->

<?php foreach ($navLinkings as $navLinking){?>


<nav class="navbar navbar-default ">
  <div class="container-fluid" >
    <div class="navbar-header" >
      <br><br><h4 style='color: orange; padding-right: 10px; top: -36px !important; position: relative; float: right;' class='glyphicon glyphicon-phone'><strong> <em><?php echo $navLinking['contact_mobile_phone']; ?></em></strong></h4>
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
          <li class="dropdown"><a  class="dropdown-toggle" data-toggle="dropdown">Our Services <span class="caret"></span></a>
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


<!-- IMAGE SLIDER --> 
<div class="slider">
  <div id="slider1" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
      <?php foreach ($sliders as $slider){?>
      <li data-target="#slider1" data-slide-to="<?php echo $slider['slider_carousel_indicators']; ?>" class="active"></li>
      <?php }?>
    </ol>


    <!-- Wrapper for slides -->
    <div class="carousel-inner">
<?php foreach ($sliders as $slider){?>
      <div class="<?php echo $slider['item']; ?>">
        <img src="uploads/<?php echo $slider['image']; ?>" alt="image" alt="Slider">
        <div class="carousel-caption">
        <a href="edit_slider_section?edit_id=<?php echo $slider['id']; ?>"><button type='button' data-toggle="modal" data-target="#editServices" class='btn btn-danger' aria-hidden='true'><span class="glyphicon glyphicon-edit" ></span> EDIT THIS SLIDER </button></a>
          <h1 class="animated slideInUp"><?php echo $slider['title']; ?></h1>
          <h4 class="animated zoomInLeft "><?php echo $slider['subtitle']; ?></h4>
           <?php foreach ($navLinkings as $navLinking){?>
          <a href="" ><button class="btn btn-default get_started_btn animated slideInRight"><?php echo $navLinking['schedule_pickup']; ?></button></a>
          <a href="" ><button class="btn btn-default contact_us_btn animated slideInLeft"><?php echo $navLinking['contact_us']; ?></button></a>
          <?php }?> 
        </div>
      </div>
<?php }?>
    
    </div>

    <!-- Controls -->
    <a href="#slider1" class="left carousel-control" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
    </a>
    <a href="#slider1" class="right carousel-control" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
    </a>
  </div>
</div>
<!-- END IMAGE SLIDER --> 







<!-- SERVICES -->
<div id="our_services">

<div class="container">
          <div class="col-md-12" style="box-shadow: none !important;">
  <div class="well">
    <?php foreach ($pickupScheduleSections  as $pickupScheduleSection ){?>
      <!--TOGGLE COLLAPSE LIST-->
  <center><a href='#section_three' data-toggle='collapse' >
    <button type='button' name='add_comment' id='add_comment' class='btn btn-danger' aria-hidden='true'><span class="glyphicon glyphicon-edit" ></span> EDIT SECTION <span class="badge" title="CLICK TO EDIT THIS SECTION" > 3</span></button>
    </a>
<div id='section_three' class='collapse' style='text-align: center;'>
    <form method="post" class="home_page_edit_form" autocomplete="off" enctype="multipart/form-data">
    <!-- Display Validation Here -->
    <?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
    <?php } ?>

         <?php foreach ($pickupScheduleSections as $pickupScheduleSection){?>
        <div class="form-group">
           <p><em>Last Time Edited: <strong><?php echo date('F jS, Y', $pickupScheduleSection['timestamp']); ?></strong> by <strong><?php echo ucfirst($pickupScheduleSection['last_time_edited_by']); ?></strong></em></p>
            <label style="float: left !important;">Edit Image:</label><br>
 <div class="col-md-3"><br><img src="uploads/<?php echo $pickupScheduleSection['image']; ?>" style=" float: left; position: relative; margin-bottom: 40px; width: 240px;" class="img-responsive"><br></div>
          <input style=" float: left; position: relative; margin-bottom: 10px;" type="file"  name="image" accept="*/image" class="form-control" value="<?php echo $pickupScheduleSection['image']; ?>" width="200">
         </div>

          <div class="form-group">
            <label style="float: left !important;">Edit Textual Content:</label>
          <textarea  class="form-control" rows="12" name="textual_content" ><?php echo $pickupScheduleSection['textual_content']; ?></textarea>
         </div><?php }?>
         <div class="form-group">
          <input type="hidden" class="form-control" name="last_time_edited_by" value="<?php echo $_SESSION['username']; ?>">
         </div>
         <div class="form-group">
          <br><button type="submit" value="Login" name="btn_section_three" class="btn btn-success">Submit</button><br>
        </div>
        <?php if (isset($error_two)) {?>
        <h4 class="error"><?php echo $error_two; ?></h4>
    <br/><br/>
    <?php } ?>
      </form>
    </div>
</div></center><!--END TOGGLE COLLAPSE LIST-->
    <center><h3><?php echo $pickupScheduleSection['title']; ?></h3><br>
       <img src="uploads/<?php echo $pickupScheduleSection['image']; ?>" class="img-responsive">
      <p ><?php echo $pickupScheduleSection['textual_content']; ?></p>
      <?php }?>  
      <?php foreach ($navLinkings as $navLinking){?>
               <a><button class="btn btn-default"><?php echo $navLinking['schedule_pickup']; ?></button></a>
               <?php }?>  <br><br><br>
  </div>
</div>



  <center><p id="services">OUR SERVICES</p></center><br>
<div class="well">
<div class="row" >

                <?php 
                $stmt = $db_conn->prepare('SELECT * FROM services ORDER BY id ASC');
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) 
                  {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row);
                  
                ?>

      <div class="col-md-3">
      <center>

          <div class="edit_our_services" >       
          <p class="services" title="CLICK TO EDIT THIS SECTION"><?php echo ucfirst($row['title']); ?> <img src="uploads/<?php echo $row['image']; ?>" class="img-responsive">
            <a href="edit_service_section?edit_id=<?php echo $row['id']; ?>"><button type='button' data-toggle="modal" data-target="#editServices" class='btn btn-danger' aria-hidden='true'><span class="glyphicon glyphicon-edit" ></span> EDIT THIS SECTION </button></a></p>

        </div>
        
      </center>      
    </div>
    <?php     } }?>
    

</div>


</div>


</div>
</div>
<!-- END SERVICES -->








<!-- FOOTER  -->
<div id="footer" >

  <div class="container" style="padding-top: 5%;">

    <hr>

    <div class="row">
              <!--END TOGGLE COLLAPSE LIST-->
  <center><a href='#section_five' data-toggle='collapse' >
    <button type='button' name='add_comment' id='add_comment' class='btn btn-danger' aria-hidden='true'><span class="glyphicon glyphicon-edit" ></span> EDIT SECTION <span class="badge" title="CLICK TO EDIT THIS SECTION" > 5</span></button>
    </a>
<div id='section_five' class='collapse' style='text-align: center;'>
    <form method="post" class="home_page_edit_form" action="edit_home_page.php" autocomplete="off">
    <!-- Display Validation Here -->
    <?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
    <?php } ?>
          <?php foreach ($footerSections as $footerSection){?>
          <p><em>Last Time Edited: <strong><?php echo date('F jS, Y', $footerSection['timestamp']); ?></strong> by <strong><?php echo ucfirst($footerSection['last_time_edited_by']); ?></strong></em></p>
         <div class="form-group">
            <label style="float: left !important;">Edit About us Textual Content:</label>
          <textarea rows="8" class="form-control" name="about_us_textual_content"><?php echo $footerSection['about_us_textual_content']; ?></textarea>
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Whom to Contact:</label>
          <input type="text" class="form-control" name="position_name" value="<?php echo $footerSection['position_name']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Company Name:</label>
          <input type="text" class="form-control" name="company_name" value="<?php echo $footerSection['company_name']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Physical Address:</label>
          <input type="text" class="form-control" name="physical_address" value="<?php echo $footerSection['physical_address']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Street:</label>
          <input type="text" class="form-control" name="street" value="<?php echo $footerSection['street']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit City:</label>
          <input type="text" class="form-control" name="city" value="<?php echo $footerSection['city']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Country:</label>
          <input type="text" class="form-control" name="country" value="<?php echo $footerSection['country']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Contact Phone:</label>
          <input type="text" class="form-control" name="mobile_phone" value="<?php echo $footerSection['mobile_phone']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit E-mail:</label>
          <input type="text" class="form-control" name="email" value="<?php echo $footerSection['email']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit First Social Media Link:</label>
          <input type="text" class="form-control" name="first_social_media_link" value="<?php echo $footerSection['first_social_media_link']; ?>">
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Second Social Media Link:</label>
          <input type="text" class="form-control" name="second_social_media_link" value="<?php echo $footerSection['second_social_media_link']; ?>">
         </div>
         <div class="form-group">
          <label style="float: left !important;">Edit First Social Media Icon:</label>
          <select name="first_social_media_icon" class="form-control" >
            <option selected data-default><?php echo $footerSection['first_social_media_icon']; ?></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
         <div class="form-group">
            <label style="float: left !important;">Edit Second Social Media Icon:</label>
            <select name="second_social_media_icon" class="form-control" >
            <option selected data-default><?php echo $footerSection['second_social_media_icon']; ?></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
          <?php }?>
          <div class="form-group">
          <input type="hidden" class="form-control" name="last_time_edited_by" value="<?php echo $_SESSION['username']; ?>">
         </div>
         <div class="form-group">
          <br><button type="submit" value="Login" name="btn_section_five" class="btn btn-success">Submit</button><br>
        </div>
        <?php if (isset($error_two)) {?>
        <h4 class="error"><?php echo $error_two; ?></h4>
    <br/><br/>
    <?php } ?>
      </form>
    </div>
</div></center><!--END TOGGLE COLLAPSE LIST-->
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



