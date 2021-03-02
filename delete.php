<?php
try{
ob_start();
$playerId = filter_input(INPUT_GET, 'playerId');
require("databaseConnection.php");

//teamInfoView.php?team=Arsenal"
$deleteQuery = "DELETE FROM playersstats WHERE player_id = :player_id;";
$deleteStatement = $playerStatsDatabase->prepare($deleteQuery);
$deleteStatement->bindParam(':player_id', $playerId);
$deleteStatement->execute();
$deleteStatement->closeCursor();

header("Location: sucessMessage.php");
} catch(PDOException $e) {
    echo $e->getMessage();
}
ob_flush();
 ?>