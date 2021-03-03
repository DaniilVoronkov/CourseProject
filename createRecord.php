<?php 
    $pageTitle = "Create record!";
    require_once("headerWithNavigationMenu.php");
?>

<main>
    <?php ?>
    <h2>Edit players statistic</h2>
    <form action="insertion.php" method="post">
        <div class="row">
            <div class="col">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" pattern="^[a-zA-Z]+$" title="Letters only">
            </div>
            <div class="col">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" pattern="^[a-zA-Z]+$" title="Letters only">
            </div>
        </div>
        <div class="form-group">
            <label for="country">Country:</label>
            <input type="text" class="form-control" name="country" id="country" pattern="^[a-zA-Z]+$" title="Letters only">
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" class="form-control" name="age" id="age" value = 15 min="15" max="60">
        </div>
        <div class="row">
            <div class="col">
                <label for="goals">Goals:</label>
                <input type="number" class="form-control" name="goals" id="goals" value = 0  min="0" max="999">
            </div>
            <div class="col">
                <label for="assists">Assists:</label>
                <input type="number" class="form-control" name="assists" id="assists" value = 0 min="0" max="999">
            </div>
        </div>
        <div class="form-group">
            <label for="playerNumber">Player Number:</label>
            <input type="number" class="form-control" name="playerNumber" id="playerNumber" value = 1 min="1" max="99">
        </div>
        <div class="form-group">
             <label for="teamName">Team:</label>
                 <select class="form-select" name="teamName" id="teamName">
                    <option value="Arsenal">Arsenal</option>
                    <option value="Leicester">Leicester</option>
                 </select>
            
        </div>
        <div class="form-group">
            <label for="matchesAmount">Matches played:</label>
            <input type="number" class="form-control" name="matchesAmount" id="matchesAmount" value = 0 min="0" max="100">
        </div>
        <div>
            <label for="playerPosition">Position:</label>
            <select class="form-select" name="playerPosition" id="playerPosition">
                <option value="GK">GK</option>
                <option value="DF">DF</option>
                <option value="CM">CM</option>
                <option value="MF">MF</option>
                <option value="F">F</option>
            </select>
        </div>        
        <div class="d-flex justify-content-center">
            <input type="submit" value="Edit!" name="submit" class="btn btn-outline-danger">
        </div>
    </form>
</main>

<?php 
    require_once("footer.php");
?>