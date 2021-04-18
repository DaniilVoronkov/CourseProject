<?php 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
    require_once("databaseConnection.php");
  
  $userEmail = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
 
  $userPassword = filter_input(INPUT_POST, 'userPass');
  
  $selectAllUserDataQuery = "SELECT * FROM users_table WHERE email = :email";
  

  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  
  
  $preparedStatement->execute();

  // Check if we have a user and their password is correct
  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);

  $auth = password_verify($userPassword, $userinfo['password']);
  $_SESSION["user"] = $userinfo;
  
  if($auth === true)
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  $_SESSION['sucess'] = true;
    
    header("location:index.php");
  }
  else {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
      $_SESSION['loginError'] = "Incorrect login or user name, try again!";
     /* $_SESSION['email'] = $userinfo['email']; */
      $_SESSION['password'] = $userPassword; 
      header("Location:LogIn.php");
  }
?>