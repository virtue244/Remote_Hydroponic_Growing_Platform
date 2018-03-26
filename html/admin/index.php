<?php 
session_start();
include_once('../db_conn/config.php');
 /**if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login?=You must log in first!');
  }**/

  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
 if($row['user_type'] == 'admin') {
    
  }else{
    header('location: ../index?=Welcome '.$_SESSION['username'].'!');
  }

include_once('../includes/classes.php');
include_once('../includes/delete_items.php');

$user = new Users;
$users = $user->fetch_all();

//Total # of subscribers
$sql = "SELECT COUNT(*)  FROM subscribers"; 
$result = $db_conn->prepare($sql); 
$result->execute(); 
$number_of_subscriber = $result->fetchColumn(); 
//../Total # of subscribers

//Total # of admin
$user_type = "admin";
$sql = "SELECT COUNT(*)  FROM users WHERE user_type = '$user_type'"; 
$result = $db_conn->prepare($sql); 
$result->execute(); 
$number_of_admin = $result->fetchColumn(); 
//../Total # of admin


  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../index");
  }
?>


<!DOCTYPE html >
<html >
<head>
  <title>Admin | Dashboard</title>
  
  <!--For FACEBOOK SHARE-->
  <meta property="og:image" content="" />
  <link rel=”image_src” href=”../images/Thando_hopa.png” />
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 



<!--For Title Ico-->
<link rel="icon" type="icon" href="../images/icon.ico">
    <!-- Bootstrap -->
    
    <link rel="stylesheet" href="../tools/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Arizonia' rel='stylesheet' type='text/css'>

<!-- Javascript -->
<script src="../tools/ajax/ajax.js"></script>
  
  
</head><!--HEAD ENDS HERE-->
<body>
  <!--- Start Online Visitor-->
<?php
include_once('../includes/ip_address.php');
echo "<span style='color: brown; margin: 10px; cursor: pointer; font-size: 10;' title='Site Total Visitors' class='glyphicon glyphicon-user' aria-hidden='true'><span class='badge' style='background-color: brown;'>$visitor</span></span> ";
 ?>
<!--- End Online Visitor--><br>

<nav class="navbar navbar-inverse navbar-fixed-top" style=" width:100%; background-color: #008000; color: white; position:relative;">
  <div class="container-fluid">
    <div class="navbar-header" style="height:7%;">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:#008000;">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar" >
       <ul class="nav navbar-nav navbar-right">
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"> <strong style="color: #001; cursor: pointer;">Hi <?php echo ucfirst($_SESSION['username']); ?></strong> <span class="label label-pill label-danger count" style="border-radius:10px;"></span></a>
              <ul class="dropdown-menu"> 
 <li style="margin-top: 5%; margin-left: 5%;"> <span class="glyphicon glyphicon-user" aria-hidden="true"></span><!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      Hi <strong><?php echo ucfirst($_SESSION['username']); ?></strong>
<li><a href="../index.php?= Hi <?php echo $_SESSION['username'] ; ?>" style=" color:#fff; font-weight:bold; font-family: "Brush Script MT", cursive;">Home</a></li>
         <li><a href="../includes/logout.php?logout='1'" style=" color:#fff; font-weight:bold; font-family: "Brush Script MT", cursive;">Logout</a></li>
    <?php endif ?></li><br>

            </ul>
            </li>

        </ul>
      </div>
    </div>
  </div>
</nav>
<br><br>



<section id="breadcrumb">
  <div class="container">
    <ol class="breadcrumb">
      <center><li class="active"><span class="glyphicon glyphicon-cog" aria-hidden="true"> <strong>DASHBOARD PANEL</strong> </li></span></center>
      <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success">
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
    </ol>
  </div>
</section>

<section id="main">
  <div class="container">
  <div class="row">
    <div class="col-md-3 animated slideInUp">
<div class="list-group "><?php  if (isset($_SESSION['username'])) : ?>
 <center><p class="list-group-item" style="opacity: 1; padding-bottom: 40px; " ><img src="../uploads/default.png" class="user_image"><strong><br><?php echo ucfirst($_SESSION['username']); ?><br><br></strong> 
  <?php endif ?>
