<?php 

if (isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    var_dump($_POST);
    
    if (UserManager::isValidUser($mail, $password)) {
        echo "user is valid";
    } else {
        echo "user is not valid";
    }
   
}

?>
