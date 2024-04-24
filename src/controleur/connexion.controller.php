<?php


session_start();

class connexion {
    public static function authenticate() {
        // si l'utilisateur est connecté
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['user_name'])) {
            // If the user is logged in, return the username from session
            // si l'utilisateur est connecté , return user name
            return $_SESSION['user_name'];
        } elseif (isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = $_POST['mail'];
            $password = $_POST['password'];
        
            list($validMail, $validMdp) = UserManager::isValidUser($mail, $password);
        
            if ($validMail && $validMdp) {
                $ad = UserManager::isEmailInBD($mail);
                
                // Set session variables
                $_SESSION['logged_in'] = true; 
                $_SESSION['user_mail'] = $mail;
                $_SESSION['user_name'] = $ad->nom; 
                
              
                // redirect dans la page d'accueil , ici il va passer les valeurs de session pour la page d'accueil
                header("Location: $?action=accueil");
                exit();
                
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

// une qaustion pour $currentPage
// $currentURL = $_SERVER['REQUEST_URI'];
// connexion::authenticate($currentURL);