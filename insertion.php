<?php
    ob_start();
    require("HeaderWithNavigationMenu.php");
    require_once("databaseConnection.php");
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

    $insertQuery = "INSERT INTO playersstats (first_name,last_name,country,age,goals,assists,player_number,team,matches_played,position) VALUES (:fn,:ln,:ct,:age,:gl,:assists,:pn,:team,:mp,:pos);";
    $insertStatement = $playerStatsDatabase->prepare($insertQuery);
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

    $url = "teamInfoView.php?team=".$playerTeam;
    header('Location:'.$url);
    ob_flush();

?>