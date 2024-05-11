<?php

class connexion
{
    

    public static function authenticate()
    {
        
        // si l'utilisateur est connecté
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && isset($_SESSION['current_adherent'])) {
            
            // si l'utilisateur est connecté , return adherent info
            return $_SESSION['current_adherent'];

        } elseif (isset($_POST['mail']) && isset($_POST['password'])) {
            $mail = $_POST['mail'];
            $password = $_POST['password'];

            list($validMail, $validMdp) = UserManager::isValidUser($mail, $password);

            if ($validMail && $validMdp) {
                $ad = UserManager::isEmailInBD($mail);

                // Set session variables
                $_SESSION['logged_in'] = true;
                $_SESSION['current_adherent'] = $ad;

                //redirct aprér login
                $redirectUrl = $_SESSION['current_url'] ;
                header("Location: $redirectUrl");
                exit();
              

                
            } else {
            
               
                echo "<script>alert('mail ou mot de passe invalide. Veuillez réessayer.');</script>";
               echo "<script>window.location.href = '".$_SERVER['REQUEST_URI']."';</script>";
                exit(); 
                
             }
        } else {
            //si il n'y pas de credentials comme mail , password , redirct à la page d'accueil
            header("Location: ?action=accueil");
            exit();
        }
    }
}
// // appeller method authenticate
connexion::authenticate();
