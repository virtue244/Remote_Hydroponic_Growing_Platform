<?php
include_once('includes/header.php');

?>

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
        <div class="slider_image_shed">
        <div class="carousel-caption">
          <br><br><br>
          <br>
          <h2 class="animated slideInUp"><?php echo $slider['title']; ?></h2>
          <h4 class="animated zoomInLeft "><?php echo $slider['subtitle']; ?></h4>
              <!-- SLIDER BUTTONS--> 
 <center><?php foreach ($navLinkings as $navLinking){?>
          <a href="pickup_schedule" ><button class="btn btn-default get_started_btn animated slideInRight slideInUp" title="Schedule a Pickup"><?php echo $navLinking['schedule_pickup']; ?></button></a>
          <?php 
             if (!isset($_SESSION['username'])) {
  
            ?>
          <a href="subscribe?=<?php echo $navLinking['subscribe']; ?>" ><button class="btn btn-default contact_us_btn animated slideInLeft" title="Subscribe"><?php echo $navLinking['subscribe']; ?></button></a>

          <?php 
            $_SESSION['subscribe'] = "Hi there! Please Register to Subscribe!";
        }else{ ?>
          <?php  if (isset($_SESSION['username'])) {?>
           <a href="contact?=<?php echo $navLinking['contact_us']; ?>" ><button class="btn btn-default contact_us_btn animated slideInLeft" title="Contact Us"><?php echo $navLinking['contact_us']; ?></button></a>
          <?php }}?> 
          <?php }?> 
</center><!-- END SLIDER BUTTONS--> 
        </div>
        </div><!-- END SLIDER IMAGE SHED--> 
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
    <center><h3><?php echo $pickupScheduleSection['title']; ?></h3><br>
       <img src="uploads/<?php echo $pickupScheduleSection['image']; ?>" class="img-responsive"><br>
      <p ><?php echo $pickupScheduleSection['textual_content']; ?></p>
      <?php }?>  
      <?php foreach ($navLinkings as $navLinking){?>
               <a href="pickup_schedule"><button class="btn btn-default custom_btn"><?php echo $navLinking['schedule_pickup']; ?></button></a>
               <?php }?>  
  </div>
</div>

  <center><p id="services">OUR SERVICES</p></center><br>

<div class="well">
<div class="row" >


 <?php foreach ($services as $service){?> 
 <center>
      <div class="col-md-3">
          <div class="our_services" >       
          <p class="services"><a href="our_services?id=<?php echo $service['id'];?>-<?php echo $service['title']; ?>"><?php echo ucfirst($service['title']); ?> <img src="uploads/<?php echo $service['image']; ?>" class="img-responsive"></a></p>
        </div>
    </div>
    </center> 
    <?php }?>

    

</div>


</div>


</div>
</div>
<!-- END SERVICES -->


<?php
include_once('includes/footer.php'); ?>