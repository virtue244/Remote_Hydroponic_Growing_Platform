<?php
//Delete Services
  if (isset($_GET['btn_delete'])) {
    $del_img = $_GET['btn_delete'];//to delete img folder
    $id = $_GET['btn_delete'];//to delete from database

    if($del_img != "") {
        $stmt = $db_conn->prepare("SELECT * FROM services WHERE id='".$del_img."'");
        $stmt->execute();

       while ($del_img = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image = $del_img['image'];
            $image= ("../uploads/$image");
            unlink($image);
        }


    $stmt = $db_conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bindValue(1, $id);
    
    if ($stmt->execute()) 
      {
        ?>
      <script type="text/javascript">
        alert('Item Deleted!');
        window.location.href="index.php";
      </script>
      <?php
      }

  }
}
//END Delete Services




//Delete Services
  if (isset($_GET['btn_delete_employee'])) {
    $del_img = $_GET['btn_delete_employee'];//to delete img folder
    $id = $_GET['btn_delete_employee'];//to delete from database

    if($del_img != "") {
        $stmt = $db_conn->prepare("SELECT * FROM team WHERE id='".$del_img."'");
        $stmt->execute();

       while ($del_img = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image = $del_img['image'];
            $image= ("../uploads/$image");
            unlink($image);
        }


    $stmt = $db_conn->prepare("DELETE FROM team WHERE id = ?");
    $stmt->bindValue(1, $id);
    
    if ($stmt->execute()) 
      {
        ?>
      <script type="text/javascript">
        alert('Item Deleted!');
        window.location.href="index.php";
      </script>
      <?php
      }

  }
}
//END Delete Services




//Delete Services
  if (isset($_GET['btn_delete_branch'])) {
    $del_img = $_GET['btn_delete_branch'];//to delete img folder
    $id = $_GET['btn_delete_branch'];//to delete from database

    if($del_img != "") {
        $stmt = $db_conn->prepare("SELECT * FROM branches WHERE id='".$del_img."'");
        $stmt->execute();

       while ($del_img = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image = $del_img['image'];
            $image= ("../uploads/$image");
            unlink($image);
        }


    $stmt = $db_conn->prepare("DELETE FROM branches WHERE id = ?");
    $stmt->bindValue(1, $id);
    
    if ($stmt->execute()) 
      {
        ?>
      <script type="text/javascript">
        alert('Item Deleted!');
        window.location.href="index.php";
      </script>
      <?php
      }

  }
}
//END Delete Services



//CREATE FILE CODE
//$myfile = fopen("newfile.php", "w") 
//END CREATE FILE CODE