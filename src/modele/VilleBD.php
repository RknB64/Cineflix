<?php

include_once("./controleur/config.php");
require_once "./modele/DbConnect.php";

class VilleBD extends DbConnect {


    //CREATE

    public static function addVille($table, $id, $nom, $region) {
      try {
        $db = self::connexion();
        $query = $db->prepare("INSERT INTO $table (id, nom, region)
                              VALUES (:id, :nom, :region)");

        //Pour les PDO::PARAM, il semble n'exister que INT et STR
        // A tester si l'enum region passe en STR
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':region', $region, PDO::PARAM_STR);
        $query->execute();

      } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
      }

      $query->closeCursor();
    }

  

  
    public static function getVilles($table) {

      $resultat=null;
      try {
        $db = self::connexion();
        $query = $db->prepare("SELECT * FROM $table");
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }
      $query->closeCursor();
      return $resultat;
    }


  //UPDATE

  public static function updateVille($table, $id, $nom, $region) {
    try {
        $db = self::connexion();
        $query = $db->prepare("UPDATE $table SET nom = :nom, region = :region)
                            WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':region', $region, PDO::PARAM_STR);
        $query->execute();

    } catch (PDOException $e) {
      die( "Erreur !: " . $e->getMessage() );
    }

    $query->closeCursor();
  }

  //DELETE

  public static function deleteVille($table, $id) {
    try {
      $db = self::connexion();
      $query = $db->prepare("DELETE FROM $table WHERE id = :id");
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $query->execute();

    } catch (PDOException $e) {
      die( "Erreur !: " . $e->getMessage() );
    }

    $query->closeCursor();
  }
  
}

?>
