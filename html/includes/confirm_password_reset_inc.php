<?php 
session_start();

//Display Login Page
  if (isset($_POST['btn_password_reset_verify'])){
    $password_reset = $_POST['password_reset'];
    if (empty($password_reset)){
      array_push($errors,'<div class="login_validation_alert">Please Enter Your Password!</div>');
} else {//password_reset verification
      $stmt=$db_conn->prepare("SELECT * FROM users WHERE password_reset = ?");
      
      $stmt->bindValue(1, $password_reset);
      
      $stmt->execute();
      
      $num = $stmt->rowCount();
      
      if ($num != 1){ // PHP Elseif Statement
  //user entered wrong details
        array_push($errors,'<div class="login_validation_alert">You Entered Incorrect Password!</div>');
}else{
      //password_reset verification
      $stmt=$db_conn->prepare("SELECT * FROM users WHERE password_reset = ?");
      
      $stmt->bindValue(1, $password_reset);
      
      $stmt->execute();
      
      $num = $stmt->rowCount();
      
      if ($num == 1){
        //user entered correct details 
      try{
        $new_password = md5($password_reset);
        $Insert_Query = $db_conn->prepare("UPDATE users SET Password='$new_password'  WHERE password_reset='$password_reset'");
        $Insert_Query->execute([$new_password]);

        $status = "verified";
        $verify = $db_conn->prepare("UPDATE users SET  status = :verified, timestamp = :myTime WHERE password_reset=$password_reset");
        $verify->bindParam(':verified', $status);
        $verify->bindParam(':myTime', time());
        $verify->execute();

       //This SQL query adds new column called 'new_password_verified' after the first column (id).
                      $sql = "ALTER TABLE  `users` ADD  `new_password_verified` VARCHAR(100) NOT NULL AFTER  `id` ;";
                       
                      //Execute the query.
                      $db_conn->query($sql);

          $_SESSION['username'] = $username;
          $_SESSION['new_password'] = "Please enter the Password that was sent to your E-mail and then your new Password to Login.";    
            header('Location: new_password');
      }
      catch(PDOException $e)
      {
        //echo "There was an error; please check your connection and try again!".$e->getMessage();

        $_SESSION['username'] = $username;
          $_SESSION['new_password'] = "Please enter the Password that was sent to your E-mail and then your new Password to Login.";    
        header('Location: new_password');
      }



      }
      
    }//END code verification
}
} 