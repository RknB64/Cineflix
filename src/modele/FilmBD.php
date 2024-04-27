<?php
class FilmBD extends MyPdo
{
  public const TABLE        = "film";
  public const ID           = "id";
  public const CLASS_OBJ    = "Film";

  private static array $columns = array(
    "titre",
    "description",
    "duree",
    "etat",
    "id_affiche",
    "date_sortie",
    "date_expiration"
  );

  protected function className(): string
  {
    return self::CLASS_OBJ;
  }

  protected function table(): string
  {
    return self::TABLE;
  }

  protected function columns(): array
  {
    return self::$columns;
  }

  protected function id(): string
  {
    return self::ID;
  }

  public function selectFilmsDispo(): ?array
  {
    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE date_expiration >= NOW()
                                                                        AND etat = 'cinema';");
      $query->execute();

      while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {

        $resultat[] = $this->createObject($ligne);
      }
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    } finally {
      $db = null;
    }

    return $resultat;
  }

  public function selectFilmsDispoAccueil(): ?array
  {
    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE date_expiration >= NOW()
                                                                        AND etat = 'cinema'
                                                                        ORDER BY date_sortie DESC;");
      $query->execute();

      while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {

        $resultat[] = $this->createObject($ligne);
      }
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    } finally {
      $db = null;
    }

    return $resultat;
  }



  public function getFilmsByCinemaId(int $cinemaId): ?array
  {
    $db = self::connexion();
    $films = null;

    try {
      // Prepare the SQL query to fetch films based on cinema ID
      $query = $db->prepare("SELECT DISTINCT film.*
                               FROM cinema
                               INNER JOIN salle ON cinema.id = salle.id_cinema
                               INNER JOIN seance ON salle.id = seance.id_salle
                               INNER JOIN film ON seance.id_film = film.id
                               WHERE cinema.id = :cinemaId");

      // Bind the cinema ID parameter
      $query->bindParam(':cinemaId', $cinemaId, PDO::PARAM_INT);

      // Execute the query
      $query->execute();

      // Fetch the results
      $films = $query->fetchAll(PDO::FETCH_OBJ);

    } catch (PDOException $e) {
      // Handle any potential errors
      die("Error: " . $e->getMessage());
    } finally {
      $db = null;
    }

    // Return the films data
    return $films;
  }
}
