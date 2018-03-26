<?php
include_once('includes/header.php');
?>



<div class="container"><!--First Container-->
    <div class="col-md-12 ">
    <div class="well">
<div class="row">
  <?php foreach ($navLinkings as $navLinking){?>
  <center><h3 class="animated slideInUp"> <?php echo strtoupper($navLinking['our_branches']); ?></h3> </center><hr> <br>
  <?php }?>
<?php foreach ($branches as $branch){?>
      <div class="col-md-4 animated slideInUp" >
            <center><h4 class="our_branches_title"> <?php echo strtoupper($branch['location_name']); ?></h4>  </center>
            <img src="uploads/<?php echo $branch['image']; ?>" class="img-responsive our_branches_image"><br>
          <p class="our_branches_textual"><?php echo ucfirst($branch['textual_content']); ?></p> 
    </div>
     <?php }?>
</div>
     
    </div>

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

</div><!--END First Container-->


<?php
include_once('includes/footer.php');
?>



  

