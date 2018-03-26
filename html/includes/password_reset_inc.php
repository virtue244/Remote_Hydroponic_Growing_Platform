<?php
session_start();

// RESET PASSWORD
if (isset($_POST['btn_pass_reset'])) {
  // receive all input values from the form
  $email = $_POST['email'];
    if (empty($email)){
      array_push($errors,'<div class="login_validation_alert">Please Enter Your E-mail to Reset Password!</div>');
}else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                       array_push($errors,  "<div class='login_validation_alert'><strong>E-mail not valid!</strong></div>");  
                    }else{
                            $Check_Email = $db_conn->prepare("SELECT email FROM users WHERE email = ?");
                            $Check_Email->execute([$email]);
                            if($Check_Email->rowCount() != 1)
                            {
                              array_push($errors,  "<div class='login_validation_alert'><strong>This email does not exist!</strong></div>");    
                            }else{
                            // Finally, register user if there are no errors in the form
                                  if (count($errors) == 0) {
                                    
                                      //E-mail verification
                                      $stmt=$db_conn->prepare("SELECT * FROM users WHERE email = ?");
                                      
                                      $stmt->bindValue(1, $email);
                                      
                                      $stmt->execute();
                                      
                                      $num = $stmt->rowCount();
                                      
                                      if ($num == 1){
                                        //user entered correct details 
                                        try{
                                        //$password_reset = mt_rand();//encrypt the password before saving in the database

                                            $password_reset = mt_rand();
                                            $verify = $db_conn->prepare("UPDATE users SET  password_reset = :reset, timestamp = :myTime WHERE email='$email'");
                                            $verify->bindParam(':reset', $password_reset);
                                            $verify->bindParam(':myTime', time());
                                            $verify->execute();


                                      //Send new password to the provided E-mail
                                      if (isset($_REQUEST['btn_pass_reset'])) {
                                        // Initialize error array.
                                          $errors = array();

                                          //Send the Email
                                          if (isset($_REQUEST['btn_pass_reset'])) {
                                          if (empty($errors)) { 
                                          $from = "From: ANGEMOR.COM"; //Site name
                                          // Change this to your email address you want the form sent to
                                          // Example: $to = "jobgondwe@gmail.com"; 
                                          $to = $email; 
                                          $subject = "NEW PASSWORD: " .$password_reset. " ";
                                          
                                        //Message Delivery
                                          $message = nl2br("Hello, your NEW PASSWORD is:  "  .$password_reset.  " Please use the new password to sign in. ");
                                          mail($to,$subject,$message,$from);
                                          }
                                        }
                                        }
                                        $new_pass_reset = $password_reset; 
                                        //END Send password_reset to the provided E-mail
                                         $_SESSION['email'] = $email;
                                         $_SESSION['registered'] = "Hi there!, <u><em>NEW PASSWORD</em></u> has been sent to <u>" .$_SESSION['email'] ."</u>. Please use the new password to verify yourself below. ";  

                                         header('location: confirm_password_reset');
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
                            //...RESET PASSWORD






            














            