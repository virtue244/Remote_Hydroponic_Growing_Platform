<?php
session_start();

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
if (empty($username) || empty($email) || empty($password_1) || empty($password_2)) 
{
  array_push($errors,"<div class='login_validation_alert'><strong>All Fields Required!</strong></div>");
}else{
  $pattern = "/^[a-zA-Z0-9 ]+$/";
    if(!preg_match($pattern, $username))
    {
      array_push($errors,"<div class='login_validation_alert'><strong>Username can only be letters(a-z) and numbers(0-9)!</strong></div>");
    }else{
      // first check the database to make sure 
  // a user does not already exist with the same username and/or email

            $Check_Username = $db_conn->prepare("SELECT username FROM users WHERE username = ?");
            $Check_Username->execute([$username]);
            if($Check_Username->rowCount() == 1)
            {
              array_push($errors,  "<div class='login_validation_alert'><strong>This username is already taken!</strong></div>");    
            }else{
              if(strlen($username) < 2 )
                       {
                    array_push($errors,  "<div class='login_validation_alert'><strong>Username too short!</strong></div>");  
                       }else{
            $Check_Email = $db_conn->prepare("SELECT email FROM users WHERE email = ?");
            $Check_Email->execute([$email]);
            if($Check_Email->rowCount() == 1)
            {
              array_push($errors,  "<div class='login_validation_alert'><strong>This email is already taken!</strong></div>");    
            }else{
              if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                       array_push($errors,  "<div class='login_validation_alert'><strong>E-mail not valid!</strong></div>");  
                    }else{
                          if(strlen($password_1) <= 5 && strlen($password_2) <= 5)
                               {
                            array_push($errors,  "<div class='login_validation_alert'><strong>Passwords too short!</strong></div>");  
                               }else{
                                    if ($password_1 != $password_2) {
                                    array_push($errors, "The two passwords do not match");
                                    }else{
                                      // Finally, register user if there are no errors in the form
                                  if (count($errors) == 0) {

                                    $password = md5($password_1);//encrypt the password before saving in the database
                                    $user_type = "user";//register as normal user
                                    $code = mt_rand();
                                    $status = "not verified";

                                    $stmt=$db_conn->prepare("INSERT INTO users( username, email, password, user_type, code, status, timestamp) VALUES (:myUsername, :myEmail, :myPass, :myUser, :myCode, :myStatus,  :myTime)");
                                    $stmt->bindParam(':myUsername', $username);
                                    $stmt->bindParam(':myEmail', $email);
                                    $stmt->bindParam(':myPass', $password);
                                    $stmt->bindParam(':myUser', $user_type);
                                    $stmt->bindParam(':myCode', $code);
                                    $stmt->bindParam(':myStatus', $status);
                                    $stmt->bindValue(':myTime', time());
                                    $stmt->execute();

                                    //Send code to the provided E-mail
                                      if (isset($_REQUEST['reg_user'])) {
                                        // Initialize error array.
                                          $errors = array();

                                          //Send the Email
                                          if (isset($_REQUEST['reg_user'])) {
                                          if (empty($errors)) { 
                                          $from = "From: ANGEMOR.COM"; //Site name
                                          // Change this to your email address you want the form sent to
                                          // Example: $to = "jobgondwe@gmail.com"; 
                                          $to = $email; 
                                          $subject = "VERIFICATION CODE: " .$code. " ";
                                          
                                        //Message Delivery
                                          $message = nl2br("Hello  "  .$username.  ", your VERIFICATION CODE is:  "  .$code.  " Please use the code to verify your account/subscription. ");
                                          mail($to,$subject,$message,$from);
                                          }
                                        }
                                        }
                                        //END Send code to the provided E-mail

                                         $_SESSION['username'] = $username;
                                         $_SESSION['email'] = $email;
                                         $_SESSION['registered'] = "Hi " .$_SESSION['username'] ."! <u><em>VERIFICATION CODE</em></u> has been sent to " .$_SESSION['email'] .". Please use the code to verify yourself below. "; 
                                         header('location: confirm_email');
                                  }
                              }
                         }

                 }

                }

  }
}
            
}
}
 
}

// ... 
