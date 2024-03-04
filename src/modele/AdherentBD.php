<?php

/* include_once './DbConnect.php'; */
/* include_once '../controleur/config.php'; */

class AdherentBD extends DbConnect {

    private static $table = "adherent";

    public const ID             = "id";
    public const NOM            = "nom";
    public const PRENOM         = "prenom";
    public const MAIL           = "mail";
    public const ID_VILLE        = "id_ville";
    public const PASSWORD       = "password";
    public const POINTS         = "points";
    public const DATE_CREATION   = "date_creation";
    public const COMPTE         = "compte";

    private static $columns = array(
        self::ID,
        self::NOM,
        self::PRENOM,
        self::MAIL,
        self::ID_VILLE,
        self::PASSWORD,
        self::POINTS,
        self::DATE_CREATION,
        self::COMPTE
    );


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



    // TODO avoir le password hache, et determiner le format pour la date
    // TODO gérer les clef inexistante dans l'arry param 
    public static function addAdherent(array $adh) : bool
    {
      
      $db   = self::connexion();
      $isAdded  = true;

      // colones à inserer
      $colones = self::$columns;

      // formate les colones à insérer pour la requête et les ?
      $nomColones = implode(', ', $colones);
      $placeholders = implode(', ', array_fill(0, count($colones), '?'));
                
      try {
            $query = $db->prepare("INSERT INTO ".self::$table. " (" . $nomColones . ") 
                                        VALUES (" .$placeholders. ") ");

            $isAdded = $query->execute($adh);  // TODO map les valeurs de $columns aux clefs de $adh pour avoir le bon ordre

      } catch (PDOException $e) {
          die("Erreur !: " . $e->getMessage()); // TODO enlever les die()
          $isAdded = false;
      }

      $db = null;
      return $isAdded;
    }



    // retourner un objet adherent ?
    public static function updateAdherent($idA, $nom, $prenom, $idVille, $mail, 
                                          $password, $points, $dateCreation, $compte) : bool 
    {

      $db = self::connexion();
      $res = true;
      $args = func_get_args();

      // colones à inserer
      $colones = [self::$nom, self::$prenom, self::$idVille, self::$mail, self::$password, self::$points, 
                  self::$dateCreation, self::$compte];

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
