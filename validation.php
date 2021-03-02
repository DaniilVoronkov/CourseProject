<?php 
     ob_start();
     $pageTitle = "Error page";
    require("HeaderWithNavigationMenu.php");
    require_once("databaseConnection.php");
    $newName = filter_input(INPUT_POST, 'fname');
    $playerIdentifier = filter_input(INPUT_POST, 'uniqueId');
    $last_name = filter_input(INPUT_POST, 'lname'); 
    $playerCountry = filter_input(INPUT_POST, 'country'); 
    $playerTeam = filter_input(INPUT_POST, 'teamName'); 
    $playerNewAge = filter_input(INPUT_POST, 'age');
    $playerNewAmountOfGoals = filter_input(INPUT_POST, 'goals'); 
    $playerNewAmountOfAssists = filter_input(INPUT_POST, 'assists'); 
    $playerNewNumber = filter_input(INPUT_POST, 'playerNumber'); 
    $newMatchesAmount = filter_input(INPUT_POST, 'matchesAmount');
    $emptyFirstNameField  = false;
    $emptyLastNameField = false;
    $emptyCountryField = false;
    $emptyTeamField = false;
    $validFirstName = true;
    $validLastName = true;
    $validCountry = true;
    $validTeam = true;
    $valid = true;
    if (empty($newName))
    {
        echo "<p> First name cant be empty!</p>";
        $emptyFirstNameField = true;
        $valid = false;
    } 
    else if(!(preg_match('/^[a-zA-Z]+$/', $newName))) 
    {
        echo "<p>The first name can contain only letters! </p>";
        $validFirstName = false;
        $valid = false;
    } 
    if (empty($last_name))
    {
        echo "<p> Last name cant be empty!</p>";
        $emptyFirstNameField = true;
        $valid = false;
    } else if(!(preg_match('/^[a-zA-Z]+$/', $last_name))) 
    {
        echo "<p>The last name can contain only letters! </p>";
        $validLastName = false;
        $valid = false;
    }
    if (empty($playerCountry))
    {
        echo "<p> Country name cant be empty!</p>";
        $emptyCountryField = true;
        $valid = false;
    } else if(!(preg_match('/^[a-zA-Z]+$/', $playerCountry))) 
    {
        echo "<p>The country name can contain only letters! </p>";
        $validCountry = false;
        $valid = false;
    }
    if (empty($playerTeam))
    {
        echo "<p> Team name cant be empty!</p>";
        $emptyTeamField = true;
        $valid = false;
    } else if(!(preg_match('/^[a-zA-Z]+$/', $playerTeam))) 
    {
        echo "<p>The team name can contain only letters! </p>";
        $validTeam = false;
        $valid = false;
    }
    if($valid === true)
    {
        
        /* $sql = "UPDATE songs SET first_name = :firstname, last_name = :lastname, genre = :genre, location = :location, email = :email, age = :age, favsong = :favsong WHERE user_id = :user_id;";  */
    /*    $updateQuery = "UPDATE playersstats SET first_name = :firstName, last_name = :lastName, country = :newCountry, age = :age, goals = :goals, assists = :assists, player_number = :playerNewNumber, team = :newTeam, matches_played = :matchesAmount WHERE player_id = :uniqueId;"; */
        $updateQuery = "UPDATE playersstats SET first_name = :firstName, last_name = :lastName, country = :newCountry, age = :age, goals = :goals, assists = :assists WHERE player_id = :uniqueId;";
        $updateStatement = $playerStatsDatabase->prepare($updateQuery);
        
        $updateStatement->bindParam(':firstName', $newName);
        $updateStatement->bindParam(':lastName', $last_name);
        $updateStatement->bindParam(':newCountry', $playerCountry);
        
        $updateStatement->bindParam(':age', $playerNewAge);
        
        $updateStatement->bindParam(':goals', $playerNewAmountOfGoals);
        
        $updateStatement->bindParam(':assists', $playerNewAmountOfAssists);
        /*
        $updateStatement->bindParam(':playerNewNumber', $playerNewNumber);
        
        $updateStatement->bindParam(':newTeam', $playerTeam);
        $updateStatement->bindParam(':matchesAmount', $playerNewNumber); */
        $updateStatement->bindParam(':uniqueId', $playerIdentifier);
        $updateStatement->execute();
        $queryContinued = "UPDATE playersstats SET player_number = :playerNewNumber, team = :newTeam, matches_played = :matchesAmount  WHERE player_id = :uniqueId;";
        $continuedStatement = $playerStatsDatabase->prepare($queryContinued);
        $continuedStatement->bindParam(':playerNewNumber', $playerNewNumber);
        $continuedStatement->bindParam(':newTeam', $playerTeam);
        $continuedStatement->bindParam(':matchesAmount', $newMatchesAmount);
        $continuedStatement->bindParam(':uniqueId', $playerIdentifier);
        $continuedStatement->execute();
        $continuedStatement->closeCursor();
        $url = "teamInfoView.php?team=".$playerTeam;
        
        header("Location:".$url);
        ob_flush();
        
       
    }
    else {
        
        $backUrl = "edit.php?playerId=".$playerIdentifier;
        echo "<a href=".$backUrl.">Go back </a>";
       // header("Location:".$backUrl);
        ob_flush();
       
        
    }
    require("footer.php"); 
?>