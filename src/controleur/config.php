<?php


 define('DB_USERNAME', 'root');
 define('DB_PASSWORD', 'root@sio');
 define('DB_DATABASE', 'db_cineflix');
 
// use mariadb for docker, and local host for vm
 define('DB_HOST', 'mariadb');
// define('DB_HOST', 'localhost');

define("RACINE", dirname(__DIR__));


define('DB_FILM_TABLE', 'film');
define('DB_TARIF_TABLE', 'tarif');
define('DB_VILLE_TABLE', 'ville');
define('DB_STREAM_TABLES' ,  'stream');
