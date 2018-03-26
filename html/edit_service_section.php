<?php 
include_once('db_conn/config.php');

session_start();
 if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login?=You must log in first!');
  }


  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index");
  }
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
</head>

<body>


<?php 



      if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) 
      {
        $id = $_GET['edit_id'];
        $stmt_edit = $db_conn->prepare("SELECT * FROM services WHERE id=:uid");
        $stmt_edit->execute(array(':uid'=>$id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
      }else{
        header("Location: edit_home_page.php");
      }



     if (isset($_POST['btn_services_image']) && isset($_FILES['image']) && !empty($_FILES['image']['name']))  {

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

    $stmtImg = $db_conn->prepare("UPDATE services SET last_time_edited_by = :editedBy, image = :myImage, timestamp = :myTime WHERE id = :uid ORDER BY   id  ASC");
    $stmtImg->bindParam(':editedBy', $editedBy);
    $stmtImg->bindParam(':myImage', $image);
    $stmtImg->bindParam(':uid', $id);
    $stmtImg->bindParam(':myTime', time());

        if($stmtImg->execute())
    {
      ?>
      <script type="text/javascript">
       alert('Image Successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
  }





  if (isset($_POST['btn_service_content']))  {
        $title = $_POST['title'];
        $texContent = $_POST['textual_content'];
        $editedBy = $_POST['last_time_edited_by'];

    $stmt = $db_conn->prepare("UPDATE services SET title = :myTitle, textual_content = :myTexContent, last_time_edited_by = :editedBy, timestamp = :myTime WHERE id = :uid ORDER BY   id  ASC");
    $stmt->bindParam(':myTitle', $title);
    $stmt->bindParam(':myTexContent', $texContent);
    $stmt->bindParam(':editedBy', $editedBy);
    $stmt->bindParam(':uid', $id);
    $stmt->bindParam(':myTime', time());

    if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Content Successfully Updated!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
    }
    }
  



      if (isset($_POST['btn_cancel'])) 
      {
        ?>
      <script type="text/javascript">
        alert('No changes made!');
        window.location.href="edit_home_page.php";
      </script>
      <?php
      }



        ?>

<div class="container">
        <h1 class="text-center">EDIT THIS SECTION</h1>
        <p><em>Last Time Edited: <strong><?php echo date('F jS, Y', $timestamp); ?></strong> by <strong><?php echo ucfirst($last_time_edited_by); ?></strong></em></p>

      <form method="post" class="home_page_edit_form" autocomplete="off" enctype="multipart/form-data">
        <h5 class="text-center" style="color: #000;">(<em>Recommended image size is (400px) x (400px) dimmensions)</h5><br>
        <div class="form-group">
            <div class="col-md-3"><br><img src="uploads/<?php echo $image; ?>" style=" float: left; position: relative; margin-bottom: 40px;" class="img-responsive"><br></div>
          <input style=" float: left; position: relative; margin-bottom: 10px;" type="file"  name="image" accept="*/image" class="form-control value="<?php echo $image; ?>" width="200" >
         </div>
         <div class="form-group">
  <button type="submit"   id="btn_update_item" class="btn btn-success" name="btn_services_image" style="float: left; " title="UPDATE IMAGE"><span  class="glyphicon glyphicon-picture " ></span></button>
         </div> 
        <div class="form-group">
            <label style="float: left !important; background-color: lightgrey; border: 0px !important;" class="form-control">Edit Service Title: </label>
          <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
         </div>
         <div class="form-group">
          <input type="hidden" class="form-control" name="last_time_edited_by" value="<?php echo $_SESSION['username']; ?>">
         </div>
          <div class="form-group">
            <label style="float: left !important;">Edit Textual Content:</label>
          <textarea  class="form-control" rows="8" name="textual_content" ><?php echo $textual_content; ?></textarea>
         </div>
         <div class="form-group">
          <button type=""   class="btn btn-close" name="btn_cancel" style="float: right; ">Cancel </button>
          <button type="submit"  id="btn_update_item" class="btn btn-success" name="btn_service_content" style="float: left; " title="UPDATE ITEM"><span  class="glyphicon glyphicon-send " ></span></button>
 <a href="edit_our_team_page?edit_id=<?php echo $row['id']; ?>"><button type="submit"  id="btn_delete_item" class="btn btn-danger" name="btn_delete_employee" style="float: left; " title="DELETE ITEM"><span class="glyphicon glyphicon-remove " ></span></button> </a><br>
        </div>
      </form>
</div>