<?php  if (isset($_SESSION['username'])) : ?>
 <a href="../includes/logout.php?logout='1'" title="Logout"><span class="glyphicon glyphicon-off pull-left glyphicon_icons" aria-hidden="true" style="float: right; margin-left: 5%;"></span></a> 
 <?php endif ?>

 <a href="" type="button" data-toggle="modal" data-target="#editAdminProfile" title="Edit Your Profile"><span  style="float: right;" title="Edit Your Profile" class="glyphicon glyphicon-edit pull-left glyphicon_icons" aria-hidden="true"></span></a>

 <a href="" type="button" data-toggle="modal" data-target="#viewMyProfile" title="View Your Profile"><span  style="float: right; margin-right: 5%;" title="View Your Profile" class="glyphicon glyphicon-user pull-left glyphicon_icons" aria-hidden="true"></span></a>


<a href="" type="button" data-toggle="modal" data-target="#viewMyMessages" title="View Your Inbox Messages"><span  style="float: right; margin-right: 5%;" title="View Your Inbox Messages" class="glyphicon glyphicon-envelope pull-left glyphicon_icons" aria-hidden="true"></span> <span class="label label-pill label-danger count" style="border-radius:10px;"></span></a></p></center>
<!--Show Notifications Here-->
                <li class=" pickup_schedule_message"><a href=""></a></li>

<!--TOGGLE COLLAPSE LIST-->
  <a href="#hidden1" data-toggle="collapse"  class="list-group-item active main-color-bg">
     <span class="glyphicon glyphicon-folder-open" aria-hidden="true" style="margin-right: 1%;"> </span> Navigation
     </a>
<div id="hidden1" class="collapse" style="text-align: center;">
   <a href="" type="button" data-toggle="modal" data-target="#openPages
   " class="list-group-item add_item" title="Open Pages Page"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Pages</a>
  <a href="" type="button" data-toggle="modal" data-target="#openPosts" class="list-group-item add_item" title="Open Posts Page"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Posts</a>
</div><!--END TOGGLE COLLAPSE LIST-->

<!--TOGGLE COLLAPSE LIST-->
  <a href="#hidden" data-toggle="collapse"  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Items
    </a>
<div id="hidden" class="collapse" style="text-align: center;">
   <a href="" type="button" data-toggle="modal" data-target="#addEmployee
   " class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Employees</a>
      <a href="" type="button" data-toggle="modal" data-target="#addBranch
   " class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Branches</a>
   <a href="" type="button" data-toggle="modal" data-target="#addServices
   " class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Services</a>
   <a href="" type="button" data-toggle="modal" data-target="#addPriceList
   " class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Service Price Lists</a>
  <a href="" type="button" data-toggle="modal" data-target="#addAd" class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Ad/Tangazo</a>
  <a href="" type="button" data-toggle="modal" data-target="#addQuote" class="list-group-item add_item" title="Add New Items"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Quote of the Day</a>
  <a href="" type="button" data-toggle="modal" data-target="#addAdmin" class="list-group-item add_item" title="Add Admin Member"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Admin Member</a>
</div><!--END TOGGLE COLLAPSE LIST-->

<!--TOGGLE COLLAPSE LIST-->
  <a href="#editPages" data-toggle="collapse"  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Pages
    </a>
<div id="editPages" class="collapse" style="text-align: center;">
  <a href="" type="button" data-toggle="modal"
   " class="list-group-item add_item" title="Edit Page Links" data-target="#editPageLinks"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Page Links</a>
   <a href="../edit_home_page" type="button" data-toggle="modal"
   " class="list-group-item add_item" title="Edit Home Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Home Page</a>
     <a href="../our_team_for_edit" type="button" data-toggle="modal"
   " class="list-group-item add_item" title="Edit Home Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Our Team Page</a>
   <a href="../our_branches_for_edit" type="button" data-toggle="modal"
   " class="list-group-item add_item" title="Edit Home Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Our Branches</a>
 
</div><!--END TOGGLE COLLAPSE LIST-->

<!--TOGGLE COLLAPSE LIST-->
  <a href="#deleteItems" data-toggle="collapse"  class="list-group-item active main-color-bg">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Items
    </a>

<div id="deleteItems" class="collapse" style="text-align: center;">


  <!--TOGGLE COLLAPSE LIST Delete Services-->
    <a href="#deleteServices" data-toggle="collapse"  class="list-group-item add_item">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Services
    </a>

