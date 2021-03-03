<?php
    ob_start();
    //connecting the header
    require("HeaderWithNavigationMenu.php");
    //connecting the database
    require_once("databaseConnection.php");

    //getting the data from the user
    $name = filter_input(INPUT_POST, 'fname');
    $last_name = filter_input(INPUT_POST, 'lname'); 
    $playerCountry = filter_input(INPUT_POST, 'country'); 
    $playerTeam = filter_input(INPUT_POST, 'teamName'); 
    $playerAge = filter_input(INPUT_POST, 'age');
    $playeewAmountOfGoals = filter_input(INPUT_POST, 'goals'); 
    $playerAmountOfAssists = filter_input(INPUT_POST, 'assists'); 
    $playerNumber = filter_input(INPUT_POST, 'playerNumber'); 
    $matchesAmount = filter_input(INPUT_POST, 'matchesAmount');
    $position = filter_input(INPUT_POST, 'playerPosition');

    //query that inserts data from the user into the database
    $insertQuery = "INSERT INTO playersstats (first_name,last_name,country,age,goals,assists,player_number,team,matches_played,position) VALUES (:fn,:ln,:ct,:age,:gl,:assists,:pn,:team,:mp,:pos);";
    $insertStatement = $playerStatsDatabase->prepare($insertQuery);
    //binding all parameters
    $insertStatement->bindParam(':fn', $name);
    $insertStatement->bindParam(':ln', $last_name);
    $insertStatement->bindParam(':ct', $playerCountry);
    $insertStatement->bindParam(':age', $playerAge);
    $insertStatement->bindParam(':gl', $playeewAmountOfGoals);
    $insertStatement->bindParam(':assists', $playerAmountOfAssists);
    $insertStatement->bindParam(':pn', $playerNumber);
    $insertStatement->bindParam(':team', $playerTeam);
    $insertStatement->bindParam(':mp', $matchesAmount);
    $insertStatement->bindParam(':pos', $position);
    $insertStatement->execute();
    //closing the database connection
    $insertStatement->closeCursor();
    //redirecting to the team page
    $url = "teamInfoView.php?team=".$playerTeam;
    header('Location:'.$url);
    ob_flush();

?>