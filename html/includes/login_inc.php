<?php

session_start();
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $status = $_POST['status'];
  

  if (empty($username) || empty($password)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>All Fields Required!</strong></div>");
}else{
      $pass = md5($password);
      $stmt=$db_conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
      
      $stmt->bindValue(1, $username);
      $stmt->bindValue(2, $pass);
      
      $stmt->execute();
      
      $num = $stmt->rowCount();
      
      if ($num != 1)
            {
              array_push($errors, "Incorrect username/password!"); 
              array_push($forgot_password_errors, "<p style='float: left;'>Forgot your password?<a href='password_reset' > <u style='color: green;'><strong>Click here.</strong></u></a></p><br>");  
              $_SESSION['password_reset'] = "Hi there! Please enter your email to reset your password. ";  
            }else{
                if (count($errors) == 0) {
                      $password = md5($password);
                      $stmt=$db_conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
                      $stmt->bindValue(1, $username);
                      $stmt->bindValue(2, $password);
                        
                      $stmt->execute();
                        
                      $num = $stmt->rowCount();
                  
                  if ($num == 1){
                  $_SESSION['username'] = $username;
                   foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username_two']}'") as $row);
                    if($row['user_type'] == 'subscriber')
                  {
                  header("Location: index");
                  }else{
                    $_SESSION['username'] = $username;
                  foreach ($db_conn->query("SELECT * FROM users WHERE username ='{$_SESSION['username']}'") as $row);
                  if($row['user_type'] == 'admin')
                  {
                    $_SESSION['success'] = "Welcome ".ucfirst($row['username']).", you are now logged in as ".ucfirst($row['user_type'])."!";
                  header("Location: admin/index");
                  }else{
                    header("Location: index");
                  }
                  }
                }
              }
            }
      }
}
//../LOGIN USER... 




                  






                  

