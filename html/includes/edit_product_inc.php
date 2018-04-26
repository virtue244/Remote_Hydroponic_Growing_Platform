<?php
session_start();
// UPDATE USER
if (isset($_POST['edit_product'])) {
  $user_rank = $_POST['user_rank'];
  $user_integer_value = $_POST['user_integer_value'];
  

  if (empty($user_rank) || empty($user_integer_value)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>All Fields Required!</strong></div>");
}else{
       $pattern = "/^[1-9][0-9]*$/";
    if(!preg_match($pattern, $user_integer_value))
    {
      array_push($errors,"<div class='login_validation_alert'><strong>Numbers can only be 1+ </strong></div>");
    }else{
      if (count($errors) == 0) {

      $verify = $db_conn->prepare("UPDATE users SET  user_rank = :myUserRank, user_integer_value = :myUseInt  WHERE username ='{$_SESSION['username']}'");
      $verify->bindParam(':myUserRank', $user_rank);
      $verify->bindParam(':myUseInt', $user_integer_value);
      if($verify->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Successfully Updated!');
        window.location.href="index.php";
      </script>
      <?php
    }else{
      ?>
      <script type="text/javascript">
        alert('There was an Error Updating the Section, Please Try Again!');
        window.location.href="edit_product.php";
      </script>
      <?php
    }
                     
  }
    }
}
}
//../UPDATE USER...