<div id="deleteServices" class="collapse" style="text-align: center;">
  <form action="index.php" method="get">
    <select onchange="this.form.submit();" name="btn_delete">
      <option selected data-default>Select to delete</option>
      <?php 
                $stmt = $db_conn->prepare('SELECT * FROM services ORDER BY id ASC');
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) 
                  {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row);

                ?>
      <option value="<?php echo ucfirst($row['id']); ?>">
        <?php echo ucfirst($row['title']); ?>
      </option>
  
    
    <?php     }  }?> 
     </select>
    </form>
 
</div><!--END TOGGLE COLLAPSE LIST Delete Services-->

  <!--TOGGLE COLLAPSE LIST Remove Employees-->
    <a href="#removeEmployee" data-toggle="collapse"  class="list-group-item add_item">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Remove Employee
    </a>

<div id="removeEmployee" class="collapse" style="text-align: center;">
    <form action="index.php" method="get">
    <select onchange="this.form.submit();" name="btn_delete_employee">
      <option selected data-default>Select to delete</option>
      <?php 
                $stmt = $db_conn->prepare('SELECT * FROM team ORDER BY id ASC');
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) 
                  {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row);

                ?>

   
    
      <option value="<?php echo ucfirst($row['id']); ?>">
        <?php echo ucfirst($row['first_name']); ?> <?php echo ucfirst($row['last_name']); ?>
      </option>
  
    
    <?php     }  }?> 
     </select>
    </form>
    
 
</div><!--END TOGGLE COLLAPSE LIST Remove Employees-->

<!--TOGGLE COLLAPSE LIST Delete Branches-->
    <a href="#deleteBranches" data-toggle="collapse"  class="list-group-item add_item">
    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Branches
    </a>

<div id="deleteBranches" class="collapse" style="text-align: center;">
      <form action="index.php" method="get">
    <select onchange="this.form.submit();" name="btn_delete_branch">
      <option selected data-default>Select to delete</option>
      <?php 
                $stmt = $db_conn->prepare('SELECT * FROM branches ORDER BY id ASC');
                  $stmt->execute();
                  if ($stmt->rowCount() > 0) 
                  {
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                      {
                        extract($row);

                ?>

   
    
      <option value="<?php echo ucfirst($row['id']); ?>">
        <?php echo ucfirst($row['location_name']); ?> 
      </option>
  
    
    <?php     }  }?> 
     </select>
    </form>
    
 
</div><!--END TOGGLE COLLAPSE LIST Delete Branches-->

 
</div><!--END TOGGLE COLLAPSE LIST-->


 <a href="#" class="list-group-item" title="Add New Items" ><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Categories</a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comments <span class="badge">307</span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Pages <span class="badge">7</span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Posts <span class="badge">0</span> </a>
 <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Admin Members<span class="badge"><?php echo $number_of_admin; ?></span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Subscribers <span class="badge"><?php echo $number_of_subscriber; ?></span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-user online_users" aria-hidden="true"></span> Online Users <span class="badge total_online_users">17</span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Likes<span class="badge">801</span> </a>
  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Videos&Tutorials<span class="badge"></span> </a>
  <!--TOGGLE COLLAPSE LIST-->
  <a href="#hidden2" data-toggle="collapse"  class="list-group-item active main-color-bg">
     <span class="glyphicon glyphicon-wrench" aria-hidden="true" style="margin-right: 1%;"> </span> Settings
     </a>
<div id="hidden2" class="collapse" style="text-align: center;">
   <a href="" type="button" data-toggle="modal" data-target="#changeColors
   " class="list-group-item add_item" title="Open Pages Page"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Change Colors</a>
  <a href="" type="button" data-toggle="modal" data-target="#others" class="list-group-item add_item" title="coming soon!"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Others</a>
