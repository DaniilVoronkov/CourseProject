<?php 
 if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
  //connecting the database
  require_once("databaseConnection.php");
   //unsetting the variables from the previous try
  unset($_SESSION['tempEmail']);
  unset($_SESSION['tempPassword']);
  //storing the user input in the appropriate variables
  $userEmail = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
  $userPassword = filter_input(INPUT_POST, 'userPass');
  $selectAllUserDataQuery = "SELECT * FROM users_table WHERE email = :email;";
  //preparing the query
  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  //binding parameter
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  //executing the query
  $preparedStatement->execute();

  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);
  //verifying the password
  $auth = password_verify($userPassword, $userinfo['password']);
  
  if($auth === true)
  {
    $_SESSION["user"] = $userinfo;
    $_SESSION['sucess'] = true;
    //moving to the main menu
    header("location:index.php");
  }
  else {
    //storing the user input from this try in the variable and send it back to the login form as the session constants
      $_SESSION['loginError'] = "Incorrect login or user name, try again!";
      $_SESSION['tempEmail'] = $userEmail; 
      $_SESSION['tempPassword'] = $userPassword; 
      header("Location:LogIn.php");
  }
?>