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

  public static function autocomplete(string $userInput) : ?array
  {
    $db = self::connexion();
    $resultat = null;
    $colNom = self::$columns[0];
    $userInput = Utilities::sanitaze($userInput);

    try {
      $query = $db->prepare("SELECT * FROM " .self::TABLE. " WHERE " .$colNom. " LIKE ? ORDER BY " .$colNom. " LIMIT 0,6" );
      $query->execute([$userInput . '%']);

      while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {
        $resultat[] = $ligne[$colNom];
      }

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());

    } finally {
      $db = null;

    }

    return $resultat;

  }

  protected function className() : string
  {
    return self::CLASS_OBJ;
  }

  protected function table() : string
  {
    return self::TABLE;
  }

  protected function columns() : array
  {
    return self::$columns;
  }

  protected function id() : string
  {
    return self::ID;
  }
}

