<?php
     //page that shows the information about team and its current players
     
     //getting the team name (based on that we will generate the info)
     $teamName = filter_input(INPUT_GET, 'team');
     //setting the page title
     $pageTitle = $teamName;
     //connecting the header
     require_once("../CourseProject/headerWithNavigationMenu.php");
     //connecting the database
     require_once("databaseConnection.php");
     
     //query that selects all the information about team based on the team name
     $sqlTeamInfoQuery = 'SELECT * FROM teamdata WHERE team = :team;';
     //preparing the statement
     $teamStatement = $playerStatsDatabase->prepare($sqlTeamInfoQuery);
     //binding the team name parameter
     $teamStatement->bindParam(':team', $teamName);
     $teamStatement->execute();
     //storing the query result in the database
     $teamInfo = $teamStatement->fetch(PDO::FETCH_ASSOC);
     
     //displaying team info
     
        echo "<div class='justify-content-center'> 
                <div class='d-flex justify-content-center'><img src='./".$teamName."-mini.png' alt='Arsenal logo'></div>";
        echo "<p><b>Name:</b> ".$teamInfo['team']."</p>";
        echo "<p><b>Country:</b> ".$teamInfo['country']."</p>";
        echo "<p><b>Town:</b> ".$teamInfo['town']."</p>";
        echo "<p><b> Description: </b>".$teamInfo['description']."</p>";
        echo "</div>";
    
     //selecting all the players information (based on the team name) and order the result by player number
     $sqlPlayersQuery = 'SELECT * FROM playersstats WHERE team = :team ORDER BY player_number;';
     $statement = $playerStatsDatabase->prepare($sqlPlayersQuery);
     $statement->bindParam(':team', $teamName);
     $statement->execute();
     //storing the result in the variable
     $playersInfo = $statement->fetchAll();
     //displaying the result in the table
     if(isset($_SESSION['user']))
    {
     echo "<div> <h3>Team players statistics: </h3></div>";
     echo "<table class='table table-bordered table-hover table-dark'><thead><tr class='table-danger'><td>First Name</td> <td>Last name</td> <td>Country</td> <td> Age</td> <td> Goals</td> <td>Assists</td> <td> Player Number</td> <td>Matches played:</td> <td>Position</td> <td><a href='createRecord.php'>Create record</td> </tr> </thead> <tbody>"; 
    } else {
        echo "<div> <h3>Team players statistics: </h3></div>";
     echo "<table class='table table-bordered table-hover table-dark'><thead><tr class='table-danger'><td>First Name</td> <td>Last name</td> <td>Country</td> <td> Age</td> <td> Goals</td> <td>Assists</td> <td> Player Number</td> <td>Matches played:</td> <td>Position</td> </tr> </thead> <tbody>"; 
    }
    //using foreach because we have many players in the team
    foreach($playersInfo as $record) {
        if(isset($_SESSION['user']))
    {
        echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['country'] . "</td><td>". $record['age'] . "</td><td>" . $record['goals'] . "</td><td>" . $record['assists'] . "</td><td>" . $record['player_number'] . "</td> <td>".$record['matches_played']."</td><td>".$record['position'].
        "</td><td><a href='delete.php?playerId=".$record['player_id']."'> Delete Record </a>
        </td>
        <td><a href='edit.php?playerId=".$record['player_id']. "'> Edit Info </a></td>
        </tr>"; 
    } else 
    {
        echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['country'] . "</td><td>". $record['age'] . "</td><td>" . $record['goals'] . "</td><td>" . $record['assists'] . "</td><td>" . $record['player_number'] . "</td> <td>".$record['matches_played']."</td><td>".$record['position'].
        "</td>
        
        </tr>"; 
    }
    } 
    //end of the table
    echo "</tbody></table>";
    //closing the database connection
    $statement->closeCursor();
    //connecting footer
    require_once("footer.php");
?>