</div><!--END TOGGLE COLLAPSE LIST-->
</div> 
</div>

    <div class="col-md-9 animated slideInUp">
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg" style="opacity: 1;">
          <h3 class="panel-title">Website Overview</h3>
        </div>
        <div class="panel-body">

          <div class="col-md-4">
            <div class="well dash-box" style="background: #f0f8ff;">
              <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $number_of_admin; ?></h2>
              <h4>Admin Members</h4>
            </div>
            
          </div>
          <div class="col-md-4">
            <div class="well dash-box" style="background: #f5fffa;">
              <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 0</h2>
              <h4>Posts</h4>
            </div>
            
          </div>
          <div class="col-md-4">
            <div class="well dash-box" style="background: #ffe4e1;">
              <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  <?php echo $number_of_subscriber; ?></h2>
              <h4>Subscribers</h4>
            </div>
            
          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading main-color-bg">
          <h3 class="panel-title">Online Users</h3>
        </div>
        <div class="panel-body">
          <table class="table table-striped table-hover">
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Role</th>
            </tr>
           
             <?php foreach ($users as $user){?>
            <tr>
              <th><?php echo $user['id']; ?></th>
              <th><a href="" type="button" data-toggle="modal" data-target="#viewMyProfile" title="View User Profile"><span style="color:black;" title="View User Profile" class="glyphicon glyphicon-open " aria-hidden="true"></span> <m style="color:black; text" ><?php echo ucfirst($user['username']); ?></m></th></a>
              <th><?php echo ucfirst($user['user_type']); ?></th>
            </tr>
            <?php }?>
          </table>
        </div>
      </div>
    </div>

  </div>
  </div>
</section>
<footer class="footer">
<hr><center>  Copyright © <?php
// if both years are the same, display only the current year ,
// if they are different display both with a dash between them
$startYear = 2018;
$thisYear = date("Y");
if ($startYear == $thisYear) {
echo $startYear;
} else {
echo "<strong>".$startYear."<strong> ~ </strong>".$thisYear."</strong>";
}
?>: Powered by <strong><em>jobgondwe.com</em></strong> </center>

            </footer>

<!-- Modals -->





<!-- Add New Quote -->
<div class="modal fade" id="addQuote" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  method="post" enctype="multipart/form-data" action="index.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">Add New Quote of the Day</h4>
      </div>
      <div class="modal-body">
         <div class="form-group">
          <label>Quote Body</label>
          <textarea name="quote_body" class="form-control" placeholder="Quote Body"></textarea>
         </div>
         <div class="form-group">
          <label>Quote Author</label>
          <input type="text" name="quote_author" class="form-control" placeholder="Quote Author">
         </div>
         <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="btn-quote" class="btn btn-primary">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!--End Add New Quote -->

<!-- Add New ADS/matangazo -->
<div class="modal fade" id="addAd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  method="post" enctype="multipart/form-data" action="index.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">Add New Ad/Tangazo la Biashara</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label>Ad Title</label>
          <input type="text" name="ad_title" class="form-control" placeholder="Ad Title">
         </div>
         <div class="form-group">
          <label>Ad Image</label>
          <input type="file" name="ad_image" class="form-control" required="" accept="*/image">
          <label>Image Alt-Texts</label>
          <input type="text" name="" class="form-control" placeholder="Eg: African Fashion">
         </div>
         <div class="form-group">
          <label>Ad Body</label>
          <textarea name="ad_body" class="form-control" placeholder="Ad Body"></textarea>
         </div>
         <div class="form-group">
          <label>Multiple Images</label>
          <input type="file" name="" class="form-control" accept="*/image">
          <label>Image Alt-Texts</label>
          <input type="text" name="alt_text" class="form-control" placeholder="Eg: African Fashion">
         </div>
         <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
         </div>
         <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add some tags for SEO">
         </div>
         <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description here">
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" name="btn-ad">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!--End Add New ADS/matangazo -->




<!-- Edit Page Links -->
<div class="modal fade" id="editPageLinks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="modal-header">
      <center><h3>EDIT PAGE LINKS</h3></center>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">Recommended image size is (60px) x (60px) dimmensions</h4>
      </div>
    <div class="modal-body">
         <div class="form-group">
          <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
         </div>
         <div class="form-group">
          <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
         </div>
         <div class="modal-footer">
           <button type="submit"   class="btn btn-success" name="btn_edit_page_links">Submit Changes</button> <br>        
        </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Edit Page Links -->



