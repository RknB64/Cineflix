<?php


 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', 'root@sio');
 define('DB_DATABASE', 'db_cineflix');
 
// use mariadb for docker, and local host for vm
 define('DB_HOST', 'mariadb');
 /* define('DB_HOST', 'localhost'); */

define("RACINE", dirname(__DIR__));

//filmParams
define('DB_FILM_TABLE', 'film');
?>
