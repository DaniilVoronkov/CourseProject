<?php
    $exactPlayerId; $exactPlayerId = filter_input(INPUT_GET, 'playerId');
    if($exactPlayerId != -1)
    {
        $pageTitle = "Edit Player data";
    }
    else {
        $pageTitle = "Create new record";
    }
    require_once("headerWithNavigationMenu.php");
    require_once("databaseConnection.php");
    
    if($exactPlayerId != -1)
    {
        $playerDataQuery = 'SELECT * FROM playersstats WHERE player_id = :playerId';
        $statement = $playerStatsDatabase->prepare($playerDataQuery);
        $statement ->bindParam(":playerId", $exactPlayerId);
        $statement ->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
    }
?>

<main>
    <?php ?>
    <h2>Edit players statistic</h2>
    <form action="validation.php?id=".$exactPlayerId method="post">
        <div class="row">
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" value=<?php if($exactPlayerId != -1){ echo $result['first_name'];} ?>>
            </div>
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" value=<?php if($exactPlayerId != -1){ echo $result['last_name'];} ?>>
            </div>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" value=<?php if($exactPlayerId != -1){ echo $result['country']; }  ?>>
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" id="age" value=<?php if($exactPlayerId != -1){ echo $result['age'];} else {echo "15";} ?> min="15" max="60">
        </div>
        <div class="row">
            <div class="col">
                <label for="goals">Goals:</label>
                <input type="number" class="form-control" name="goals" id="goals" value=<?php if($exactPlayerId != -1){ echo $result['goals']; } else {echo "0";}?> min="0" max="999">
            </div>
            <div class="col">
                <label for="assists">Assists:</label>
                <input type="number" class="form-control" name="assists" id="assists" value=<?php if($exactPlayerId != -1){ echo $result['assists'];} else {echo "0";} ?> min="0" max="999">
            </div>
        </div>
        <div class="form-group">
            <label for="playerNumber">Player Number:</label>
            <input type="number" class="form-control" name="playerNumber" id="playerNumber" value=<?php if($exactPlayerId != -1){ echo $result['player_number'];} else {echo "1";} ?> min="1" max="99">
        </div>
        <div class="form-group">
            <label for="teamName">Team:</label>
            <input type="text" class="form-control" name="teamName" id="teamName" value=<?php if($exactPlayerId != -1){ echo $result['team'];} ?>>
        </div>
        <div class="form-group">
            <label for="matchesAmount">Matches played:</label>
            <input type="number" class="form-control" name="matchesAmount" id="matchesAmount" value=<?php if($exactPlayerId != -1){ echo $result['matches_played']; } else {echo "1";} ?> min="0" max="100">
        </div>
        <?php 
            if($exactPlayerId != -1)
            {
                echo "<div class='form-group'>
                <label for='fieldPosition'>Position:</label>
                <input type='text' class='form-control' name='fieldPosition' id='fieldPosition' value=".$result['position']." readonly>
            </div>
            <div class='form-group'>
                <label for='uniqueId'>Identifier:</label>
                <input type='text' class='form-control' name='uniqueId' id='uniqueId' value=".$result['player_id']." readonly>
            </div>";
            }
            else {
                echo 
                "<div class='form-group'>
                    <label for='newPlayerPosition'>Position:</label>
                    <select class='form-select' id='newPlayerPosition' name='newPlayerPosition'>
                        <option value='GK'>GK</option>
                        <option value='DF'>DF</option>
                        <option value='CM'>CM</option>
                        <option value='MF'>MF</option>
                        <option value='F'>F</option>
                    </select>
                 </div>";
            }
        ?>      
        <div class="d-flex justify-content-center">
            <input type="submit" value="Edit!" name="submit" class="btn btn-outline-danger">
        </div>
    </form>
</main>

<?php 
    require_once("footer.php");
?>