<!-- Add New Post -->
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center">Recommended image size is (60px) x (60px) dimmensions</h4>
      </div>
    <div class="modal-body">

         <div class="form-group">
            <label>Add Profile Image: </label><br>
          <input type="file"  name="image" accept="*/image" class="form-control" >
         </div>
         <div class="form-group">
          <input type="text" name="first_name" class="form-control" placeholder="First Name">
         </div>
         <div class="form-group">
          <input type="text" name="last_name" class="form-control" placeholder="Last Name">
         </div>
         <div class="form-group">
          <input type="text" name="position" class="form-control" placeholder="Position">
         </div>
         <div class="form-group">
          <textarea rows="4" class="form-control" name="first_social_media_link" placeholder="First Social Media Link(Optional)"></textarea>
         </div>
         <div class="form-group">
          <label style="float: left !important;">Add First Social Media(Optional):</label>
          <select name="first_social_media_icon" class="form-control" >
            <option selected data-default></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
         <div class="form-group">
          <textarea rows="4" class="form-control" name="second_social_media_link" placeholder="Second Social Media Link(Optional)"></textarea>
         </div>
         <div class="form-group">
            <label style="float: left !important;">Add Second Social Media(Optional):</label>
            <select name="second_social_media_icon" class="form-control" >
            <option selected data-default></option>
            <option>facebook</option>
            <option>instagram</option>
            <option>twitter</option>
            <option>linkedin</option>
            <option>youtube</option>
            <option>google</option>
          </select>
         </div>
         <div class="modal-footer">
           <button type="submit"   class="btn btn-success" name="btn_add_employee">Submit Profile</button> <br>        
        </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Add New Post -->


<!-- Add New Branch -->
<div class="modal fade" id="addBranch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="modal-header">
      <label>Add a New Branch: </label><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel" align="center">Recommended image size is (400px) x (200px) dimmensions</h5>
      </div>
      
    <div class="modal-body">
         <div class="form-group">
          <input type="text" name="location_name" class="form-control" placeholder="Location Name">
         </div>
         <div class="form-group">
            <label>Add Branch Image: </label><br>
          <input type="file"  name="image" accept="*/image" class="form-control" >
         </div>
         <div class="form-group">
          <input type="text" name="textual_content" class="form-control" placeholder="Textual Content">
         </div>
         <div class="modal-footer">
           <button type="submit"   class="btn btn-success" name="btn_add_branch">Submit</button> <br>        
        </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Add New Service -->

<!-- Add New Service-->
<div class="modal fade" id="addServices" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
  <form method="post" autocomplete="off" enctype="multipart/form-data">
    <div class="modal-header">
      <label>Add a New Service: </label><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="myModalLabel" align="center">Recommended image size is (400px) x (400px) dimmensions</h5>
      </div>
      
    <div class="modal-body">
         <div class="form-group">
          <input type="text" name="title" class="form-control" placeholder="Service Title">
         </div>
         <div class="form-group">
            <label>Add Service Image: </label><br>
          <input type="file"  name="image" accept="*/image" class="form-control" >
         </div>
         <div class="form-group">
          <input type="text" name="textual_content" class="form-control" placeholder="Textual Content">
         </div>
         <div class="modal-footer">
           <button type="submit"   class="btn btn-success" name="btn_add_service">Submit</button> <br>        
        </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Add New Service -->

<!-- Add New Price List-->
<div class="modal fade" id="addPriceList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form name="add_name" id="add_name" style="padding: 20px; padding-bottom: 40px;">
        <div class="modal-header">
      <label>Add a New Item with Prices </label><br>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div> 
        <div class="form-group" id="dynamic_field">
          <input   type="text" name="service_title[]" id="service_title" class="form-control service_title_list" placeholder="Enter Service Title">
          <input   style="display: none;" type="text" name="item[]" id="item" class="form-control name_list" placeholder="Enter Item">
          <input   style="display: none;" type="text" name="price[]" id="price" class="form-control title_list" placeholder="Enter Price">
          <button type="button" name="add" id="add" class="btn btn-success" title="ADD INPUT" ><strong>Add Input</strong></button>
         </div><input type="button" name="submit" id="submit" value="Submit" class="btn btn-default" title="SUBMIT DATA" style="position: relative; top: 20px; " /><br>
      </form>
    </div>
  </div>
</div><!-- End Add New Price List -->

