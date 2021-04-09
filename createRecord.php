<?php 
    //setting the page title 
    $pageTitle = "Create record!";
    //connecting header
    require_once("../CourseProject/headerWithNavigationMenu.php");
    require_once("databaseConnection.php");
?>

<main>
    <!-- header for creation form -->
    <h2>Create player statistic</h2>
    <!-- html handles all the form validation -->
    <form action="insertion.php" method="post">
        <!-- first name input -->
        <div class="row">
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" pattern="^[a-zA-Z]+$" title="Letters only">
            </div>
            <!-- last name input -->
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" pattern="^[a-zA-Z]+$" title="Letters only">
            </div>
        </div>
        <!-- country input -->
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" pattern="^[a-zA-Z]+$" title="Letters only">
        </div>
        <!-- age input -->
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" id="age" value = 15 min="15" max="60">
        </div>
        <!-- goals input -->
        <div class="row">
            <div class="col">
                <label for="goals">Goals:</label>
                <input type="number" class="form-control" name="goals" id="goals" value = 0  min="0" max="999">
            </div>
            <!-- assists input -->
            <div class="col">
                <label for="assists">Assists:</label>
                <input type="number" class="form-control" name="assists" id="assists" value = 0 min="0" max="999">
            </div>
        </div>
        <!-- player number input -->
        <div class="form-group">
            <label for="playerNumber">Player Number:</label>
            <input type="number" class="form-control" name="playerNumber" id="playerNumber" value = 1 min="1" max="99">
        </div>
        <!-- team name (the team can be selected only within the list of teams) -->
        <div class="form-group">
             <label for="teamName">Team:</label>
                 <select class="form-select" name="teamName" id="teamName">
                    <option value="Arsenal">Arsenal</option>
                    <option value="Leicester">Leicester</option>
                 </select>
        </div>
        <!-- matches played amount input -->
        <div class="form-group">
            <label for="matchesAmount">Matches played:</label>
            <input type="number" class="form-control" name="matchesAmount" id="matchesAmount" value = 0 min="0" max="100">
        </div>
        <div>
            <!-- position (user can select from a list of positions) -->
            <label for="playerPosition">Position:</label>
            <select class="form-select" name="playerPosition" id="playerPosition">
                <option value="GK">GK</option>
                <option value="DF">DF</option>
                <option value="CM">CM</option>
                <option value="MF">MF</option>
                <option value="F">F</option>
            </select>
        </div>        

        <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
        <!-- submit button -->
        <div class="d-flex justify-content-center">
            <input type="submit" value="Create!" name="submit" class="btn btn-outline-danger">
        </div>
        <!-- including captcha configurtation (where the public and secret key were defined) -->
        <?php include_once('configuratingCaptcha.php') ?>
        <!-- captcha script -->
        <script src="https://www.google.com/recaptcha/api.js?render=<?= SITEKEY ?>"></script>
        <script>
            grecaptcha.ready(() => {
                grecaptcha.execute("<?= SITEKEY ?>", { action: "Create" })
                .then(token => document.querySelector("#recaptchaResponse").value = token)
                .catch(error => console.error(error));
            });
        </script>
    </form>
</main>



<?php 
    //connecting footer
    require_once("../CourseProject/footer.php");
?>