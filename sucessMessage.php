<?php
    //page that shows sucess message when data is deleted from the table
    $pageTitle = "Sucess!";
    //including header
    require_once('headerWithNavigationMenu.php');
    echo "<h2>The record was deleted Sucessfully</h2>";
    //link that redirect to the main page
    echo "<a href='index.php'>To the main menu!</a>";
    //including footer
    require_once('footer.php');
?>