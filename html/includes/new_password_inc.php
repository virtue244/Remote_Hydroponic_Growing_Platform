<?php
session_start();

// REGISTER USER
if (isset($_POST['btn_new_password'])) {
  // receive all input values from the form
  $password_reset = $_POST['password_reset'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
if (empty($password_1) && empty($password_2)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>All Fields Required!</strong></div>");
}else{
      if(strlen($password_1) <= 5 && strlen($password_2) <= 5)
      {
          array_push($errors,  "<div class='login_validation_alert'><strong>Your New Passwords is too short!</strong></div>");  
      }else{
        if ($password_1 != $password_2)
            {
            array_push($errors, "The two passwords do not match");
            }else{
              $pass = $password_reset;
              $stmt=$db_conn->prepare("SELECT password_reset FROM users WHERE  password_reset = ?");
              $stmt->bindValue(1, $pass);

              $stmt->execute();

              $num = $stmt->rowCount();

              if ($num != 1)
                  {
                    array_push($errors, "Your Old Password Is Incorrect!");  
                  }else{
                              // Finally, register user if there are no errors in the form
                          if (count($errors) == 0) {

                            //password_reset verification
                            $stmt=$db_conn->prepare("SELECT * FROM users WHERE password_reset = ?");
                            
                            $stmt->bindValue(1, $password_reset);
                            
                            $stmt->execute();
                            
                            $num = $stmt->rowCount();
                            
                            if ($num == 1){
                              //user entered correct details 
                            try{
                              $new_password = md5($password_1);//encrypt the password before saving in the database
                              $Insert_Query = $db_conn->prepare("UPDATE users SET password='$new_password'  WHERE password_reset='$password_reset'");
                              $Insert_Query->execute([$new_password]);

                              $new_password_verified = "verified";
                              $verify = $db_conn->prepare("UPDATE users SET  new_password_verified = :verified, timestamp = :myTime WHERE password_reset=$password_reset");
                              $verify->bindParam(':verified', $new_password_verified);
                              $verify->bindParam(':myTime', time());
                              $verify->execute();
                                $_SESSION['username'] = $username;
                                $_SESSION['new_password_verified'] = "Hi " .$_SESSION['username'] ."! Password successfully updated Please Login using your New Password!. ";  

                              header('location: login');
                            }
                            catch(PDOException $e)
                            {
                              echo "There was an error; please check your connection and try again!".$e->getMessage();
                            }
                          }
                      }
                 }
          }
      }
    }
}
                

  

            

