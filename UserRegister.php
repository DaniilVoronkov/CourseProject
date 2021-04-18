<?php


    require_once("headerWithNavigationMenu.php");
    session_start();
    
?>
<form action="registrationValidation.php" method="post">
        <!-- first name input -->
        <div class="row">
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" pattern="^[a-zA-Z]+$" title="Letters only" value=<?php if(isset($_SESSION['temporaryFName'])) { echo $_SESSION['temporaryFName'];} else {echo "";} ?>>
                <?php if(isset($_SESSION['emptyFName'])) { echo "<p class='errorMessage'>".$_SESSION['emptyFName']."</p>";} ?>
            </div>
            <!-- last name input -->
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" pattern="^[a-zA-Z]+$" title="Letters only" value=<?php if(isset($_SESSION['temporaryLName'])) { echo $_SESSION['temporaryLName'];} else {echo "";} ?>>
                <?php if(isset($_SESSION['emptyLName'])) { echo "<p class='errorMessage'>".$_SESSION['emptyLName']."</p>";} ?>
            </div>
        </div>
        <!-- country input -->
        <div class="row">
            <label for="favTeam">Favourite team:</label>
            <input type="text" class="form-control" name="favTeam" id="favTeam" pattern="^[a-zA-Z]+$" title="Letters only" value=<?php if(isset($_SESSION['userFavTeam'])) { echo $_SESSION['userFavTeam'];} else {echo "";} ?>>
        </div>
        <!-- age input -->
        <div class="row">
            <label for="Password">Password:</label>
            <input type="password" class="form-control" name="Password" id="Password" value=<?php if(isset($_SESSION['temporaryPass'])) { echo $_SESSION['temporaryPass'];} else {echo "";} ?>>
            <?php if(isset($_SESSION['passwordError'])) { echo "<p class='errorMessage'>".$_SESSION['passwordError']."</p>";} ?>
        </div>
        <div class="row">
            <label for="Email">Email:</label>
            <input type="email" class="form-control" name="Email" id="Email" value=<?php if(isset($_SESSION['temporaryMail'])) { echo $_SESSION['temporaryMail'];} else {echo "";} ?>>
            <?php if(isset($_SESSION['emptyEmail'])) { echo "<p class='errorMessage'>".$_SESSION['emptyEmail']."</p>";} ?>
        </div>
        <div class="row">
            <div class="col">
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <div class="d-flex justify-content-center">
                     <input type="submit" value="Register!" name="submit" class="btn btn-outline-danger">
                </div>
            </div>
        </div>
        <?php include_once('configuratingCaptcha.php') ?>
     
        
</form>
<?php include_once("footer.php"); ?>