<?php
     $teamName = filter_input(INPUT_GET, 'team');
     $pageTitle = $teamName;
     require("HeaderWithNavigationMenu.php");
     require("databaseConnection.php");
     
     $sqlTeamInfoQuery = 'SELECT * FROM teamdata WHERE team = :team;';
     $teamStatement = $playerStatsDatabase->prepare($sqlTeamInfoQuery);
     $teamStatement->bindParam(':team', $teamName);
     $teamStatement->execute();
     $teamInfo = $teamStatement->fetch(PDO::FETCH_ASSOC);
     echo "<div class='justify-content-center'> 
            <div class='d-flex justify-content-center'><img src='./".$teamName."-mini.png' alt='Arsenal logo'></div>";
     echo "<p><b>Name:</b> ".$teamInfo['team']."</p>";
     echo "<p><b>Country:</b> ".$teamInfo['country']."</p>";
     echo "<p><b>Town:</b> ".$teamInfo['town']."</p>";
     echo "<p><b> Description: </b>".$teamInfo['description']."</p>";
     echo "</div>";
     $sqlPlayersQuery = 'SELECT * FROM playersstats WHERE team = :team ORDER BY player_number;';
     $statement = $playerStatsDatabase->prepare($sqlPlayersQuery);
     $statement->bindParam(':team', $teamName);
     $statement->execute();
     
     $playersInfo = $statement->fetchAll();
     echo "<div> <h3>Team players statistics: </h3></div>";
     echo "<table class='table table-bordered table-hover table-dark'><thead><tr class='table-danger'><td>First Name</td> <td>Last name</td> <td>Country</td> <td> Age</td> <td> Goals</td> <td>Assists</td> <td> Player Number</td> <td>Matches played:</td> <td><a href='create.php'>Create record</td> </tr> </thead> <tbody>"; 

    foreach($playersInfo as $record) {
        echo "<tr><td>" . $record['first_name'] . "</td><td>" . $record['last_name'] . "</td><td>" . $record['country'] . "</td><td>". $record['age'] . "</td><td>" . $record['goals'] . "</td><td>" . $record['assists'] . "</td><td>" . $record['player_number'] . "</td> <td>".$record['matches_played'].
        "<td><a href='delete.php?playerId=".$record['player_id']."'> Delete Record </a>
        </td>
        <td><a href='edit.php?playerId=".$record['player_id']. "'> Edit Info </a></td>
        </tr>"; 
    } 
    echo "</tbody></table>";
    $statement->closeCursor();
    require_once("footer.php");
?>