<?php

class ArticleBD extends DbConnect {

    private $table = "Adherent";
  
    public static function getAdherent() {
      $resultat;
      try {
        $db = self::();
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
      return $resultat;
    }
  
  public static function getAdherentById(int $idA) {
      try {
        $db = Connexion::getInstance();
        $query = $db->prepare("SELECT * FROM $table WHERE id = :idA");
        $query->bindValue(':idA', $idA, PDO::PARAM_STR);
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

}


