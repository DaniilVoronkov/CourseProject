<?php

    ob_start();
    //getting the player id
    $playerId = filter_input(INPUT_GET, 'playerId');
    //connecting database
    require_once("../CourseProject/headerWithNavigationMenu.php");
    require_once("databaseConnection.php");

    //query that will delete the player from database based on the player id
    $deleteQuery = "DELETE FROM playersstats WHERE player_id = :player_id;";
    //preparing the query
    $deleteStatement = $playerStatsDatabase->prepare($deleteQuery);
    //binding the id parameter
    $deleteStatement->bindParam(':player_id', $playerId);
    $deleteStatement->execute();
    $deleteStatement->closeCursor();
    //redirecting to the sucess message
    header("Location: sucessMessage.php");
    require_once("../CourseProject/footer.php");

    ob_flush();
 ?>