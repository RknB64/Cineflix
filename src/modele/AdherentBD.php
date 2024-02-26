<?php

include './DbConnect.php';
include_once '../controleur/config.php';

class AdherentBD extends DbConnect {

    private static $table = "adherent";

    public static $id               = "id";
    public static $nom              = "nom";
    public static $prenom           = "prenom";
    public static $mail             = "mail";
    public static $id_ville         = "id_ville";
    public static $password         = "password";
    public static $points           = "points";
    public static $date_creation    = "date_creation";
    public static $compte           = "compte";



    public static function getAdherent() : array 
    {

      $db = self::connexion();
      $resultat=null;

      try {
        $query = $db->prepare("SELECT * FROM " . self::$table);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);

        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }

      $db = null;
      return $resultat;
    }



    public static function getAdherentById(int $idA) : array 
    {
      $resultat=null;

      $db = self::connexion();

      try {
        $query = $db->prepare("SELECT * FROM " . self::$table . " WHERE id = :idA");
        $query->bindValue(':idA', $idA, PDO::PARAM_INT);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }

      $db = null;

      return $resultat;
    }



    public static function deleteAdherent(int $idA): bool 
    {
      
      $db = self::connexion();
      $res = true;

      try {
        $query = $db->prepare("DELETE FROM ".self::$table." WHERE id = :idA");
        $query->bindValue(':idA', $idA, PDO::PARAM_INT);
        $res = $query->execute();

      } catch (PDOException $e) {
          die("Erreur !: " . $e->getMessage());
          $res = false;
      }

      $db = null;

      return $res;
    }



    // TODO avoir le password hache, et determiner le format pour la date, retourner vrai ou faux
    // ?? sinon passer un objet adherent en parametre
    public static function addAdherent($nom, $prenom, $id_ville, $mail, 
                                        $password, $points, $date_creation, $compte) : bool
    {
      
      $db   = self::connexion();
      $res  = true;
      $args = func_get_args(); // func_get_arg crée une array avec les arg

      // colones à inserer
      $colones = [self::$nom, self::$prenom, self::$id_ville, self::$mail, self::$password, 
                  self::$points, self::$date_creation, self::$compte];

      // formate les colones à insérer pour la requête et les ?
      $nomColones = implode(', ', $colones);
      $placeholders = implode(', ', array_fill(0, count($colones), '?'));
                
      try {
            $query = $db->prepare("INSERT INTO ".self::$table. " (" . $nomColones . ") 
                                        VALUES (" .$placeholders. ") ");

            $res = $query->execute($args); 

      } catch (PDOException $e) {
          die("Erreur !: " . $e->getMessage()); // TODO enlever les die()
          $res = false;
      }

      $db = null;
      return $res;
    }



    // retourner un objet adherent ?
    public static function updateAdherent($idA, $nom, $prenom, $id_ville, $mail, 
                                          $password, $points, $date_creation, $compte) : bool 
    {

      $db = self::connexion();
      $res = true;
      $args = func_get_args();

      // colones à inserer
      $colones = [self::$nom, self::$prenom, self::$id_ville, self::$mail, self::$password, self::$points, 
                  self::$date_creation, self::$compte];

      // formate les colones à insérer pour la requête et les ?
      $colonnes = implode('= ? , ', $colones) . "= ? ";

      try {
        $query = $db->prepare("UPDATE ".self::$table." SET ".$colonnes." WHERE id=".$idA);

        array_shift($args); // on shift l'array des arguments pour enlever l'id
        $res = $query->execute($args);

      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
          $res = false;
      }

      $db = null;
      return $res;
    }

}
