<?php
include_once('includes/header.php');
?>


<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
    <div class="col-md-8 animated slideInUp">
    <div class="well">
      <center>

 <?php foreach ($pickupScheduleSections  as $pickupScheduleSection ){?>
          <h2><?php echo $pickupScheduleSection['title']; ?></h2><br>
          <img src="uploads/<?php echo $pickupScheduleSection['image']; ?>" class="img-responsive">
           <p> <?php echo $pickupScheduleSection['textual_content']; ?> </p><br>
    <?php }?>  

    <form method="post" id="comment_form" class="schedule_form" action="" autocomplete="off">
    <!-- Display Validation Here -->
    <?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
    <?php } ?>
          <div class="form-group">
           <input type="hidden" name="subject" id="subject" class="form-control" value="<?php echo 'Pickup&Delivery'; ?>">
          </div>
          <div class="form-group">
          <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?php if(isset($full_name)): echo $full_name; endif;?>">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" id="street" name="street"  placeholder="Street" value="<?php if(isset($street)): echo $street; endif;?>">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" id="district" name="district" placeholder="District" value="<?php if(isset($district)): echo $district; endif;?>">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" id="mobile_phone" name="mobile_phone" placeholder="Mobile Phone" value="<?php if(isset($mobile_phone)): echo $mobile_phone; endif;?>">
         </div>
          <div class="form-group">
          <input type="text" class="form-control" id="alternate_phone" name="alternate_phone" placeholder="Alternate phone(Optional)" value="<?php if(isset($alternate_phone)): echo $alternate_phone; endif;?>">
         </div>
         <div class="form-group">
          <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php if(isset($email)): echo $email; endif;?>">
         </div>
         <div class="form-group">
          <input type="text" class="form-control" id="laundry_quantity" name="laundry_quantity" placeholder="Laundry Quantity" value="<?php if(isset($laundry_quantity)): echo $laundry_quantity; endif;?>">
         </div>
         <div class="form-group">
          <textarea name="content" id="content" class="form-control" rows="5" placeholder="Message for Clarification" value="<?php if(isset($content)): echo $content; endif;?>"></textarea>
         </div>
        <div class="form-group" data-date-format="dd-mm-yyyy">
          <label>Pickup Date</label>
          <input type="date" class="form-control" id="pickup_date" name="pickup_date" placeholder="Pickup Date">
         </div>
          <div class="form-group" data-date-format="dd-mm-yyyy">
            <label>Delivery Date</label>
          <input type="date" class="form-control" id="delivery_date" name="delivery_date" placeholder="Delivery Date">
         </div>
         <div class="form-group">
          <br><button type="submit" value="Post" name="post" class="btn btn-success">Submit</button><br>
        </div>
        <?php if (isset($error_two)) {?>
        <h4 class="error"><?php echo $error_two; ?></h4>
    <br/><br/>
    <?php } ?>
      </form>














    
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



  

  