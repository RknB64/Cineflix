<?php
abstract class DbConnect {


	protected static function connexion() {
		
		try {
            $dsn = 'mysql:host=' . DB_HOST .';dbname=' . DB_DATABASE;

            $conn = new PDO($dsn, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die("Erreur de connexion PDO ");
        }		
	  }
	
}
