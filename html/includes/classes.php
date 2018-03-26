<?php

class FooterSection{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT about_us_title, about_us_textual_content, contact_us, position_name, company_name, physical_address, street, city, country, mobile_phone, email, connect_title, first_social_media_link, second_social_media_link, first_social_media_icon, second_social_media_icon, last_time_edited_by, timestamp FROM footer ");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
}
?>

<?php

//UPDATING SECTION five

  if(isset($_POST['btn_section_five']))
  {
     $textual = $_POST['about_us_textual_content'];
     $posName = $_POST['position_name'];
     $compName = $_POST['company_name'];
     $phyAddr = $_POST['physical_address'];
     $StreetAdd = $_POST['street'];
     $cityAdd = $_POST['city'];
     $countryAdd = $_POST['country'];
     $phoneNum = $_POST['mobile_phone'];
     $emailAdd = $_POST['email'];
     $frstSocLink = $_POST['first_social_media_link'];
     $SecSocLink = $_POST['second_social_media_link'];
     $frstSocIcon = $_POST['first_social_media_icon'];
     $secSocIcon = $_POST['second_social_media_icon'];
     $editedBy = $_POST['last_time_edited_by'];

    $stmt = $db_conn->prepare("UPDATE footer SET about_us_textual_content = :myTContent, position_name = :myPosName, company_name = :myCompName, physical_address = :myPhyAddr, street = :myStreet, city = :myCity, country = :myCountry, mobile_phone = :myPhone, email = :myEmail, first_social_media_link = :myfrstsoclink, second_social_media_link = :mySecSocLink, first_social_media_icon = :myFrstSocIcon, second_social_media_icon = :mySecSocIcon, last_time_edited_by = :editedBy, timestamp = :myTime ");

    $stmt->bindParam(':myTContent', $textual);
    $stmt->bindParam(':myPosName', $posName);
    $stmt->bindParam(':myCompName', $compName);
    $stmt->bindParam(':myPhyAddr', $phyAddr);
    $stmt->bindParam(':myStreet', $StreetAdd);
    $stmt->bindParam(':myCity', $cityAdd);
    $stmt->bindParam(':myCountry', $countryAdd);
    $stmt->bindParam(':myPhone', $phoneNum);
    $stmt->bindParam(':myEmail', $emailAdd);
    $stmt->bindParam(':myfrstsoclink', $frstSocLink);
    $stmt->bindParam(':mySecSocLink', $SecSocLink);
    $stmt->bindParam(':myFrstSocIcon', $frstSocIcon);
    $stmt->bindParam(':mySecSocIcon', $secSocIcon);
    $stmt->bindParam(':editedBy', $editedBy);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }else{
            ?>
      <script type="text/javascript">
        alert('There was an Error Updating the Section, Please Try Again!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }

//END UPDATING SECTION five

?>


<?php

class PickupScheduleSection{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT title, image, textual_content, button_text, last_time_edited_by, timestamp FROM pickup_schedule_section ");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
}


?>




<?php

class Slider{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM slider  ORDER BY id ASC");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
}
?>


<?php

class Users{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM users  ORDER BY id ASC");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
}
?>




<?php

class NavLinking{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM header_links ");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
}


?>


<?php

class Services{
public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM services ORDER BY id ASC ");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }

}


?>


<?php

class PricesList{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM price_list ORDER BY id ASC ");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_prices($service_id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM price_list WHERE service_title = ?");
    $stmt->bindValue(1, $service_id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}


?>



<?php

class OurTeam{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM team ORDER BY id ASC");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM team WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}


?>


<?php

class ContentOurTeam{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM content ORDER BY id ASC");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM content WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}


?>



<?php

class OurBranches{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM branches ORDER BY timestamp DESC");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM branches WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}


?>



<?php
class OurTeamEdit{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT textual_content FROM content WHERE id = 1");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM content WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}


?>


<?php

//UPDATING OUR TEAM TEXTUAL

  if(isset($_POST['btn_our_team_edit']))
  {
    $textual = $_POST['textual_content'];

    $stmt = $db_conn->prepare("UPDATE content SET textual_content = :myText, timestamp = :myTime WHERE id = 1");
    $stmt->bindParam(':myText', $textual);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Successfully Updated!');
        window.location.href="our_team_for_edit.php";
      </script>
      <?php
    }else{
            ?>
      <script type="text/javascript">
        alert('There was an Error Updating the Section, Please Try Again!');
        window.location.href="our_team_for_edit.php";
      </script>
      <?php
    }
  }

//END UPDATING OUR TEAM TEXTUAL

?>


<?php

class BlogPost{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM blog_content ORDER BY timestamp DESC LIMIT 2");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_post($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM blog_content WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }


}


?>

<?php

class BlogPostRecentSection{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM blog_content  ORDER BY timestamp DESC LIMIT 10");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM blog_content WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}

?>
<?php


//BlogPostMostRead SECTION

class BlogPostMostRead{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM blog_content ORDER BY timestamp DESC LIMIT 1");
  $stmt->execute();
  
  return $stmt->fetchAll();
  }
  
    public function fetch_data($id){
    global $db_conn;
    
    $stmt = $db_conn->prepare("SELECT * FROM blog_content WHERE id = ?");
    $stmt->bindValue(1, $id);
    $stmt->execute();
    
    return $stmt->fetch();
  }
}
//BlogPostMostRead SECTION

?>


<?php

//UPDATING SECTION one

  if(isset($_POST['btn_section_one']))
  {
    $phone = $_POST['contact_mobile_phone'];
    $editedBy = $_POST['last_time_edited_by'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf');
  $logo=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$logo);
if(isset($_FILES['image']) && !empty($_FILES['image']['name']))  {
    $stmtImg = $db_conn->prepare("UPDATE header_links SET  contact_mobile_phone = :myPhone, last_time_edited_by = :editedBy, image = :myLogo, timestamp = :myTime ");
    $stmtImg->bindParam(':myPhone', $phone);
    $stmtImg->bindParam(':editedBy', $editedBy);
    $stmtImg->bindParam(':myLogo', $logo);
    $stmtImg->bindParam(':myTime', time());

    if($stmtImg->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Image and title(s) successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }else{
    $stmt = $db_conn->prepare("UPDATE header_links SET contact_mobile_phone = :myPhone, last_time_edited_by = :editedBy, timestamp = :myTime");
    $stmt->bindParam(':myPhone', $phone);
    $stmt->bindParam(':editedBy', $editedBy);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Phone number updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
    }
  }

//END UPDATING SECTION one

?>

<?php

//UPDATING SECTION two

  if(isset($_POST['btn_section_two']))
  {
    $t_one = $_POST['title_one'];
    $t_two = $_POST['title_two'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $slider_image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$slider_image);
     if(isset($_FILES['image']) && !empty($_FILES['image']['name']))  {
    $stmtImg = $db_conn->prepare("UPDATE sliders SET title_one = :myTone, title_two = :myTtwo, image = :myImage, timestamp = :myTime ORDER BY   indicators_id  ASC");
    $stmtImg->bindParam(':myTone', $t_one);
    $stmtImg->bindParam(':myTtwo', $t_two);
    $stmtImg->bindParam(':myImage', $slider_image);
    $stmtImg->bindParam(':myTime', time());

    if($stmtImg->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Image and title(s) successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }else{
    $stmt = $db_conn->prepare("UPDATE sliders SET title_one = :myTone, title_two = :myTtwo, timestamp = :myTime ORDER BY   indicators_id  ASC");
    $stmt->bindParam(':myTone', $t_one);
    $stmt->bindParam(':myTtwo', $t_two);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Title(s) updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
    }
  }

//END UPDATING SECTION two

?>

<?php


//UPDATING SECTION three

  if(isset($_POST['btn_section_three']))
  {
    $text = $_POST['textual_content'];
    $editedBy = $_POST['last_time_edited_by'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $content_image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$content_image);


      if(isset($_FILES['image']) && !empty($_FILES['image']['name']))  {
     $stmtimg = $db_conn->prepare("UPDATE pickup_schedule_section SET textual_content = :myContent, last_time_edited_by = :editedBy, image = :myImage, timestamp = :myTime ");
    $stmtimg->bindParam(':myContent', $text);
    $stmtimg->bindParam(':editedBy', $editedBy);
    $stmtimg->bindParam(':myImage', $content_image);
    $stmtimg->bindParam(':myTime', time());

    if($stmtimg->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Title and textual content successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }else{
     $stmt = $db_conn->prepare("UPDATE pickup_schedule_section SET textual_content = :myContent, last_time_edited_by = :editedBy, timestamp = :myTime ");
    $stmt->bindParam(':myContent', $text);
    $stmt->bindParam(':editedBy', $editedBy);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Only title Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }
  }

?>

<?php

//END UPDATING SECTION three


  //UPDATING SERVICE SECTION one

  if(isset($_POST['btn_section_four']))
  {
    $text = $_POST['title'];
    $content = $_POST['textual_content'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $content_image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$content_image);


      if(isset($_FILES['image']) && !empty($_FILES['image']['name']))  {
     $stmtimg = $db_conn->prepare("UPDATE services SET title = :myTitle, textual_content = :myContent, image = :myImage, timestamp = :myTime ");
    $stmtimg->bindParam(':myTitle', $text);
    $stmtimg->bindParam(':myContent', $content);
    $stmtimg->bindParam(':myImage', $content_image);
    $stmtimg->bindParam(':myTime', time());

    if($stmtimg->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Title and textual content successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }else{
     $stmt = $db_conn->prepare("UPDATE services SET title = :myTitle, textual_content = :myContent, timestamp = :myTime WHERE id = $id ");
    $stmt->bindParam(':myTitle', $text);
    $stmt->bindParam(':myContent', $content);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Only title Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }
  }
//END UPDATING SERVICE SECTION one


?>


<?php
//PHP COdes for ADD EMPLOYEES table only
if (isset($_POST['btn_add_employee']))
 {

    $frst_name = $_POST['first_name'];
    $lstName = $_POST['last_name'];
    $pos = $_POST['position'];
    $frstLink = $_POST['first_social_media_link'];
    $secLink = $_POST['second_social_media_link'];
    $frstIcon = $_POST['first_social_media_icon'];
    $secIcon = $_POST['second_social_media_icon'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='../uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$image);
  $stmt=$db_conn->prepare("INSERT INTO team( first_name, last_name, position, first_social_media_link, second_social_media_link, first_social_media_icon, second_social_media_icon, image, timestamp) VALUES (:myFrstName, :myLstName, :myPos, :myFrstLink, :mySecLink, :myFrstIcon, :mySecIcon,  :myImage, :myTime)");
    $stmt->bindParam(':myFrstName', $frst_name);
    $stmt->bindParam(':myLstName', $lstName);
    $stmt->bindParam(':myPos', $pos);
    $stmt->bindParam(':myFrstLink', $frstLink);
    $stmt->bindParam(':mySecLink', $secLink);
    $stmt->bindParam(':myFrstIcon', $frstIcon);
    $stmt->bindParam(':mySecIcon', $secIcon);
    $stmt->bindParam(':myImage', $image);
    $stmt->bindValue(':myTime', time());
  if ($stmt->execute())
   {
    ?>
    <script>
      alert("New Record Added");
      window.location.href=('index.php');
    </script>

    <?php
  }else
  {
      ?>
    <script>
      alert("Error");
      window.location.href=('index.php');
    </script>

    <?php
  }

  }

  
// END PHP COdes for ADD EMPLOYEES table only
?>






<?php
//PHP COdes for ADD BRANCHES table only
if (isset($_POST['btn_add_branch']))
 {

    $loc_name = $_POST['location_name'];
    $txt_content = $_POST['textual_content'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='../uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$image);
  $stmt=$db_conn->prepare("INSERT INTO branches( location_name, textual_content,  image, timestamp) VALUES (:myLocName, :myTxtContent, :myImage, :myTime)");
    $stmt->bindParam(':myLocName', $loc_name);
    $stmt->bindParam(':myTxtContent', $txt_content);
    $stmt->bindParam(':myImage', $image);
    $stmt->bindValue(':myTime', time());
  if ($stmt->execute())
   {
    ?>
    <script>
      alert("New Record Added");
      window.location.href=('index.php');
    </script>

    <?php
  }else
  {
      ?>
    <script>
      alert("Error");
      window.location.href=('index.php');
    </script>

    <?php
  }

  }

  
// END PHP COdes for ADD BRANCHES table only
?>


<?php
//PHP COdes for ADD SERVICES table only
if (isset($_POST['btn_add_service']))
 {

    $title = $_POST['title'];
    $txt_content = $_POST['textual_content'];

  $images=$_FILES['image']['name'];
  $tmp_dir=$_FILES['image']['tmp_name'];
  $imageSize=$_FILES['image']['size'];

  $upload_dir='../uploads/';
  $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
  $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
  $image=rand(1000, 1000000).".".$imgExt;
  move_uploaded_file($tmp_dir, $upload_dir.$image);
  $stmt=$db_conn->prepare("INSERT INTO services( title, textual_content,  image, timestamp) VALUES (:myTitle, :myTxtContent, :myImage, :myTime)");
    $stmt->bindParam(':myTitle', $title);
    $stmt->bindParam(':myTxtContent', $txt_content);
    $stmt->bindParam(':myImage', $image);
    $stmt->bindValue(':myTime', time());
  if ($stmt->execute())
   {
    ?>
    <script>
      alert("New Record Added");
      window.location.href=('index.php');
    </script>

    <?php
  }else
  {
      ?>
    <script>
      alert("Error");
      window.location.href=('index.php');
    </script>

    <?php
  }

  }

  
// END PHP COdes for ADD SERVICES table only
?>



<?php
//PHP COdes for ADD Service Items Prices table only
if (isset($_POST['btn_service_prices']))
 {
    $title = $_POST['service_title'];
    $item = $_POST['item'];
    $price = $_POST['price'];
    $item_title = "Item";
    $price_title = "Price";

   if (!empty($_POST['service_title']) && !empty($_POST['item']) && !empty($_POST['price'])) {

  $stmt=$db_conn->prepare("INSERT INTO price_list( service_title, item,  price, item_title, price_title, timestamp) VALUES (:myTitle, :myItem, :myPrice, :myItemTitle, :myPriceTitle, :myTime)");
    $stmt->bindParam(':myTitle', $title);
    $stmt->bindParam(':myItem', $item);
    $stmt->bindParam(':myPrice', $price);
    $stmt->bindParam(':myItemTitle', $item_title);
    $stmt->bindParam(':myPriceTitle', $price_title);
    $stmt->bindValue(':myTime', time());
  if ($stmt->execute())
   {
    ?>
    <script>
      alert("New Record Added");
      window.location.href=('index.php');
    </script>

    <?php
  }
   }else
  {
      ?>
    <script>
      alert("All Fields Are Required!");
    </script>

    <?php
  }

  }

  
// END PHP COdes for ADD Service Items Prices table only
?>