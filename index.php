<?php 
    $pageTitle = "Main page";
    require("HeaderWithNavigationMenu.php");
    require("databaseConnection.php");
?>
<main>
    <h2>Recent matches:</h2>
    <div class="d-flex justify-content-center">
        <img src="./Arsenal-mini.png" alt="Arsenal logo">
        <div class="align-self-center" id="result">
            <p> <a href="teamInfoView.php?team=Arsenal">Arsenal</a> 3 : 1 <a href="teamInfoView.php?team=Leicester">Leicester</a></p>
        </div>
        <img src="./Leicester-mini.png" alt="Leicester">
    </div>
</main>

<?php 
    require("footer.php"); 
?>