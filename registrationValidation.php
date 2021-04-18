<?php 
session_start();
unset($_SESSION['passwordError']);
 unset($_SESSION['temporaryFName']); 
 unset($_SESSION['temporaryLName']); 
 unset($_SESSION['userFavTeam']); 
 unset($_SESSION['temporaryPass']); 
 unset($_SESSION['temporaryMail']); 
 
try{
 ob_start();
  require_once("databaseConnection.php");

  $userEmail = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);
  $userFName = filter_input(INPUT_POST, 'fname');
  $userLName = filter_input(INPUT_POST, 'lname');
  $userFTeam = filter_input(INPUT_POST, 'favTeam');
  $userPassword = filter_input(INPUT_POST, 'Password');

  if(strlen($userPassword) < 3)
  {
    $_SESSION['passwordError'] = "The password must be more than 3 characters";
    $_SESSION['temporaryFName'] = $userFName;
    $_SESSION['temporaryLName'] = $userLName;
    $_SESSION['userFavTeam'] = $userFTeam;
    $_SESSION['temporaryPass'] = $userPassword;
    $_SESSION['temporaryMail'] = $userEmail;
    header("Location: UserRegister.php");
    exit();
  }
  $password = password_hash($userPassword, PASSWORD_DEFAULT);
  //$insertQuery = "INSERT INTO playersstats (first_name,last_name,country,age,goals,assists,player_number,team,matches_played,position) VALUES (:fn,:ln,:ct,:age,:gl,:assists,:pn,:team,:mp,:pos);";
  $selectAllUserDataQuery = "INSERT INTO users_table (email,first_name,last_name,fav_team,password)
  VALUES (:email,:fName,:lName,:fTeam,:pWord);";
 

  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  $preparedStatement->bindParam(':fName', $userFName, PDO::PARAM_STR);
  $preparedStatement->bindParam(':lName', $userLName, PDO::PARAM_STR);
  $preparedStatement->bindParam(':fTeam', $userFTeam, PDO::PARAM_STR);
  $preparedStatement->bindParam(':pWord', $password);
  
  $preparedStatement->execute();

  // Check if we have a user and their password is correct
  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);

  
  
  

   // $preparedStatement->closeCursor();
  
  
  $_SESSION['sucess'] = true;
  $selectAllUserDataQuery = "SELECT * FROM users_table WHERE email = :email";
  

  $preparedStatement = $playerStatsDatabase->prepare($selectAllUserDataQuery);
  
  $preparedStatement->bindParam(':email', $userEmail, PDO::PARAM_STR);
  
  
  $preparedStatement->execute();

  // Check if we have a user and their password is correct
  $userinfo = $preparedStatement->fetch(PDO::FETCH_ASSOC);
  $_SESSION['user'] = $userinfo;
    
   
  header("Location:index.php");
} catch(Exception $e)
{
    echo $e->getMessage();
}
?>