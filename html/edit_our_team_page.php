<?php

include_once('db_conn/config.php');

session_start();


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

  <script type="text/javascript">
  $(window).load(function(){
    $(".loader").fadeOut("slow");
});

</script>
</head>

<body>

<div class="loader"></div>
<?php 
include_once('db_conn/config.php');


      if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) 
      {
        $id = $_GET['edit_id'];
        $stmt_edit = $db_conn->prepare("SELECT * FROM team WHERE id=:uid");
        $stmt_edit->execute(array(':uid'=>$id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
      }else{
        header("Location: our_team_for_edit.php");
      }



     if(isset($_POST['btn_our_team_image']) && isset($_FILES['image']) && !empty($_FILES['image']['name']))  {

          $editedBy = $_POST['last_time_edited_by'];

          $images=$_FILES['image']['name'];
          $tmp_dir=$_FILES['image']['tmp_name'];
          $imageSize=$_FILES['image']['size'];

          $upload_dir='uploads/';
          $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
          $valid_extensions=array('jpeg','jpg','png','gif', 'pdf' );
          $image=rand(1000, 1000000).".".$imgExt;
          unlink($upload_dir.$edit_row['image']);
          move_uploaded_file($tmp_dir, $upload_dir.$image);

    $stmtImg = $db_conn->prepare("UPDATE  team SET last_time_edited_by = :editedBy,  image = :myImage, timestamp = :myTime WHERE id = :uid ORDER BY   id  ASC");
    $stmtImg->bindParam(':myImage', $image);
    $stmtImg->bindParam(':uid', $id);
    $stmtImg->bindParam(':editedBy', $editedBy);
    $stmtImg->bindParam(':myTime', time());

        if($stmtImg->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Image Successfully Updated!');
        window.location.href="our_team_for_edit.php";
      </script>
      <?php
    }
  }









    if (isset($_POST['btn_our_team'])) 
      {
        $frst_name = $_POST['first_name'];
        $lstName = $_POST['last_name'];
        $pos = $_POST['position'];
        $frstLink = $_POST['first_social_media_link'];
        $secLink = $_POST['second_social_media_link'];
        $frstIcon = $_POST['first_social_media_icon'];
        $secIcon = $_POST['second_social_media_icon'];
        $editedBy = $_POST['last_time_edited_by'];




     if(isset($_POST['btn_our_team'])){
    $stmt = $db_conn->prepare("UPDATE team SET first_name = :myFrstName, last_name = :myLstName, position = :myPos, first_social_media_link = :myFrstLink, second_social_media_link = :mySecLink, first_social_media_icon = :myFrstIcon, second_social_media_icon = :mySecIcon, last_time_edited_by = :editedBy, timestamp = :myTime WHERE id = :uid ORDER BY   id  ASC");
    $stmt->bindParam(':myFrstName', $frst_name);
    $stmt->bindParam(':myLstName', $lstName);
    $stmt->bindParam(':myPos', $pos);
    $stmt->bindParam(':myFrstLink', $frstLink);
    $stmt->bindParam(':mySecLink', $secLink);
    $stmt->bindParam(':myFrstIcon', $frstIcon);
    $stmt->bindParam(':mySecIcon', $secIcon);
    $stmt->bindParam(':editedBy', $editedBy);
    $stmt->bindParam(':myTime', time());
    $stmt->bindParam(':uid', $id);

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Content Successfully Updated!');
        window.location.href="our_team_for_edit.php";
      </script>
      <?php
    }
    }
  }
  

//DELETE EMPLOYEE


//../DELETE EMPLOYEE


      if (isset($_POST['btn_cancel'])) 
      {
        ?>
      <script type="text/javascript">
        alert('No changes made!');
        window.location.href="our_team_for_edit.php";
      </script>
      <?php
      }



        ?>

<div class="container">
        <h1 class="text-center">EDIT THIS SECTION </h1>
  <form method="post" class="home_page_edit_form" autocomplete="off" enctype="multipart/form-data">
    <p><em>Last Time Edited: <strong><?php echo date('F jS, Y', $timestamp); ?></strong> by <strong><?php echo ucfirst($last_time_edited_by); ?></strong></em></p><br>
<h5 class="text-center" style="color: #000;">(<em>Recommended image size is (60px) x (60px) dimmensions)</h5>

         <div class="form-group">
            <label style="float: left !important;">Edit Image:</label>
                      
<div class="col-md-3"><br><img src="uploads/<?php echo $image; ?>" style="float: left; position: relative; margin-bottom: 40px; width: 60px; height: 60px; float: left;" class="img-responsive"><br></div>
<input style=" float: left; position: relative; margin-bottom: 10px;" type="file"  name="image" accept="*/image" class="form-control" value="<?php echo $image; ?>" width="200" >
<div class="form-group">
  <button type="submit"   id="btn_update_item" class="btn btn-success" name="btn_our_team_image" style="float: left; " title="UPDATE IMAGE"><span  class="glyphicon glyphicon-picture " ></span></button>
</div>
         </div>
         <div class="form-group">
          <label style="float: left !important; background-color: lightgrey; border: 0px !important;" class="form-control">Edit First Name:</label>
          <input type="text" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
         </div>
         <div class="form-group">
          <label style="float: left !important;">Edit Last Name:</label>
          <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
         </div>
         <div class="form-group">
          <label style="float: left !important;">Edit Position:</label>
          <input type="text" name="position" class="form-control" value="<?php echo $position; ?>">
         </div>
         <div class="form-group">
          <label style="float: left !important;">Edit First Social Media Link:</label>
          <textarea rows="8" class="form-control" name="first_social_media_link"><?php echo $first_social_media_link; ?></textarea>
         </div>
         <div class="form-group">
          <label style="float: left !important;">Edit Second Social Media Link:</label>
          <textarea rows="8" class="form-control" name="second_social_media_link"><?php echo $second_social_media_link; ?></textarea>
         </div>
         <div class="form-group">
          <label style="float: left !important;">Add First Social Media Icon:</label>
          <select name="first_social_media_icon" class="form-control" >
            <option selected data-default><?php echo $first_social_media_icon; ?></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
         <div class="form-group">
            <label style="float: left !important;">Add Second Social Media Icon:</label>
            <select name="second_social_media_icon" class="form-control" >
            <option selected data-default><?php echo $second_social_media_icon; ?></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
          <div class="form-group">
          <input type="hidden" class="form-control" name="last_time_edited_by" value="<?php echo $_SESSION['username']; ?>">
         </div>
         <div class="form-group">
<button type=""   class="btn btn-close" name="btn_cancel" style="float: right; ">Cancel </button>
           <button type="submit"  id="btn_update_item" class="btn btn-success" name="btn_our_team" style="float: left; " title="UPDATE TEXTUAL CONTENT"><span  class="glyphicon glyphicon-send " ></span></button> 
           <a href="edit_our_team_page?edit_id=<?php echo $row['id']; ?>"><button type="submit"  id="btn_delete_item" class="btn btn-danger" name="btn_delete_employee" style="float: left; " title="DELETE ITEM"><span class="glyphicon glyphicon-remove " ></span></button> </a><br>


        </div>
      </form>
</div>


  