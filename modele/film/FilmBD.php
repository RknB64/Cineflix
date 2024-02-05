<?php

class FilmBD extends DbConnect {

    const table = DB_FILM_TABLE;
    const titre = TITRE_FILM;
    const desc = DESC_FILM;
    const droit = DROIT_FILM;
    const dateSortie = DATE_SORTIE_FILM;
    const duree = DUREE_FILM;
    const affiche = AFFICHE_FILM;
    const etat = ETAT_FILM;

    //CREATE

    public static function addFilm($titre, $desc, $droit, $date, $duree, $affiche, $etat) {
      try {
        $db = self::connexion();
        $query = $db->prepare("INSERT INTO table (titre, desc, droit, dateSortie, duree, affiche, etat)
                              VALUES (:titre, :desc, :droit, :date, :dateSortie, :duree, :affiche, :etat)")
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->bindValue(':desc', $desc, PDO::PARAM_STR);
        $query->bindValue(':droit', $droit, PDO::PARAM_STR); //Apparemment on passe la date en string => on verra au test
        $query->bindValue(':dateSortie', $dateSortie, PDO::PARAM_STR);
        $query->bindValue(':duree', $duree, PDO::PARAM_STR);
        $query->bindValue(':affiche', $affiche, PDO::PARAM_INT); //Id_affiche int ou string ?
        $query->bindValue(':etat', $etat, PDO::PARAM_BOOL); // cinéma ou streaming avec un boolean ?
        $query->execute();

      } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
      }

      $query->closeCursor();
      self::connexion() -> close();
    }

  

  
    public static function getFilms() {

      $resultat;
      try {
        $db = self::connexion();
        $query = $db->prepare("SELECT * FROM table");
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
      self::connnexion() -> close();
      return $resultat;
    }
  
  public static function getFilmByTitle($title) {

      $resultat;

      try {
        $db = self::connexion();
        $query = $db->prepare("SELECT * FROM table WHERE titre = :title");
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
      self::connexion() -> close();
      return $resultat;
  }
}

?>