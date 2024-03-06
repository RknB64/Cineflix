<?php

include './DbConnect.php';
include_once '../controleur/config.php';

class AdherentBD extends DbConnect {

    public const TABLE          = "adherent";

    public const ID             = "id";

    public const NOM            = "nom";
    public const PRENOM         = "prenom";
    public const MAIL           = "mail";
    public const ID_VILLE       = "id_ville";
    public const PASSWORD       = "password";
    public const POINTS         = "points";
    public const DATE_CREATION  = "date_creation";
    public const COMPTE         = "compte";

    private static array $colones = [self::NOM, self::PRENOM, self::ID_VILLE, self::MAIL, self::PASSWORD, 
                              self::POINTS, self::DATE_CREATION, self::COMPTE];


    public static function getAdherents() : array 
    {

      $db = self::connexion();
      $resultat=null;

      try {
        $query = $db->prepare("SELECT * FROM " . self::TABLE);
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



    public static function getAdherentById(int $id) : array 
    {
      $resultat=null;

      $db = self::connexion();

      try {
        $query = $db->prepare("SELECT * FROM " . self::TABLE . " WHERE ".self::ID." = :idA");
        $query->bindValue(':idA', $id, PDO::PARAM_INT);
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



    public static function deleteAdherent(int $id): bool 
    {
      
      $db = self::connexion();
      $res = true;

      try {
        $query = $db->prepare("DELETE FROM ".self::TABLE." WHERE ".self::ID." = :idA");
        $query->bindValue(':idA', $id, PDO::PARAM_INT);
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


      // formate les colones à insérer pour la requête et les ?
      $nomColones = implode(', ', self::$colones);
      $placeholders = implode(', ', array_fill(0, count(self::$colones), '?'));
                
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
    public static function updateAdherent($id, $nom, $prenom, $id_ville, $mail, 
                                          $password, $points, $date_creation, $compte) : bool 
    {

      $db = self::connexion();
      $res = true;
      $args = func_get_args();


      // formate les colones à insérer pour la requête et les ?
      $colonnes = implode('= ? , ', self::$colones) . "= ? ";

      try {
        $query = $db->prepare("UPDATE ".self::$table." SET ".$colonnes." WHERE ".self::ID."=".$id);

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
