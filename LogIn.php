<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['loginError'])) 
    {
        echo "<div class='container d-flex justify-content-center' id='errorMessage'>".$_SESSION['loginError']."</div>";
    }
    require_once("headerWithNavigationMenu.php");
    require_once("databaseConnection.php");
    require_once("../CourseProject/unsettingTemporaryVariables.php");
    print_r($_SESSION);
    
?>
<form action="LogInProcess.php" method="post">
        <!-- email input -->
        <div class="row">
            <div class="col">
                <label for="Email">Email:</label>
                <input type="email" class="form-control" name="Email" id="Email" title="Enter Your email!" value="<?php if(isset($_SESSION['user']['email'])) { echo $_SESSION['user']['email'];} else {echo "";} ?>">
            </div>
            <!-- password input -->
            <div class="col">
                <label for="userPass">Password:</label>
                <input type="password" class="form-control" name="userPass" id="userPass" value=<?php if(isset($_SESSION['password'])) { echo $_SESSION['password'];} else {echo "";} ?>>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <input type="submit" value="Log In!" name="submit" class="btn btn-outline-danger">
            </div>
        </div>
</form>

<?php 
    include_once("footer.php");
    
   // session_unset();
?>
        
        