<?php

class Feed{
  public function fetch_all()
  {
  global $db_conn;
  
  $stmt=$db_conn->prepare("SELECT * FROM feed_now_table ORDER BY feed_time DESC LIMIT 1");
  $stmt->execute();
  return $stmt->fetchAll();

  }


}
?>

<?php
include_once('includes/config.php');
//PHP COdes for blog table only
if (isset($_POST['btn-feed']))                 
 {
  
  $feed_now = $_POST['feed_now'];

  
  $inserts = $db_conn->prepare("INSERT INTO feed_now_table (feed_now, feed_time) VALUES(:feed_now, :myTime)");
  $inserts->bindParam( ':feed_now', $feed_now);
  $inserts->bindParam(':myTime', time());

  if ($inserts->execute())
   {
    ?>
    <script>
      alert("You successfully fed the cat(s)!");
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
// END PHP COdes for blog table only
?>
