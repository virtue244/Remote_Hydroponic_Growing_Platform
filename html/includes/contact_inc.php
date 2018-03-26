<?php

// REGISTER USER
if (isset($_POST['btn_message'])) {
  // receive all input values from the form
  $full_name = $_POST['full_name'];
  $address = $_POST['address'];
  $mobile_phone = $_POST['mobile_phone'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $message_title = $_POST['message_title'];

  // form validation: ensure that the form is correctly filled ...
if (empty($full_name)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>Username Required!</strong></div>");
}else{
  if (empty($mobile_phone)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>Phone Number Required!</strong></div>");
}else{
  if (empty($message)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>Please Type in Your Message!</strong></div>");
}else{
  if (count($errors) == 0) {

      $stmt=$db_conn->prepare("INSERT INTO contact( full_name, address, mobile_phone, email, message, message_title, timestamp) VALUES (:myUsername, :myAddress, :myPhone, :myEmail, :myMessage, :myMessageTitle, :myTime)");
      $stmt->bindParam(':myUsername', $full_name);
      $stmt->bindParam(':myAddress', $address);
      $stmt->bindParam(':myPhone', $mobile_phone);
      $stmt->bindParam(':myEmail', $email);
      $stmt->bindParam(':myMessage', $message);
      $stmt->bindParam(':myMessageTitle', $message_title);
      $stmt->bindValue(':myTime', time());
  if($stmt->execute())
    {
      ?>
      <script type="text/javascript">
        alert('Message Sent Successfully!');
        window.location.href="contact.php";
      </script>
      <?php
    }
    }
}
}
}
 
}

// ... 
