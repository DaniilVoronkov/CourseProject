<?php
//connecting database
try{
    $statsSource="mysql:host=172.31.22.43;dbname=Daniil200473393";
    $username="Daniil200473393";
    $password="sVFQCgBL2W";
    $playerStatsDatabase = new PDO($statsSource, $username, $password);
} catch(PDOException $e) {
    echo "<p>Something went wrong </p>";
    $error = $e->getMessage();
    echo $error;
}
?>