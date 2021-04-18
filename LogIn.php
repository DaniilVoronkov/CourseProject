<?php 
 require_once("headerWithNavigationMenu.php");
    if(isset($_SESSION['loginError'])) 
    {
        echo "<div class='container d-flex justify-content-center' id='errorMessage'>".$_SESSION['loginError']."</div>";
    }
   
    require_once("databaseConnection.php");
    require_once("../CourseProject/unsettingTemporaryVariables.php");
    
    
?>
<form action="LogInProcess.php" method="post">
        <!-- email input -->
        <div class="row">
            <div class="col">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" name="Email" id="Email" title="Enter Your email!" value="<?php if(isset($_SESSION['tempEmail'])) { echo $_SESSION['tempEmail'];} else {echo "";} ?>">
            </div>
            <!-- password input -->
            <div class="col">
                <label for="userPass">Password:</label>
                <input type="password" class="form-control" name="userPass" id="userPass" value=<?php if(isset($_SESSION['tempPassword'])) { echo $_SESSION['tempPassword'];} else {echo "";} ?>>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <!-- captcha field -->
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                <div class="d-flex justify-content-end align-self-end">
                    <input type="submit" value="Log In!" name="submit" class="btn btn-outline-danger">
                </div>
            </div>
        </div>
        
        
</form>

<?php 
    include_once('configuratingCaptcha.php');
    include_once("footer.php");
?>
        
        