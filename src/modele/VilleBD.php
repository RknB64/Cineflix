<?php

class VilleBD extends MyPdo
{
  public const TABLE        = "ville";
  public const ID           = "id";
  public const CLASS_OBJ    = "Ville";

  private static array $columns = array(
    "nom",
    "region",
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

  public function Search_selon_Ville($ville): ?array
  {
    $db = self::connexion();
    try {
      $query = $db->prepare(
        "SELECT cinema.*
            FROM cinema
            INNER JOIN film ON cinema.id = film.id
            INNER JOIN ville ON cinema.id_ville = ville.id
            WHERE ville.nom = :ville"
      );


      // Bind the parameter using named parameter syntax
      $query->bindParam(':ville', $ville, PDO::PARAM_STR);

      $query->execute();

      // Fetch the results
      $resultat = $query->fetchAll(PDO::FETCH_OBJ);

      // Check if there are any results
      if ($resultat) {
        return $resultat;
      } else {
        return null;
      }
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    }
  }
}
