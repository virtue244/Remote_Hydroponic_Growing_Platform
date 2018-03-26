<?php
include_once('includes/header.php');
include_once('includes/contact_inc.php');
?>
<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
    <div class="col-md-8 animated slideInUp">
    <div class="well">
      <center>


          <h2>Do You Have Any Queries? <br>Send Us a Message</h2><br><br>

    <form method="post" class="schedule_form animated slideInUp" action="contact" autocomplete="off">
    <!-- Display Validation Here -->
    <?php include_once('includes/errors.php'); ?><br>
    	  <div class="form-group">
           <input type="hidden" name="message_title" class="form-control" value="<?php echo 'Queries'; ?>">
          </div>
          <div class="form-group">
          <input type="text" class="form-control" name="full_name" placeholder="Full Name" value="<?php if(isset($full_name)): echo $full_name; endif;?>">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" name="address" placeholder="Address (Optional)" value="<?php if(isset($address)): echo $address; endif;?>">
        </div>

          <div class="form-group">
          <input type="text" class="form-control" name="mobile_phone" placeholder="Mobile Phone" value="<?php if(isset($mobile_phone)): echo $mobile_phone; endif;?>">
         </div>
         <div class="form-group">
          <input type="email" class="form-control" name="email" placeholder="E-mail (Optional)" value="<?php if(isset($email)): echo $email; endif;?>">
         </div>
         <div class="form-group">
          <textarea class="form-control" rows="8" name="message" placeholder="Message" value="<?php if(isset($message)): echo $message; endif;?>"></textarea>
         </div>
         <div class="form-group">
          <br><button type="submit" value="Login" name="btn_message" class="btn btn-success ">Submit</button><br>
        </div>
      </form>
    
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



  

  