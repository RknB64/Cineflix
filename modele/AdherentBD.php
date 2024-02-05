<?php

class ArticleBD extends DbConnect {

    private $table = "Adherent";

    private $db = self::connexion(); // ?? mettre dans un constructeur peut etre
    
    // ?? est ce qu'on met chaque element de la base comme ca, pour ensuite simplifier la manipulation des
    // tableau retourné par cette classe ?
    // par example: $adherentListe[0][$nom];
    public $nom = "nom";
    public $prenom = "prenom";
    public $mail = "mail";
    // ...
  
    public static function getAdherent() {
      $resultat;
      try {
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
        $query = $db->prepare("SELECT * FROM $table WHERE id = :idA");
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

  /* public static function creerAdherent(string $nom, string $prenom, ...) { */
  /* public static function supprimerAdherent(int $idA) { */
  /* public static function modifierAdherent(string $nom, string $prenom, ...) { */

}


