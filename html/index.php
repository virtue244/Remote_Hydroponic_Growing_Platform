<?php 
session_start();
include_once('includes/config.php');
  include_once('class_feed_now.php');
if(isset($_SESSION['logged_in'])){
  foreach ($db_conn->query("SELECT * FROM users") as $row);
  //Open index page for article editing
  //echo time();
//echo md5('dizle4shizle');

  $feed = new Feed;
$feeds = $feed->fetch_all();
?>
<!DOCTYPE html>
<html>
<head>
<title>CatFeeder | Dashboard</title>
  
  <!--For FACEBOOK SHARE-->
  <meta property="og:image" content="" />
  <link rel=”image_src” href=”../images/....png” />
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 
  <link href="boilerplate.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.css" rel="stylesheet">

<!--For Title Ico-->
<link rel="icon" type="icon" href="img/cat_icon.ico">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">

<link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>
<script src="http://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script src="../ajax/ajax.js"></script>
  
  
</head><!--HEAD ENDS HERE-->
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" style=" width:100%; background-color: #2f4f4f; color: white; position:relative;">
  <div class="container-fluid">
    <div class="navbar-header" style="height:7%;">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:#333333;">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar" >
        <ul class="nav navbar-nav">
        	 
        	 

          <li style="margin-top: 5%; margin-left: 5%;"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Hi <?php echo ucwords($row['username']); ?></li>
           
        </ul>
       <ul class="nav navbar-nav navbar-right">
      
         <li><a href="logout.php" Brush Script MT", cursive;">Logout</a></li>

        </ul>
      </div>
    </div>
  </div>
</nav>

<br><br>
<div class="container" ><!-- Container for all content begins here! -->

<div class="row">
    <div class="col-md-8">
    <div class="well main_well">
      <center> <p class="titles" style="text-align:center;
       font: 100 25px/1.3 'Helvetica', Helvetica, sans-serif;
      text-shadow: 4px 4px 0px rgba(0,0,0,0.1);
      color:#000; ">CURRENT TIME</p><hr></center>
<center>
      <div class="post-info" ><i class="glyphicon glyphicon-time"></i> <em><strong id="timer"></strong></em></div>
      
      <img src="img/cat.jpg" class="img-responsive">
      <div class="post-info" ><i class="glyphicon glyphicon-time"></i> <em><strong id="response"></strong></em></div>
    <br>
       <!-- FEED NOW form--> 
    <form id="testForm" method='post' action="index.php">
      <input id="feed_now" type='hidden' name='feed_now' value='1'>
        <button type="submit" class="btn btn-primary" name="btn-feed" title="Feed the Cat(s) Now">Feed Now</button></center>
      </form>
            
<!-- End FEED NOW form -->

</center>
    </div>
  
  </div>
    <div class="col-md-4">
  <div class="well">
<center><p class="titles"><span class="glyphicon glyphicon-calendar"></span> Feeding Schedule</p><hr>
  <table>
    <tr>
    <th class="table_title">Days</th>
    <th class="table_title">First Feeding</th>
    <th class="table_title">Second Feeding</th>
    <th class="table_title">Third Feeding</th>
  </tr>
  <?php 
    $stmt=$db_conn->prepare("SELECT * FROM schedule ORDER BY id DESC");
    $stmt->execute();
    if ($stmt->rowCount()>0)
     {
      while($row=$stmt->fetch(PDO::FETCH_ASSOC))
      {
        extract($row);
        ?>
  <tr class="table_content">
    <th class="padding"> <?php echo $days ?><br><a class="btn btn-info edit_btn" href="edit_form.php?edit_id=<?php echo $row['id']?>" title="Edit <?php echo $days ?> Schedules" onclick="return confirm('Are You Sure You Want to Edit <?php echo $days ?> Schedules?')"><span class="glyphicon glyphicon-edit"></span></a></th>
    <th><?php echo $first_feeding ?></th>
    <th><?php echo $second_feeding ?></th>
    <th><?php echo $third_feeding ?></th>
  </tr>
<?php
      }
    }
    ?>
  </table>

</center>
</div>

  </div>
  

</div>
</div>



<?php  
}else
{
  //Display Login Page
  if (isset($_POST['username'], $_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if (empty($username) or empty($password)){
      $error = '<br><br>All fields are required!';
    }else
    {
      $query=$db_conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
      $query->bindValue(1, $username);
      $query->bindValue(2, $password);
      $query->execute();
      $num = $query->rowCount();
      if ($num == 1)
      {
        //user entered correct details
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit(); 
      }else
      {
        //user entered wrong details
        $error = '<br><br>Incorrect details!';
      }
    }
  }
?>
<!DOCTYPE html >
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CATFEEDER | Login</title>
  <link rel="icon" type="icon" href="img/cat_icon.ico">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container"><center>
    <div class="login_header">
      <h2 align="center">Admin Only</h2>
       <h3 align="center">Please Sign In To Feed The Cat(s)</h3>
    </div>
    <form method="post" class="login_form" action="index.php" autocomplete="off">
    <!-- Display Validation Here -->
<?php if (isset($error)) {?>
        <h4 class="error"><?php echo $error; ?></h4>
    <br/><br/>
<?php } ?>
          <div class="input-group">
          <label>Username</label>
          <input type="text" name="username" placeholder="Enter Username">
         </div>
         <div class=" input-group">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter Password">
         </div>
         <div class=" input-group">
          <button type="submit" value="Login" name="login" class="login_btn"><a href="">Login</a></button>
        </div>
      </form>
      </center>
  </div>
  
</body>
</html>
<?php  
}
?>



<!-- Bootstrap Core Javascript-->

  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <script>
setInterval(function() {
    var currentTime = new Date ( );    
    var currentHours = currentTime.getHours ( );   
    var currentMinutes = currentTime.getMinutes ( );   
    var currentSeconds = currentTime.getSeconds ( );
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;   
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;    
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";    
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;    
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;    
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
    document.getElementById("timer").innerHTML = currentTimeString;
}, 1000);

</script>
</body>
</html>