<!-- Open  Change Colors -->
<div class="modal fade" id="changeColors" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="row">
        <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
                <div class="panel-heading main-color-bg">
          <h3 class="panel-title" align="center">Color Customization</h3>
        </div>
        </div>
        </div>
        <br>
      <table class="table table-striped table-hover">
          <tr style="background: grey; color: white;">
          <td>Grey</td>
          <td><a href="" type="button" data-toggle="modal" data-target="?color=grey" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
          <tr style="background: tan; color: white;">
          <th>Tan</th>
          <td><a href="" type="button" data-toggle="modal" data-target="?color=tan" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
          <tr style="background: olive; color: white;">
          <th>Olive</th>
         <td><a href="?color=olive" type="button" data-toggle="modal" data-target="?color=olive" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

        </div>
    </div>
    </div>
  </div>
</div><!--End Change Colors -->

<!-- Open  Pages Page -->
<div class="modal fade" id="openPages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="row">
        <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
                <div class="panel-heading main-color-bg">
          <h3 class="panel-title" align="center">Pages</h3>
        </div>
            <input class="form-control" type="text" placeholder="Filter Pages...">
        </div>
        </div>
        <br>
      <table class="table table-striped table-hover">
        <tr>
          <th>Title</th>
          <th>Published</th>
          <th>Created</th>
          <th></th>
          </tr>
          <tr>
          <td>Home</td>
          <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
          <td>Sept 21, 2017</td>
          <td><a href="" type="button" data-toggle="modal" data-target="#editPage" title="Edit This Page"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          <td><a href="#" title="Delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
          </tr>
          <tr>
          <th>About</th>
          <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
          <td>Sept 21, 2017</td>
          <td><a href="" type="button" data-toggle="modal" data-target="#editPage" title="Edit This Page"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          <td><a href="#" title="Delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
          </tr>
          <tr>
          <th>Services</th>
          <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
          <td>Sept 21, 2017</td>
         <td><a href="" type="button" data-toggle="modal" data-target="#editPage" title="Edit This Page"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          <td><a href="#" title="Delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
          </tr>
          <tr>
          <th>Contact</th>
          <td><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></td>
          <td>Sept 21, 2017</td>
          <td><a href="" type="button" data-toggle="modal" data-target="#editPage" title="Edit This Page"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          <td><a href="#" title="Delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
          </tr>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

        </div>
    </div>
    </div>
  </div>
</div><!--End Open  Pages Page -->

<!-- Open  others -->
<div class="modal fade" id="others" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="row">
        <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
                <div class="panel-heading main-color-bg">
          <h3 class="panel-title" align="center">Coming Soon!</h3>
        </div>
        </div>
        </div>
        <br>
      <table class="table table-striped table-hover">
          <tr>
          <td>others</td>
          <td><a href="" type="button" data-toggle="modal" data-target="#" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
          <tr>
          <th>others</th>
          <td><a href="" type="button" data-toggle="modal" data-target="#" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
          <tr>
          <th>others</th>
         <td><a href="" type="button" data-toggle="modal" data-target="#" title="Slect This Color"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
          </tr>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

        </div>
    </div>
    </div>
  </div>
</div><!--End others-->

<!-- Edit Post -->
<div style="z-index: 9999" class="modal fade" id="editPosts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Post</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label>Post Title</label>
          <input type="text" class="form-control" placeholder="Post Title">
         </div>
         <div class="form-group">
          <label>Post Body</label>
          <textarea name="" class="form-control" placeholder="Body">CSS properties. Thus, there are no slide transition animations when 
          using these browsers. We have intentionally decided not to include Explorer 8 & 9 don't support the necessary CSS properties. Thus, 
          there are no slide transition animations when using these browsers. We have intentionally. support the necessary CSS properties. 
          Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include Explorer
           8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations.</textarea>
         </div>
         <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
         </div>
         <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add some tags for SEO">
         </div>
         <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description here">
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Edit Post -->

<!-- Edit Page -->
<div class="modal fade" id="editPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Page</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
         </div>
         <div class="form-group">
          <label>Page Body</label>
          <textarea name="" class="form-control" placeholder="Body">CSS properties. Thus, there are no slide transition animations when 
          using these browsers. We have intentionally decided not to include Explorer 8 & 9 don't support the necessary CSS properties. Thus, 
          there are no slide transition animations when using these browsers. We have intentionally. support the necessary CSS properties. 
          Thus, there are no slide transition animations when using these browsers. We have intentionally decided not to include Explorer
           8 & 9 don't support the necessary CSS properties. Thus, there are no slide transition animations.</textarea>
         </div>
         <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
         </div>
         <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add some tags for SEO">
         </div>
         <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description here">
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Edit Page -->

