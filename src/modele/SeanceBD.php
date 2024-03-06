
<?php

include './DbConnect.php';
include_once '../controleur/config.php';

class SeanceBD extends DbConnect {

    public const TABLE          = "seance";

    public const ID             = "id";

    public const HORAIRE_DATE   = "horaire_date";
    public const ID_FILM        = "id_film";
    public const ID_SALLE       = "id_salle";


    private static array $colones = [self::HORAIRE_DATE, self::ID_FILM, self::ID_SALLE];


    public static function getSeance() : array 
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
    public static function addSeance($horaire, $id_film, $id_salle) : bool
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
    public static function updateAdherent($id, $horaire_date, $id_film, $id_salle) : bool 
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
