<?php
class FilmBD extends MyPdo
{
  public const TABLE        = "film";
  public const ID           = "Id";
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

  public function selectFilmsDispo()
  {
    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE date_expiration >= NOW();");
      $query->execute();

      while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {

        $resultat[] = $this->createObject($ligne);
      }
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    }

    return $resultat;
  }
}
