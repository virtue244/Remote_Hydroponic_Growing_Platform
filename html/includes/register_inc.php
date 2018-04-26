<?php
session_start();

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = $_POST['username'];
  $email = $_POST['email'];
  $product_id = $_POST['product_id'];
  $password_1 = $_POST['password_1'];
  $password_2 = $_POST['password_2'];

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
if (empty($username) || empty($email) || empty($product_id) || empty($password_1) || empty($password_2)) 
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
                          $check_product_id = $db_conn->prepare("SELECT product_id FROM users WHERE product_id = ?");
                          $check_product_id->execute([$product_id]);
                          if($check_product_id->rowCount() == 1)
                          {
                            array_push($errors,  "<div class='login_validation_alert'><strong>The Product ID (<strong style='color: #000;'>".$product_id."</strong>) Has Already Been Used!</strong></div>");    
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
                                    $code = rand();
                                    $status = "not verified";
                                    $user_rank = "Medium";
                                    $user_integer_value = "30";

                                    $stmt=$db_conn->prepare("INSERT INTO users( username, email, product_id, password, user_type, code, status, user_rank, user_integer_value) VALUES (:myUsername, :myEmail, :myProductId, :myPass, :myUser, :myCode, :myStatus, :mySunlight, :myDays)");
                                    $stmt->bindParam(':myUsername', $username);
                                    $stmt->bindParam(':myEmail', $email);
                                    $stmt->bindParam(':myProductId', $product_id);
                                    $stmt->bindParam(':myPass', $password);
                                    $stmt->bindParam(':myUser', $user_type);
                                    $stmt->bindParam(':myCode', $code);
                                    $stmt->bindParam(':myStatus', $status);
                                    $stmt->bindParam(':mySunlight', $user_rank);
                                    $stmt->bindParam(':myDays', $user_integer_value);
                                    $stmt->execute();
                                    
                                        $status = "verified";
                                        $verify = $db_conn->prepare("UPDATE users SET  status = :verified, timestamp = :myTime WHERE product_id=$product_id");
                                        $verify->bindParam(':verified', $status);
                                        $verify->bindParam(':myTime', time());
                                        $verify->execute();

                                         $_SESSION['username'] = $username;
                                         $_SESSION['email'] = $email;
                                         $_SESSION['registered'] = "Welcome " .$_SESSION['username'] ."! You have been registered successfully!";  

                                          header('location: index.php');
                                         //header('location: confirm_email.php');
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
 
}

// ... 


           