<?php

abstract class Pdo extends DbConnect
{

  private static string $table;

  private static array $columns;


  public function getAll(): array
  {

    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . self::$table);
      $query->execute();

      $ligne = $query->fetch(PDO::FETCH_ASSOC);
      while ($ligne) {
        $resultat[] = $ligne;
        $ligne = $query->fetch(PDO::FETCH_ASSOC);
      }
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
    }

    $db = null;
    return $resultat;
  }




  public static function delete(int $id): bool
  {

    $db = self::connexion();
    $res = true;

    try {
      $query = $db->prepare("DELETE FROM " . self::$table . " WHERE id = :id");
      $query->bindValue(':id', $id, PDO::PARAM_INT);
      $res = $query->execute();
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $res = false;
    }

    $db = null;

    return $res;
  }




  public static function add(object $object): bool
  {

    $db         = self::connexion();
    $isAdded    = true;

    // formate les colones à insérer pour la requête et les ?
    $columnsFormated    = implode(', ', self::$columns);
    $placeholders       = implode(', ', array_fill(0, count(self::$columns), '?'));

    try {
      $query = $db->prepare("INSERT INTO " . self::$table . 
                            " (" .$columnsFormated. ") 
                             VALUES (" .$placeholders. ") ");

      // crée une array avec les valeurs à ajouter en s'assurant que ce soit dans le même ordre que les colonnes
      $newValues = array_map(fn($propertiy) => $object->$key, self::$columns);

      $isAdded = $query->execute($newValues);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage()); // TODO enlever les die()
      $isAdded = false;
    }

    $db = null;
    return $isAdded;
  }




  public static function updateAdherent(object $object): bool 
  {

    $db = self::connexion();
    $isUpdated = true;

    // formate les colonnes à insérer pour la requête et les ?
    $columnsFormated = implode('= ?,  ', self::$columns) . "= ? ";

    try {
      $query = $db->prepare("UPDATE " . self::$table . " SET " . $columnsFormated . " WHERE id=" . $object->id);

      $newValues = array_map(fn($propertiy) => $object->$propertiy, self::$columns);

      $isUpdated = $query->execute($newValues);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $isUpdated = false;
    }

    $db = null;
    return $isUpdated;
  }
}
