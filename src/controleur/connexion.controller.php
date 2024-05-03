<?php
session_start();
// session pour la connexion A CLASSER ! 
 if(isset($_GET['action']) && $_GET['action'] !== 'connexion') {
    $_SESSION['current_action'] = $_GET['action'];
    // Optionally, you can store the full URL for more precise redirection
    $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
 }

class connexion
{    
    
    public static function authenticate()
    {   
        // echo '<pre>';
        // print_r($_SESSION);
        // si l'utilisateur est connecté
        //echo $currentUrl;
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['current_adherent'])) {
           
            // si l'utilisateur est connecté , return user name
            return $_SESSION['current_adherent'];

        } elseif (isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            list($validMail, $validMdp) = UserManager::isValidUser($mail, $password);

            if ($validMail && $validMdp) {
                $ad = UserManager::isEmailInBD($mail);
                // echo '<pre>';
                // print_r($_SESSION);
                // print_r($ad);
                // Set session variables
                $_SESSION['logged_in'] = true;
                $_SESSION['current_adherent'] = $ad;
               
                $redirectAction = isset($_SESSION['current_action']) ? $_SESSION['current_action'] : 'accueil';
                header("Location: /?action=$redirectAction");
                exit();
                
                // return $ad;
            } else {
                // verfication Authentication  si failed, return false
                return false;
            }
        } else {
            //si il n'y pas de credentials comme mail , password , return false
            return false;
        }
    }
}
// appeller method authenticate
connexion::authenticate();