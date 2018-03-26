  <!--- Start Online Visitor-->
<?php

//Get IP ADDRESS
$ip = $_SERVER['REMOTE_ADDR'];
//Check if this ip exist
$sql="SELECT ip FROM visitors WHERE ip='$ip'";
$Check=$db_conn->prepare($sql);
$Check->execute();

$number=$db_conn->prepare("SELECT ip FROM visitors");
$number->execute();
$visitor=$number->rowCount();


$CheckIp=$Check->rowCount();
if ($CheckIp==0){

  $query="INSERT INTO visitors(id,ip) VALUES(NULL, '$ip')";
  $insertIp=$db_conn->prepare($query);
  $insertIp->execute();
}

 ?>
<!--- End Online Visitor-->