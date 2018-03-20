
<?php
 session_start();
include_once('includes/config.php');
if(isset($_SESSION['logged_in'])){




?>
<!DOCTYPE html>

<html lang="en">
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
</head>
<style>
	.edit-form img{
		width: 150px;
		

	}
</style>

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
           
        </ul>
       <ul class="nav navbar-nav navbar-right">
      
         <li><a href="index.php" Brush Script MT", cursive;"><span class="glyphicon glyphicon-home"></span> Home</a></li>

        </ul>
      </div>
    </div>
  </div>
</nav>
<?php
		
		if (isset($_GET['edit_id']) && !empty($_GET['edit_id'])) 
		{
			$id=$_GET['edit_id'];
			$stmt_edit=$db_conn->prepare("SELECT * FROM schedule WHERE id=:schedule_id");
			$stmt_edit->execute(array(':schedule_id'=>$id));
			$edit_row=$stmt_edit->fetch(PDO::FETCH_ASSOC);
			extract($edit_row);	

		}else
		{
			header("location: index.php");
		}
		if (isset($_POST['btn-save'])) 
		{
			$first_feeding=$_POST['first_feeding'];
			$second_feeding=$_POST['second_feeding'];
			$third_feeding=$_POST['third_feeding'];
			$stmt=$db_conn->prepare("UPDATE schedule SET first_feeding=:first_feeding, second_feeding=:second_feeding, third_feeding=:third_feeding WHERE id=:schedule_id");
			$stmt->bindParam(':first_feeding', $first_feeding);
			$stmt->bindParam(':second_feeding', $second_feeding);
			$stmt->bindParam(':third_feeding', $third_feeding);
			$stmt->bindParam(':schedule_id', $id);
			if($stmt->execute())
			{
				?>
				<script type="text/javascript">
					alert('Updated Successfuly!');
					window.location.href="index.php";
				</script>
				<?php
			}else
			{
				?>
				<script type="text/javascript">
					alert('There was an Error!');
					window.location.href="index.php";
				</script>
				<?php
			}
		}

?>
<div class="container" ><!-- Container for all content begins here! -->
<!-- Form to insert data into database-->
  <div class="col-md-12">
  <div class="well">
<center><p class="titles"><span class="glyphicon glyphicon-calendar"></span> Edit <?php echo $days ?> Feeding Schedule</p><hr>
	<form method="post" enctype="multipart/form-data">
  <table>
    <tr>
    <th class="table_title">Days</th>
    <th class="table_title">First Feeding</th>
    <th class="table_title">Second Feeding</th>
    <th class="table_title">Third Feeding</th>
  </tr>
  <tr class="table_content">
    <th><?php echo $days; ?></th>
    <th><select name="first_feeding" class="form-control edit_feed"  required="">
            <option class="dropdown_active" value="" selected data-default><?php echo $first_feeding; ?></option>
            <option>08:00AM</option>
            <option>08:30AM</option>
            <option>09:00AM</option>
            <option>09:30AM</option>
            <option>10:00AM</option>
            <option>10:30AM</option>
            <option>11:00AM</option>
            <option>11:30AM</option>
          </select></th>
          <th><select name="second_feeding" class="form-control edit_feed"  required="">
            <option class="dropdown_active" value="" selected data-default><?php echo $second_feeding; ?></option>
            <option>12:00PM</option>
            <option>12:30PM</option>
            <option>01:00PM</option>
            <option>01:30PM</option>
            <option>02:00PM</option>
            <option>02:30PM</option>
            <option>03:00PM</option>
            <option>03:30PM</option>
            <option>04:00PM</option>
            <option>04:30PM</option>
            <option>05:00PM</option>
            <option>05:30PM</option>
          </select></th>
          <th><select name="third_feeding" class="form-control edit_feed"  required="">
            <option class="dropdown_active" value="" selected data-default><?php echo $third_feeding; ?></option>
            <option>06:00PM</option>
            <option>06:30PM</option>
            <option>07:00PM</option>
            <option>07:30PM</option>
            <option>08:00PM</option>
            <option>08:30PM</option>
            <option>09:00PM</option>
            <option>09:30PM</option>
            <option>10:00PM</option>
            <option>10:30PM</option>
            <option>11:00PM</option>
            <option>11:30PM</option>
          </select></th>
  </tr>
  </table>
  <button type="submit" name="btn-save">UPDATE</button>	
</form>

</center>
</div>

  </div>
<!-- End Form to insert data into database-->
</div><!-- END Container for all content begins here! -->

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
  <link rel="icon" type="icon" href="../img/cat_icon.ico">
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
</body>
</html>


  

  