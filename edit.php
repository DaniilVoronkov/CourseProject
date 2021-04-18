<?php
    //page that contains form, that allows us to edit information about player

    //getting the player id
    $exactPlayerId = filter_input(INPUT_GET, 'playerId');
   
    //setting the page title
    $pageTitle = "Edit Player data";
    //connecting header
    require_once("../CourseProject/headerWithNavigationMenu.php");
    //connecting database
    require_once("databaseConnection.php");
    
    //query to retrieve player data (based on player id)
    $playerDataQuery = 'SELECT * FROM playersstats WHERE player_id = :playerId';
    //preparing statement
    $statement = $playerStatsDatabase->prepare($playerDataQuery);
    //binding id parameter
    $statement ->bindParam(":playerId", $exactPlayerId);
    $statement ->execute();
    //storing the result in the variable (we will use it later in the form)
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    $statement->closeCursor();
?>

<main>
    <!-- header for the form -->
    <h2>Edit players statistic</h2>
    <!-- all the data in the form is filled based on the query above -->
    <form action="validation.php" method="post">
        <div class="row">
            <!-- first name input (filled with players first name) -->
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" value=<?php echo $result['first_name']; ?>>
            </div>
            <!-- last name input -->
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" value=<?php echo $result['last_name']; ?>>
            </div>
        </div>
        <!-- country input -->
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" value=<?php echo $result['country'];   ?>>
        </div>
        <!-- age input -->
        <div class="form-group">
            <label for="age">Age:</label>
            <!-- max value is 60 because it's less likely that we will ever see professional soccer player over 60 years old who still plays -->
            <input type="number" class="form-control" name="age" id="age" value=<?php echo $result['age']; ?> min="15" max="60">
        </div>
        <div class="row">
            <!-- goals input (min value = 0, max = 999 (because there is only one player in the history of soccer, who scored more)) -->
            <div class="col">
                <label for="goals">Goals:</label>
                <input type="number" class="form-control" name="goals" id="goals" value=<?php echo $result['goals'];?> min="0" max="999">
            </div>
            <div class="col">
                <label for="assists">Assists:</label>
                <!-- assists input with max value 999 -->
                <input type="number" class="form-control" name="assists" id="assists" value=<?php echo $result['assists']; ?> min="0" max="999">
            </div>
        </div>
        <div class="form-group">
            <label for="playerNumber">Player Number:</label>
            <!-- player number input (max value = 99 because it's maximum possible layer number) -->
            <input type="number" class="form-control" name="playerNumber" id="playerNumber" value=<?php echo $result['player_number']; ?> min="1" max="99">
        </div>
        <div class="form-group">
            <!-- team name -->
            <label for="teamName">Team:</label>
            <input type="text" class="form-control" name="teamName" id="teamName" value=<?php  echo $result['team']; ?>>
        </div>
        <div class="form-group">
            <label for="matchesAmount">Matches played:</label>
            <!-- matches played input -->
            <input type="number" class="form-control" name="matchesAmount" id="matchesAmount" value=<?php  echo $result['matches_played']; ?> min="0" max="999">
        </div>
        <div class='form-group'>
            <!-- position input. taged as readonly, because it's very rare, when player changed position, therefore there is no need to edit this field -->
                <label for='fieldPosition'>Position:</label>
                <input type='text' class='form-control' name='fieldPosition' id='fieldPosition' value= <?php echo $result['position'];?> readonly>
        </div>
        <div class='form-group'>
                <!-- played id. Can only be seen but never be chaged -->
                <label for='uniqueId'>Identifier:</label>
                <input type='text' class='form-control' name='uniqueId' id='uniqueId' value=<?php echo $result['player_id'];?> readonly>
        </div>
        <!-- submit button -->
        <div class="d-flex justify-content-center">
            <input type="submit" value="Edit!" name="submit" class="btn btn-outline-danger">
        </div>
    </form>
</main>

<?php 
    //connecting footer
    require_once("footer.php");
?>