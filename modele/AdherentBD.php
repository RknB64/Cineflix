<?php

class AdherentBD extends DbConnect {

    private $table = "Adherent";

    private $db = self::connexion(); // ?? mettre dans un constructeur peut etre

    // ?? est ce qu'on met chaque element de la base comme ca, pour ensuite simplifier la manipulation des
    // tableau retourné par cette classe ?
    // par example: $adherentListe[0][$nom];
    public $nom = "nom";
    public $prenom = "prenom";
    public $mail = "mail";
    public $password = "password";
    public $points = "points";
    public $date_creation = "date_creation";
    public $compte = "compte";

    public static function getAdherent() {
      $resultat = [];
      try {
        $query = self::$db->prepare("SELECT * FROM " . self::$table);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }
      return $resultat;
    }

    public static function getAdherentById(int $idA) {
    $resultat = [];
      try {
        $query = self::$db->prepare("SELECT * FROM " . self::$table . " WHERE id = :idA");
        $query->bindValue(':idA', $idA, PDO::PARAM_INT);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }
      return $resultat;

    $resultat;
    }

    // TODO retourner vrai ou faux
    public static function supprimerAdherent(int $idA) { 
      try {
        $query = self::$db->prepare("DELETE FROM ".self::$table." WHERE id = :idA");
        $query->bindValue(':idA', $idA, PDO::PARAM_INT);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }

    }


    // TODO avoir le password hache, et determiner le format pour la date, retourner vrai ou faux
    // ?? sinon passer un objet adherent en parametre
    public static function creerAdherent($new_nom, $new_prenom, $new_id_ville, $new_mail, $new_password, $new_points, $new_date_creation, $new_compte) {

      // colones à inserer
      $colones = [self::$nom, self::$prenom, self::$mail, self::$password, self::$points, self::$date_creation, self::$compte];

      // formate les colones à insérer pour la requête et les ?
      $nomColones = implode(', ', $colones);
      $placeholders = implode(', ', array_fill(0, count($colones), '?'));
                
      try {
            $query = self::$db->prepare("INSERT INTO ".self::$table. " (" . $nomColones . ") VALUES (" .$placeholders. ") ");

        $query->execute([$new_nom, $new_prenom, $new_id_ville, $new_mail, $new_password, $new_points, $new_date_creation, $new_compte]);

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }
    }

    // retourner quelque chose ? un objet adherent ?
    public static function modifierAdherent($idA, $new_nom, $new_prenom, $new_id_ville, $new_mail, $new_password, $new_points, $new_date_creation, $new_compte) {

      // colones à inserer
      $colones = [self::$nom, self::$prenom, self::$mail, self::$password, self::$points, self::$date_creation, self::$compte];

      // formate les colones à insérer pour la requête et les ?
      $nomColones = implode(', ', $colones);
      $placeholders = implode(', ', array_fill(0, count($colones), '?'));

      try {
        $query = self::$db->prepare("INSERT INTO ".self::$table." (".$nomColones.") VALUES (".$placeholders.") WHERE id=".$idA);

        $query->execute([$new_nom, $new_prenom, $new_id_ville, $new_mail, $new_password, $new_points, $new_date_creation, $new_compte]);

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }
    }

}
