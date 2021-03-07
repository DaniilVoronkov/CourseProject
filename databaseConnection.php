<?php
//connecting database
try{
    $statsSource="mysql:host=localhost;dbname=players";
    $username="root";
    $password="";
    $playerStatsDatabase = new PDO($statsSource, $username, $password);
} catch(PDOException $e) {
    echo "<p>Something went wrong </p>";
    $error = $e->getMessage();
    echo $error;
}
?>