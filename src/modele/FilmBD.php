<?php

include_once("./controleur/config.php");
require_once "./modele/DbConnect.php";

class FilmBD extends DbConnect {


    //CREATE

    public static function addFilm($table, $titre, $desc, $droit, $date, $duree, $affiche, $etat) {
      try {
        $db = self::connexion();
        $query = $db->prepare("INSERT INTO $table (titre, description, duree, etat, id_affiche, date_sortie, date_expiration)
                              VALUES (:titre, :desc, :duree, :etat, :affiche, :dateSortie, :droit)");
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':desc', $desc, PDO::PARAM_STR);
        $query->bindValue(':droit', $droit, PDO::PARAM_STR); //Apparemment on passe la date en string => on verra au test
        $query->bindValue(':dateSortie', $date, PDO::PARAM_STR);
        $query->bindValue(':duree', $duree, PDO::PARAM_STR);
        $query->bindValue(':affiche', $affiche, PDO::PARAM_INT); //Id_affiche int ou string ?
        $query->bindValue(':etat', $etat, PDO::PARAM_STR);
        $query->execute();

      } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
      }

      $query->closeCursor();
    }

  

  
    public static function getFilms($table) {

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
  
  public static function getFilmByTitle($table, $title) {

      $resultat=null;

      try {
        $db = self::connexion();
        $query = $db->prepare("SELECT * FROM $table WHERE titre = :title");
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->execute();

        $ligne = $query->fetch(PDO::FETCH_ASSOC); while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $query->fetch(PDO::FETCH_ASSOC);
        }
      } catch (PDOException $e) {
          die( "Erreur !: " . $e->getMessage() );
      }

      $query->closeCursor();
      return $resultat;
  }
}

?>
