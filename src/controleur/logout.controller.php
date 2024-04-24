<?php

 class logout
{
    public function logoutUser()   {

        session_start();
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {

            session_destroy();
           
        }

    }
    
}

$logout = new logout();
$logout->logoutUser();


?>