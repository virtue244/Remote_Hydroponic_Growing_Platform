<?php 
session_start();

//Display Login Page
  if (isset($_POST['code_verify'])){
    $code = $_POST['code'];
    if (empty($code)){
      array_push($errors,'<div class="login_validation_alert">Please Enter Your Code!</div>');
} else {//code verification
      $stmt=$db_conn->prepare("SELECT * FROM users WHERE code = ?");
      
      $stmt->bindValue(1, $code);
      
      $stmt->execute();
      
      $num = $stmt->rowCount();
      
      if ($num != 1){ // PHP Elseif Statement
  //user entered wrong details
        array_push($errors,'<div class="login_validation_alert">You Entered Incorrect Code!</div>');
}else{
      //code verification
      $stmt=$db_conn->prepare("SELECT * FROM users WHERE code = ?");
      
      $stmt->bindValue(1, $code);
      
      $stmt->execute();
      
      $num = $stmt->rowCount();
      
      if ($num == 1){
        //user entered correct details 
      try{
        $Insert_Query = $db_conn->prepare("UPDATE users SET confirm_code='$code'  WHERE code=$code");
        $Insert_Query->execute([$confirm_code]);

        $status = "verified";
        $verify = $db_conn->prepare("UPDATE users SET  status = :verified, timestamp = :myTime WHERE code=$code");
        $verify->bindParam(':verified', $status);
        $verify->bindParam(':myTime', time());
        $verify->execute();



          $_SESSION['username'] = $username;
          $_SESSION['verified'] = "You have been registered and verified successfully! <br> You may now login using your credentials.";    
            header('Location: login.php');
      }
      catch(PDOException $e)
      {
        echo "There was an error; please check your connection and try again!".$e->getMessage();
      }



      }
      
    }//END code verification
}
} 


