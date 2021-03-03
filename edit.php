<?php
    $exactPlayerId; $exactPlayerId = filter_input(INPUT_GET, 'playerId');
   
    $pageTitle = "Edit Player data";
    require_once("headerWithNavigationMenu.php");
    require_once("databaseConnection.php");
    
    
        $playerDataQuery = 'SELECT * FROM playersstats WHERE player_id = :playerId';
        $statement = $playerStatsDatabase->prepare($playerDataQuery);
        $statement ->bindParam(":playerId", $exactPlayerId);
        $statement ->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
?>

<main>
    <?php ?>
    <h2>Edit players statistic</h2>
    <form action="validation.php" method="post">
        <div class="row">
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" value=<?php echo $result['first_name']; ?>>
            </div>
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" value=<?php echo $result['last_name']; ?>>
            </div>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" value=<?php echo $result['country'];   ?>>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" id="age" value=<?php echo $result['age']; ?> min="15" max="60">
        </div>
        <div class="row">
            <div class="col">
                <label for="goals">Goals:</label>
                <input type="number" class="form-control" name="goals" id="goals" value=<?php echo $result['goals'];?> min="0" max="999">
            </div>
            <div class="col">
                <label for="assists">Assists:</label>
                <input type="number" class="form-control" name="assists" id="assists" value=<?php echo $result['assists']; ?> min="0" max="999">
            </div>
        </div>
        <div class="form-group">
            <label for="playerNumber">Player Number:</label>
            <input type="number" class="form-control" name="playerNumber" id="playerNumber" value=<?php echo $result['player_number']; ?> min="1" max="99">
        </div>
        <div class="form-group">
            <label for="teamName">Team:</label>
            <input type="text" class="form-control" name="teamName" id="teamName" value=<?php  echo $result['team']; ?>>
        </div>
        <div class="form-group">
            <label for="matchesAmount">Matches played:</label>
            <input type="number" class="form-control" name="matchesAmount" id="matchesAmount" value=<?php  echo $result['matches_played']; ?> min="0" max="100">
        </div>
        <div class='form-group'>
                <label for='fieldPosition'>Position:</label>
                <input type='text' class='form-control' name='fieldPosition' id='fieldPosition' value= <?php echo $result['position'];?> readonly>
        </div>
        <div  class='form-group'>
                <label for='uniqueId'>Identifier:</label>
                <input type='text' class='form-control' name='uniqueId' id='uniqueId' value=<?php echo $result['player_id'];?> readonly>
        </div>
            
        <div class="d-flex justify-content-center">
            <input type="submit" value="Edit!" name="submit" class="btn btn-outline-danger">
        </div>
    </form>
</main>

<?php 
    require_once("footer.php");
?>