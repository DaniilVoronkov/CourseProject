<?php
//script that unsets temporary variables (in case if user decided to switch to another page instead of trying to login/register again)
    unset($_SESSION['passwordError']);
    unset($_SESSION['temporaryFName']); 
    unset($_SESSION['temporaryLName']); 
    unset($_SESSION['userFavTeam']); 
    unset($_SESSION['temporaryPass']); 
    unset($_SESSION['temporaryMail']); 
    unset($_SESSION['emptyEmail']); 
    unset($_SESSION['emptyFName']); 
    unset($_SESSION['emptyLName']); 
    
?>