<!-- Open   Posts Page -->

<div class="modal fade" id="openPosts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="row">
        <div class="panel-body">
        <div class="row">
        <div class="col-md-12">
                <div class="panel-heading main-color-bg">
                
          <h3 class="panel-title" align="center">Total Posts</h3>

        </div>
            <input class="form-control" type="text" placeholder=" Filter Posts...">
        </div>
        </div>
        <br>
      <form method="post" enctype="multipart/form-data" action="index.php">
      <label style="float: left; margin-left: 2%;">Title</label><label style="margin-left: 67%; ">Edit/Delete</label>
      <center><hr></center>
      <br>
            <?php foreach ($articles as $article){?>
      <label style=" margin-left: 2%; font-size: 10px;"><?php echo strtoupper($article['pageTitle']); ?></label><a href=""><span class="glyphicon glyphicon-remove-circle" style="float: right; margin-right: 10%;"> </span></a> <a href=""><span class="glyphicon glyphicon-edit" style="float: right; margin-right: 10%;"> </span></a><br>

        </form>
        <?php }?>
              <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

        </div>
    </div>
    </div>
  </div>
</div>
<!--End Open  Posts Page -->






<!-- Edit Admin Profile --> 
<div class="modal fade" name="editAdminProfile" id="editAdminProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Your Profile</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>Change Profile Picture</label>
            <input type="file" name="profileImage" class="form-control" required="" accept="*/image">
           </div>
           <div class="form-group">
            <label>Old Password</label>
            <input type="password" name="password" class="form-control" placeholder="Password">
           </div>
           <div class="form-group">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control" placeholder="Password">
           </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Edit Admin Profile --> 

<!-- View Admin Profile --> 
<div class="modal fade" id="viewMyProfile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      </div>
      <center><h4>My Profile</h4></center>
      <div class="viewMyProfile1">
          <div class="form-group">
          <center><label class="viewMyProfile"><img src="img/user.png" class="user_large_image" ><br> </label><br><hr class="profileHR"></center>
         </div>
        <div class="form-group">
          <label class="viewMyProfile">Name:</label><label> <strong><?php echo $row['first_name']." ".$row['last_name']; ?></strong></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Role:</label><label> <?php echo ucfirst($row['username']); ?></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Email Address:</label><label> <?php echo $row['email']; ?></label>
         </div>
           <div class="form-group">
          <label class="viewMyProfile">Gender:</label><label> <?php echo ucfirst($row['gender']); ?></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Professional:</label><label> <?php echo ucfirst($row['my_professional']); ?></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Facebook Page:</label><label> <a href=""></label><span title="Go to My Facebook Page" class="glyphicon glyphicon-link myLink" aria-hidden="true"></span></a> 
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Instagram Page:</label><label> <a href=""></label><span title="Go to My Instagram Page" class="glyphicon glyphicon-link myLink" aria-hidden="true"></span></a> 
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Twitter Page:</label><label> <a href=""></label><span title="Go to My Twitter Page" class="glyphicon glyphicon-link myLink" aria-hidden="true"></span></a> 
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Contact:</label><label> <?php echo $row['phone_number']; ?></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">Hobies:</label><label> <?php echo ucfirst($row['my_hobbies']); ?></label>
         </div>
         <div class="form-group">
          <label class="viewMyProfile">About Me:</label><label><div class="well dash-box" style="color: #000; text-align: left;">
              
              <h4><?php echo ucfirst($row['about_me']); ?></h4>
            </div></label>
         </div>
         
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
</div><!-- End View Admin Profile --> 


<!-- Add Home Page Slider --> 
<div class="modal fade" id="editHomePage" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="post" enctype="multipart/form-data" action="index.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Home Page Slider</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <input type="text" name="item" class="form-control" placeholder="Item" required>
         </div>
         <div class="form-group">
          <label>Add Slider Image</label>
          <input type="file" name="image" class="form-control"  accept="*/image" required>
         </div>
          <div class="form-group">
          <input type="text" name="title" class="form-control" placeholder="Add Slider Title" required>
         </div>
        <div class="form-group">
          <textarea id="" rows="8" name="content" class="form-control" placeholder="Add Slider Textual Content" required></textarea>
         </div>
         <div class="checkbox">
      <div class="modal-footer">
        <button type="submit" name="edit_home_page" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>        
      </div>
      </div>
    </div>
      </form>
    </div>
  </div>
