<?php

class LogoutController
{
    public function __construct() {
        $this->logoutUser();
    }

    public function logoutUser()
    {

        // session_start();
        if (isset($_GET['action']) && $_GET['action'] === 'logout') {

            session_destroy();
        }
        //redirect dans la page d'accueil
        header("Location: ?action=accueil");
        exit();
    }
}
