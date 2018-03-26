<?php
include_once('includes/header.php');
//include_once('includes/price_list_inc.php');
?>
<div class="container"><!--First Container-->
    <div class="row"><!--First Row-->
    <div class="col-md-8 animated slideInUp">
    <div class="well" style="background-color: lightgrey;">
      

<?php foreach ($navLinkings as $navLinking){?>
          <h2><?php echo ucfirst($navLinking['price_list']); ?></h2>
           <?php }?>
          
<center>
  <?php foreach ($price_lists as $price_list){?> 
<div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title"><?php echo ucfirst($price_list['service_title']); ?></h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover">
            <tr>
              <th><?php echo ucfirst($price_list['item_title']); ?></th>
              <th><?php echo ucfirst($price_list['price_title']); ?></th>
            </tr>
            <tr>
              <th><?php echo ucfirst($price_list['item']); ?></th>
              <th>TZS <?php echo ucfirst($price_list['price']); ?>/=</th>
            </tr>
          </table>
        </div>
      </div>
      <?php }?>
    
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



  

  