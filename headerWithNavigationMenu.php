<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page title will be generated based on the page title variable -> each page have unique ttile with the same page -->
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Karantina&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">

   
</head>
<body>
    
    <!-- navigation menu (will be same on every page) -->
    <div class="container p-3 mb-2 bg-dark text-white">
        <header>
            <div class="d-flex justify-content-start">
            <?php
                        session_start();
                        if($_SESSION['sucess'] === true) {
                            
                            echo "<a href='../CourseProject/Logout.php'>Logout</a>";
                            echo "<div class='container'>User #".$_SESSION['user']['id']." ".$_SESSION['user']['email']."</div>";
                        }
                        else 
                        {
                            
                            echo "<div class='container'>
                                    <a href='../CourseProject/LogIn.php'>Log in</a>
                                    <a href='../CourseProject/UserRegister.php'>Register</a>
                                  </div>";
                           
                        }
                        
                    ?>
            </div>
            <div class="d-flex justify-content-end">
                    
                    <form action="../CourseProject/Search.php" class="d-flex justify-content-end">
                        <div id="searchNameField" class="form-group">
                            <label for="siteSearch">Search:</label>
                            <input class="form-control" type="search" id="siteSearch" name="siteSearch">
                            <div class="d-flex align-items-center flex-column bd-highlight mb-3">
                                <input type="submit" value="Search!" name="submit" class="btn btn-outline-danger">
                            </div>
                        </div>
                    </form>
                
            </div>
            <h1 class="align-items-center">Footbal statistics web-site</h1>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="index.php">Main page</a>
                <a class="nav-link" href="">Forum</a>
                <a class="nav-link" href="">News</a>
                <a class="nav-link" href="">Sign Up</a>
                <a class="nav-link" href="">Log in</a>
            </nav>
        </header>