</div><!-- End Add Home Page Slider -->


<!-- View My Inbox Messages --> 
<div class="modal fade" id="viewMyMessages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      </div>
      <center><h4>My Inbox</h4></center>
      <div class="viewMyProfile1">
          <div class="form-group">
          <label class="viewMyProfile"><img src="../img/user1.gif" class="user_image"><br> </label><br><hr class="profileHR">
         </div>
        <div class="form-group">
          <label class="viewMyProfile"><a class="myLink" href="">Inbox:</label><label><span class="badge"> 120 </span></label></a> 
         </div>
        <div class="form-group">
          <label class="viewMyProfile"><a href="">New Messages:</label><label><span class="badge"> 0 </span></label></a> 
         </div>
         <div class="form-group">
          <label class="viewMyProfile"><a href="">Starred:</label><label><span class="badge"> 21 </span></label></a> 
         </div>
        <div class="form-group">
          <label class="viewMyProfile"><a href="">Important:</label><label><span class="badge"> 12 </span></label></a> 
         </div>
         <div class="form-group">
          <label class="viewMyProfile"><a href="">Sent Messages:</label><label><span class="badge"> 120 </span></label></a> 
         </div>
        <div class="form-group">
          <label class="viewMyProfile"><a href="">Drafts:</label><label><span class="badge"> 0 </span></label></a> 
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
</div><!-- End View My Inbox Messages -->


<!-- Add Admin Member --> 
<div class="modal fade" id="addAdmin" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Admin Member</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
          <label>Admin Name</label>
          <input type="text" class="form-control" placeholder="Admin Name">
         </div>
        <div class="form-group">
            <label>Email Address</label>
            <input type="text" class="form-control" placeholder="Enter Email">
           </div>
           <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" placeholder="Password">
           </div>
         <div class="checkbox">
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </div>
      </form>
    </div>
  </div>
</div><!-- End Add Admin Member --> 


<!-- Bootstrap Core Javascript-->

<script src="../tools/js/jquery.min.js"></script>
  <script src="../tools/js/bootstrap.min.js"></script>
  <script src="tools/js/bootstrap.js"></script>

<!-- Javascript for ajax add inputs for the Price Lists-->
<script>
  $(document).ready(function(){
    var i = 1;


    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'" style="position: relative; top: 20px; display: none;"><td style="position: relative; top: 20px;"><input type="text" name="service_title[]" id="service_title" class="form-control service_title_list" placeholder="Enter Service Title"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove" title="REMOVE INPUT" style="position: relative; top: 5px;">X</button></td></tr>');
          
    });

    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'" style="position: relative; top: 20px;"><td style="position: relative; top: 20px;"><input type="text" name="item[]" id="item" class="form-control name_list" placeholder="Enter Item"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove" title="REMOVE INPUT" style="position: relative; top: 5px;">X</button></td></tr>');
          
    });

    $('#add').click(function(){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'" style="position: relative; top: 20px;"><td style="position: relative; top: 20px;"><input type="text" name="price[]" id="price" class="form-control title_list" placeholder="Enter Price"></td><td><button name="remove" id="'+i+'" class="btn btn-danger btn_remove" title="REMOVE INPUT" style="position: relative; top: 5px;">X</button></td></tr>');
          
    });
       $('#Submit').click(function(){
      $('#service_title').val('');

    });


    $(document).on('click', '.btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();
    });

    $('#submit').click(function(){
      $.ajax({
        url:"name.php",
        method:"POST",
        data:$('#add_name').serialize(),
        success:function(data)
        {
          alert(data);
          $('#add_name')[0].reset();
        }
      });
    });
  });
</script>
<!-- END Javascript for ajax add inputs for the Price Lists-->
















<!--AJAX Script for pickup schedules-->
<script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"../includes/ajax.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.pickup_schedule_message').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#comment_form').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#content').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"../includes/ajax.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#comment_form')[0].reset();
     load_unseen_notification();
     alert("Message Sent Succesfully!");
    }
   });
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 $(document).on('click', '.pickup_schedule_message', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script><!--END AJAX Script for pickup schedules-->

  
      <script>
      CKEDITOR.replace( 'editor1' );
    </script>

</body>
</html>