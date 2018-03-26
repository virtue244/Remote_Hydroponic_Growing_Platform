<?php

// RESET PASSWORD
if (isset($_POST['btn_subscribe'])) {
  // receive all input values from the form
  $email = $_POST['email'];
    if (empty($email)){
      array_push($errors,'<div class="login_validation_alert">Please Enter Your E-mail to Subscribe!</div>');
}else{
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                       array_push($errors,  "<div class='login_validation_alert'><strong>E-mail not valid!</strong></div>");  
                    }else{
                            $Check_Email = $db_conn->prepare("SELECT email FROM subscribers WHERE email = ?");
                            $Check_Email->execute([$email]);
                            if($Check_Email->rowCount() == 1)
                            {
                              array_push($errors,  "<div class='login_validation_alert'><strong>This email has already subscribed!</strong></div>");    
                            }else{
                            // Finally, register user if there are no errors in the form
                                  if (count($errors) == 0) {

                                        //user entered correct details 
                                        try{
                                        //insert subscriber into the database
                                            $stmt=$db_conn->prepare("INSERT INTO subscribers(email, timestamp) VALUES ( :myEmail, :myTime)");
                                            $stmt->bindParam(':myEmail', $email);
                                            $stmt->bindValue(':myTime', time());
                                            $stmt->execute();

                                      //Send new password to the provided E-mail
                                      if (isset($_REQUEST['btn_subscribe'])) {
                                        // Initialize error array.
                                          $errors = array();

                                          //Send the Email
                                          if (isset($_REQUEST['btn_subscribe'])) {
                                          if (empty($errors)) { 
                                          $from = "From: ANGEMOR.COM"; //Site name
                                          // Change this to your email address you want the form sent to
                                          // Example: $to = "jobgondwe@gmail.com"; 
                                          $to = $email; 
                                          $subject = "NEWSLETTER SUBSCRIPTION";
                                          
                                        //Message Delivery
                                          $message = nl2br("Hello, thank you for subscribing to our newsletter...we will keep you posted.");
                                          mail($to,$subject,$message,$from);
                                          }
                                        }
                                        }
                                               ?>
                                                <script type="text/javascript">
                                                  alert('You have Successfully Subscribed to our newsletter!');
                                                  window.location.href="index.php";
                                                </script>
                                                <?php
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
                            //...RESET PASSWORD






            














            