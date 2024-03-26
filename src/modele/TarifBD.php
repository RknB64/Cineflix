<?php

class TarifBD extends DbConnect {


    //CREATE

    public static function addTarif($table, $idCinema, $idFilm, $prixSemaine, $prixWeekend) {
      try {
        $db = self::connexion();
        $query = $db->prepare("INSERT INTO $table (id_cinema, id_film, prix_semaine, prix_weekend)
                              VALUES (:idCinema, :idFilm, :prixSemaine, :prixWeekend)");

        //Pour les PDO::PARAM, il semble n'exister que INT et STR
        // Float se met apparemment en STR, à tester plus tard
        $query->bindValue(':idCinema', $idCinema, PDO::PARAM_INT);
        $query->bindValue(':idFilm', $idFilm, PDO::PARAM_INT);
        $query->bindValue(':prixSemaine', $prixSemaine, PDO::PARAM_STR);
        $query->bindValue(':prixWeekend', $prixWeekend, PDO::PARAM_STR);
        $query->execute();

      } catch (PDOException $e) {
        die( "Erreur !: " . $e->getMessage() );
      }

      $query->closeCursor();
    }

  

  
    public static function getTarifs($table) {

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
  
  public static function getTarifByCinema($table, $idCinema) {

      $resultat=null;

      try {
        $db = self::connexion();
        $query = $db->prepare("SELECT * FROM $table WHERE id_cinema = :idCinema");
        $query->bindValue(':idCinema', $idCinema, PDO::PARAM_STR);
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


  //UPDATE

  public static function updateTarif($table, $idCinema, $idFilm, $prixSemaine, $prixWeekend) {
    try {
      $db = self::connexion();
      $query = $db->prepare("UPDATE $table SET prix_semaine = :prixSemaine, prix_weekend = :prixWeekend)
                            WHERE id_cinema = :idCinema AND id_film = :idFilm");
      $query->bindValue(':idCinema', $idCinema, PDO::PARAM_INT);
      $query->bindValue(':idFilm', $idFilm, PDO::PARAM_INT);
      $query->bindValue(':prixSemaine', $prixSemaine, PDO::PARAM_STR);
      $query->bindValue(':prixWeekend', $prixWeekend, PDO::PARAM_STR);
      $query->execute();

    } catch (PDOException $e) {
      die( "Erreur !: " . $e->getMessage() );
    }

    $query->closeCursor();
  }

  //DELETE

  public static function deleteTarif($table, $idCinema, $idFilm) {
    try {
      $db = self::connexion();
      $query = $db->prepare("DELETE FROM $table WHERE id_cinema = :idCinema AND id_film = :idFilm");
      $query->bindValue(':idCinema', $idCinema, PDO::PARAM_INT);
      $query->bindValue(':idFilm', $idFilm, PDO::PARAM_INT);
      $query->execute();

    } catch (PDOException $e) {
      die( "Erreur !: " . $e->getMessage() );
    }

    $query->closeCursor();
  }
  
}

?>
