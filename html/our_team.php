<?php
include_once('includes/header.php');
?>



<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
    <div class="col-md-8 animated slideInUp">
    <div class="well">
<div class="row" id="team">
    <?php foreach ($teamContents as $teamContent){?>
  <center><strong id="services"><?php echo ucfirst($teamContent['title']); ?></strong></center><br>
  
  <center><p style="font-size: 18px; text-align: left;"><?php echo ucfirst($teamContent['textual_content']); ?></p></center>
  <?php }?>
<?php foreach ($teams as $team){?>
      <div class="col-md-4 animated slideInUp" style="background-color: lightgrey;">
      <center>
       <img src="uploads/<?php echo $team['image']; ?>" class="img-responsive">
          <div class="our_team">          
            <h3><?php echo ucfirst($team['first_name']); ?> <?php echo ucfirst($team['last_name']); ?></h3>
          <p class="user_position"><strong><?php echo ucfirst($team['position']); ?></strong></p>
          <a target="_blank" href="<?php echo $team['first_social_media_link'];?>" class="fa"><i class="fa fa-<?php echo $team['first_social_media_icon']; ?>"></i></a>
          <a target="_blank" href="<?php echo $team['second_social_media_link'];?>" class="fa"><i class="fa fa-<?php echo $team['second_social_media_icon']; ?>"></i></a><br>
        </div>

      </center>      
    </div>
     <?php }?>


</div>
    
    </div>

      
    </div>
        <div class="col-md-4 animated slideInUp">
  <div class="well">
<?php foreach ($pickupScheduleSections  as $pickupScheduleSection ){?>
          <center><h2><?php echo $pickupScheduleSection['title']; ?></h2></center><br>
          <img src="uploads/<?php echo $pickupScheduleSection['image']; ?>" class="img-responsive">
           <center><a href="pickup_schedule"><button class="btn btn-default custom_btn"><?php echo $navLinking['schedule_pickup']; ?></button></a></center>
    <?php }?>  
  </div>
</div>


    <div class="col-md-4 animated slideInUp">
  <div class="well">
     <?php foreach ($navLinkings as $navLinking){?>
    <div class="header"><h4><u><?php echo $navLinking['our_services']; ?></u></h4><br></div>
    <?php }?>
    <?php foreach ($services as $service){?>
               <center><a style="text-decoration: none; color: #fff;" href="our_services?id=<?php echo $service['id'];?>-<?php echo $service['title']; ?>"><p class="services_menu"><?php echo ucfirst($service['title']); ?></p></a><br></center>
               <?php }?>
  </div>
</div>
  </div><!--END First Row-->
</div><!--END First Container-->


<?php
include_once('includes/footer.php');
?>



  

