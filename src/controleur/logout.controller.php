<?php

 class logout
{
    public function logoutUser()   {

        session_start();
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {

            session_destroy();
           
        }
        //redirect dans la page d'accueil
        header("Location: ?action=accueil");
        exit();
    }
    
}

$logout = new logout();
$logout->logoutUser();


?>