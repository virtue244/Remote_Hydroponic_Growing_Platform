
<div id="footer" >
   
  <div class="container" style="padding-top: 5%;">
    <hr>
    <div class="row">
      <div class="col-md-4">
        <?php foreach ($footerSections  as $footerSection ){?>
        <h3 style="color: #fff;"><strong><?php echo $footerSection['about_us_title']; ?></strong></h3>
        <p style="color: #fff;"><?php echo $footerSection['about_us_textual_content']; ?></p><br>
        <?php 
             if (!isset($_SESSION['username'])) {
  
            ?>
         



        <form method="post" class="login_form animated slideInUp" action="subscribe" >

    <!-- Display Validation Here -->
    <?php include_once('includes/subscribe_inc.php'); include_once('includes/errors.php'); ?><br>
    <label>Subscribe to our Newsletter</label>
         <div class="form-group">
          <input   style="float: left; position: absolute; width: 170px; border-top-right-radius: 0px; border-bottom-right-radius: 0px; " type="text" class="form-control" name="email" placeholder="Enter Your E-mail Here" value="<?php if(isset($email)): echo $email; endif;?>">
          <button type="submit" name="btn_subscribe" class="btn btn-success custom_btn"  style="float: right; position: absolute; margin-left: 170px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;  " title="Subscribe">Go</button>
         </div>
      </form><br>  


        <?php }?>

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
        <a target="_blank" href="<?php echo $footerSection['first_social_media_link']; ?>" title="Visit Our <?php echo ucfirst($footerSection['first_social_media_icon']); ?> Page" class="fa"><i class="fa fa-<?php echo $footerSection['first_social_media_icon']; ?>"></i></a>

        <a target="_blank" href="<?php echo $footerSection['second_social_media_link']; ?>" title="Visit Our <?php echo ucfirst($footerSection['second_social_media_icon']); ?> Page" class="fa"><i class="fa fa-<?php echo $footerSection['second_social_media_icon']; ?>"></i></a>

        <a href="contact" class="fa" title="Send us a Message"><i class="fa fa-envelope"></i></a>

</center><?php }?>
      </div>
    </div>
    </br></br></br>
<center><div class="copyrightText" style="color: #fff; border: 1px solid #fff; border-radius: 20px; background-color: #000; padding: 10px;"><center> Copyright © <?php
// if both years are the same, display only the current year ,
// if they are different display both with a dash between them
$startYear = 2018;
$thisYear = date("Y");
if ($startYear == $thisYear) {
echo $startYear;
} else {
echo "<strong>".$startYear."<strong> ~ </strong>".$thisYear."</strong>";
}
?>  All rights reserved.</center></div></center></br></br></br>
  </div>
</div>


<!--AJAX Script for pickup schedules-->
<?php include_once('includes/ajax_script.php'); ?>


</body>
</html>