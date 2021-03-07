<?php 
    ob_start();
    //setting the page title
    $pageTitle = "Error page";
    //connecting header
    require("../CourseProject/headerWithNavigationMenu.php");
    //connecting database
    require_once("databaseConnection.php");
    //gather data for validation and storing it in appropriate variables
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

    //markers for validation
    $emptyFirstNameField  = false;
    $emptyLastNameField = false;
    $emptyCountryField = false;
    $emptyTeamField = false;
    $validFirstName = true;
    $validLastName = true;
    $validCountry = true;
    $validTeam = true;
    //final marker (that will decide if the data is valid or error message should be displayed)
    $valid = true;
    //checking if the first name is empty. If yes - show appropriate message
    if (empty($newName))
    {
        echo "<p> First name cant be empty!</p>";
        $emptyFirstNameField = true;
        $valid = false;
    } 
    //checking if the first name contains only letters
    else if(!(preg_match('/^[a-zA-Z]+$/', $newName))) 
    {
        echo "<p>The first name can contain only letters! </p>";
        $validFirstName = false;
        $valid = false;
    } 
    //checking if the last name is empty
    if (empty($last_name))
    {
        echo "<p> Last name cant be empty!</p>";
        $emptyFirstNameField = true;
        $valid = false;
    }
    //checking if the last name contains only letters
    else if(!(preg_match('/^[a-zA-Z]+$/', $last_name))) 
    {
        echo "<p>The last name can contain only letters! </p>";
        $validLastName = false;
        $valid = false;
    }
    //checking if the player country is empty
    if (empty($playerCountry))
    {
        echo "<p> Country name cant be empty!</p>";
        $emptyCountryField = true;
        $valid = false;
    } 
    //checking if the country name contains only letters
    else if(!(preg_match('/^[a-zA-Z]+$/', $playerCountry))) 
    {
        echo "<p>The country name can contain only letters! </p>";
        $validCountry = false;
        $valid = false;
    }
    //checking if the player team is empty
    if (empty($playerTeam))
    {
        echo "<p> Team name cant be empty!</p>";
        $emptyTeamField = true;
        $valid = false;
    } 
    //checking if the player team contains only letters
    else if(!(preg_match('/^[a-zA-Z]+$/', $playerTeam))) 
    {
        echo "<p>The team name can contain only letters! </p>";
        $validTeam = false;
        $valid = false;
    }
    //if data passed all the previous validations - start the process of changing the data
    if($valid === true)
    {
        //first part of the update query
        $updateQuery = "UPDATE playersstats SET first_name = :firstName, last_name = :lastName, country = :newCountry, 
        age = :age, goals = :goals, assists = :assists, player_number = :playerNewNumber,
         team = :newTeam, matches_played = :matchesAmount WHERE player_id = :uniqueId;";
        $updateStatement = $playerStatsDatabase->prepare($updateQuery);
        //binding parameters for the first part of the query
        $updateStatement->bindParam(':firstName', $newName);
        $updateStatement->bindParam(':lastName', $last_name);
        $updateStatement->bindParam(':newCountry', $playerCountry);
        $updateStatement->bindParam(':age', $playerNewAge);
        $updateStatement->bindParam(':goals', $playerNewAmountOfGoals);
        $updateStatement->bindParam(':assists', $playerNewAmountOfAssists);
        $updateStatement->bindParam(':uniqueId', $playerIdentifier);
        $updateStatement->bindParam(':playerNewNumber', $playerNewNumber);
        $updateStatement->bindParam(':newTeam', $playerTeam);
        $updateStatement->bindParam(':matchesAmount', $newMatchesAmount);
        $updateStatement->bindParam(':uniqueId', $playerIdentifier);
        $updateStatement->execute();
        //closing the database connection
        $updateStatement->closeCursor();
        //redirecting to the team information page (based on the current player team)
        $url = "teamInfoView.php?team=".$playerTeam;
        header("Location:".$url);
        ob_flush();
    }
    //if the data did not pass the validation - do following:
    else 
    {
            //printh the link that will redirect back to the editing process form
            $backUrl = "edit.php?playerId=".$playerIdentifier;
            echo "<a href=".$backUrl.">Go back </a>";
            ob_flush();       
    }
    //connecting footer
    require("footer.php"); 
?>