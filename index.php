<?php 
    //main page which contain basics information

    //setting the title
    $pageTitle = "Main page";
    //connecting header
    require_once("HeaderWithNavigationMenu.php");
    //connecting the database
    require("databaseConnection.php");
?>
<main>
    <h2>Recent matches:</h2>
    <!-- recent matches section (now contains one match, later more matches will be added) -->
    <div class="d-flex justify-content-center">
        <!-- first team logo -->
        <img src="./Arsenal-mini.png" alt="Arsenal logo">
        <div class="align-self-center" id="result">
            <!-- result -->
            <p> <a href="teamInfoView.php?team=Arsenal">Arsenal</a> 3 : 1 <a href="teamInfoView.php?team=Leicester">Leicester</a></p>
        </div>
        <!-- second team logo -->
        <img src="./Leicester-mini.png" alt="Leicester">
    </div>
</main>

<?php 
    //connecting footer 
    require("footer.php"); 
?>