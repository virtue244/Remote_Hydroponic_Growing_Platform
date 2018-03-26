<?php
//fetch.php;
if(isset($_POST["view"]))
{
 include("../db_conn/connect.php");
 if($_POST["view"] != '')
 {
  $update_query = "UPDATE pickup_schedule SET status=1 WHERE status=0";
  mysqli_query($connect, $update_query);
 }
 $query = "SELECT * FROM pickup_schedule ORDER BY id DESC LIMIT 5";
 $result = mysqli_query($connect, $query);
 $output = '';
 
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
   <li style="padding: 10px;">
    <a href="#">
     <strong style="color: darkgrey;">From: '.$row["full_name"].'</strong><br />
     <strong>'.nl2br($row["message_title"]).'</strong><br />
     <small><em>'.$row["message"].'</em></small>
    </a>
   </li>
   <li class="divider"></li>
   ';
  }
 }
 else
 {
  $output .= '<li style="padding: 10px; color: darkgrey;><a href="#" class="text-bold text-italic"> <strong >Inbox:</strong> No Messages!</a></li>';
 }
 
 $query_1 = "SELECT * FROM pickup_schedule WHERE status=0";
 $result_1 = mysqli_query($connect, $query_1);
 $count = mysqli_num_rows($result_1);
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
}

//Fetch data
if(isset($_POST["subject"]))
{
 include_once("../db_conn/connect.php");
 $subject = mysqli_real_escape_string($connect, $_POST["subject"]);
 $full_name = mysqli_real_escape_string($connect, $_POST["full_name"]);
 $street = mysqli_real_escape_string($connect, $_POST["street"]);
 $district = mysqli_real_escape_string($connect, $_POST["district"]);
 $content = mysqli_real_escape_string($connect, $_POST["content"]);
 $mobile_phone = mysqli_real_escape_string($connect, $_POST["mobile_phone"]);
 $alternate_phone = mysqli_real_escape_string($connect, $_POST["alternate_phone"]);
 $email = mysqli_real_escape_string($connect, $_POST["email"]);
 $laundry_quantity = mysqli_real_escape_string($connect, $_POST["laundry_quantity"]);
 $pickup_date = mysqli_real_escape_string($connect, $_POST["pickup_date"]);
 $delivery_date = mysqli_real_escape_string($connect, $_POST["delivery_date"]);
 $query = "INSERT INTO pickup_schedule(full_name, street, district, mobile_phone, alternate_phone, email, laundry_quantity, pickup_date, delivery_date, message_title, message) VALUES ('$full_name', '$street', '$district', '$mobile_phone', '$alternate_phone', '$email', '$laundry_quantity', '$pickup_date', '$delivery_date', '$subject', '$content')";
 mysqli_query($connect, $query);
}
?>


