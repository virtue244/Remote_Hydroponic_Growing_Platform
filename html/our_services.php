<?php
include_once('includes/header.php');
?>

<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
    <div class="col-md-8 animated slideInUp">
    <div class="well">
      <center>
       <?php 

       $service = new Services;
$services = $service->fetch_all();


       if (isset($_GET['id'])){
  //display service
  $get_id = $_GET['id'];
  $services_data = $service->fetch_services($get_id);?>

          <h2><?php echo ucfirst($services_data['title']); ?></h2><br>
           <img src="uploads/<?php echo $services_data['image']; ?>" class="img-responsive"> </center>   <br>
           <p><?php echo $services_data['textual_content']; ?></p>
    
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
  }else
  {
  header('Location: index.php');
  exit();
}



include_once('includes/footer.php');
?>
