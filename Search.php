<?php 
    ob_start();

    
    //connecting database
    require_once("databaseConnection.php");
    //connecting header and setting the new title
    $pageTitle = "Search result";
    require_once("headerWithNavigationMenu.php");
    
    //getting the data from the search field
    $searchInput = filter_input(INPUT_GET, 'siteSearch');
    //setting the input to lower case (for future comparison)
    $lowerCase = strtolower($searchInput);
    //string with the first capital letter
    $upperCase = ucfirst($lowerCase);
    //if the user input is the name of the team - refirect to the team info page
    if($lowerCase === 'arsenal' || $lowerCase === 'leicester')
    {
        header("location: teamInfoView.php?team=".ucfirst($lowerCase));
    }
    //if the field is empty - print the appropriate message
    else if(!(isset($searchInput)) || $searchInput === ''){
        
        //printing the message
        echo "<p> Search field is empty! </p>";
    }
    //if two conditions above are false - do following:
    else {
        
        //query that searches for the information in the table (based on the first name, last name or country)
        $searchQuery = "SELECT * FROM playersstats WHERE first_name LIKE '$upperCase%' OR last_name LIKE '$upperCase%' OR country LIKE '$upperCase%' 
        OR CONCAT(first_name,' ',last_name) LIKE '%$searchInput%' OR CONCAT(last_name,' ',first_name) LIKE '%$searchInput%';";
        $statement = $playerStatsDatabase->prepare($searchQuery);
        $statement->execute();
        //checking if the search returns at least one value
        if($statement->rowCount() >= 1)
        {
            //printing all the data that were found
            $playersInfo = $statement->fetchAll();
            echo "<div> <h3>Team players statistics: </h3></div>";
            echo "<table class='table table-bordered table-hover table-dark'><thead><tr class='table-danger'><td>First Name</td> <td>Last name</td> <td>Country</td> <td> Age</td> <td> Goals</td> <td>Assists</td> <td> Player Number</td> <td>Matches played:</td> <td>Position</td></tr> </thead> <tbody>"; 
            foreach($playersInfo as $record) {
                echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['country'] . "</td><td>". $record['age'] . "</td><td>" . $record['goals'] . "</td><td>" . $record['assists'] . "</td><td>" . $record['player_number'] . "</td> <td>".$record['matches_played']."</td><td>".$record['position'].
                "</td>";
            }
            echo "</tbody></table>";
        }
        //if the search did not return any result - print the appropriate message
        else {
            echo "Could not find anything :(";
        }
    }
    //connecting footer
    require_once("footer.php");
    ob_flush();
?>