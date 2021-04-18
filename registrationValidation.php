<?php 
//starting session
 session_start();
 //unsetting some temporary variables (in case if the user failed validation before)
 unset($_SESSION['passwordError']);
 unset($_SESSION['temporaryFName']); 
 unset($_SESSION['temporaryLName']); 
 unset($_SESSION['userFavTeam']); 
 unset($_SESSION['temporaryPass']); 
 unset($_SESSION['temporaryMail']); 
 unset($_SESSION['emptyEmail']); 
 unset($_SESSION['emptyFName']); 
 unset($_SESSION['emptyLName']);

 
try{
 ob_start();
 //connecting the database
  require_once("databaseConnection.php");
//storing the user input in the variables
  $userEmail = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
  $userFName = filter_input(INPUT_POST, 'fname');
  $userLName = filter_input(INPUT_POST, 'lname');
  $userFTeam = filter_input(INPUT_POST, 'favTeam');
  $userPassword = filter_input(INPUT_POST, 'Password');
  //validation flag
  $validData = true;
  //checking if the email field is empty. If it is - validation failed
  if(empty($userEmail))
  {
    $_SESSION['emptyEmail'] = "The email cant be empty!";
    $validData = false;
  }
  //checking if the first name is empty
  if(empty($userFName))
  {
    $_SESSION['emptyFName'] = "The first name cant be empty!";
    $validData = false;
  }
  //checking if the last name is empty
  if(empty($userLName))
  {
    $_SESSION['emptyLName'] = "The last name cant be empty!";
    $validData = false;
  }
  //checking if the password size is less or equal to 3 characters
  if(strlen($userPassword) <= 3)
  {
    $_SESSION['passwordError'] = "The password must be more than 3 characters";   
    $validData = false;    
  }
  //if at least one of the inputs is not valid - redirect back to the register page with errors
  if($validData === false)
  {
    $_SESSION['temporaryFName'] = $userFName;
    $_SESSION['temporaryLName'] = $userLName;
    $_SESSION['userFavTeam'] = $userFTeam;
    $_SESSION['temporaryPass'] = $userPassword;
    $_SESSION['temporaryMail'] = $userEmail;
    header("Location: UserRegister.php");
    exit();
  }

  //hashing the password
  $password = password_hash($userPassword, PASSWORD_DEFAULT);
  //query that inserts datya in the database
  $selectAllUserDataQuery = "INSERT INTO users_table (email,first_name,last_name,fav_team,password)
  VALUES (:email,:fName,:lName,:fTeam,:pWord);";
 
  //preparing the query
  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  //binding the parameters
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  $preparedStatement->bindParam(':fName', $userFName, PDO::PARAM_STR);
  $preparedStatement->bindParam(':lName', $userLName, PDO::PARAM_STR);
  $preparedStatement->bindParam(':fTeam', $userFTeam, PDO::PARAM_STR);
  $preparedStatement->bindParam(':pWord', $password);
  //executing the script
  $preparedStatement->execute();

  // fetching the data
  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);

  $_SESSION['sucess'] = true;
  //query that retrieves the new user data
  $selectAllUserDataQuery = "SELECT * FROM users_table WHERE email = :email";
  //preparing the query
  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  //binding the parameter
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  //executing the query
  $preparedStatement->execute();

  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);
  //defining the user data as the session constant
  $_SESSION['user'] = $userinfo;
  //closing the connection with the database
  $preparedStatement->closeCursor();
  //redirecting to the main page
  header("Location:index.php");
  //catching the exception
} catch(Exception $e)
{
    echo $e->getMessage();
}
?>