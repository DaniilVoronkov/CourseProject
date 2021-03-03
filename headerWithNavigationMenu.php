<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- page title will be generated based on the page title variable -> each page have unique ttile with the same page -->
    <title><?php echo $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- navigation menu (will be same on every page) -->
    <div class="container p-3 mb-2 bg-dark text-white">
        <header>
            <h1 class="align-items-center">Footbal statistics web-site</h1>
            <nav class="nav justify-content-center">
                <a class="nav-link" href="index.php">Main page</a>
                <a class="nav-link" href="">Forum</a>
                <a class="nav-link" href="">News</a>
                <a class="nav-link" href="">Sign Up</a>
                <a class="nav-link" href="">Log in</a>
            </nav>
        </header>