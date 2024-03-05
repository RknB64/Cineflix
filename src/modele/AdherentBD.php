<?php

/* include_once './DbConnect.php'; */
/* include_once '../controleur/config.php'; */

// class pour manipuler les adherents, les noms des variables doivent etre les memes que dans la bd
class Adherent
{
  public int    $id;
  public string $nom;
  public string $prenom;
  public string $mail;
  public int    $id_ville;
  public string $password;
  public int    $points;
  public string $date_creation; // format "yyyy-mm-dd"
  public string $compte; // a retirer de la bd je pense
}

class AdherentBD extends DbConnect
{

  // todo ajouter un tableau d'adherents

  private static string $table = "adherent";

  public const ID             = "id";
  public const NOM            = "nom";
  public const PRENOM         = "prenom";
  public const MAIL           = "mail";
  public const ID_VILLE       = "id_ville";
  public const PASSWORD       = "password";
  public const POINTS         = "points";
  public const DATE_CREATION  = "date_creation";
  public const COMPTE         = "compte";

  private static array $columns = array(
    self::NOM,
    self::PRENOM,
    self::MAIL,
    self::ID_VILLE,
    self::PASSWORD,
    self::POINTS,
    self::DATE_CREATION,
    self::COMPTE
  );

  public static function getColumns(): array
  {
    return self::$columns;
  }
  
  // empty private constructor to prevent creating instances
  private function __construct()
  {
  }

  public static function getAdherent(): array
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



  public static function getAdherentById(int $idA): array
  {
    $resultat = null;

    $db = self::connexion();

    try {
      $query = $db->prepare("SELECT * FROM " . self::$table . " WHERE id = :idA");
      $query->bindValue(':idA', $idA, PDO::PARAM_INT);
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



  public static function deleteAdherent(int $idA): bool
  {

    $db = self::connexion();
    $res = true;

    try {
      $query = $db->prepare("DELETE FROM " . self::$table . " WHERE id = :idA");
      $query->bindValue(':idA', $idA, PDO::PARAM_INT);
      $res = $query->execute();
    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $res = false;
    }

    $db = null;

    return $res;
  }



  // TODO avoir le password hache
  public static function addAdherent(Adherent $newAdherent): bool
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
      $newValues = array_map(fn($propertiy) => $newAdherent->$key, self::$columns);

      $isAdded = $query->execute($newValues);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage()); // TODO enlever les die()
      $isAdded = false;
    }

    $db = null;
    return $isAdded;
  }



  // retourner un objet adherent ?
  // quoi faire si l'objet adherent en arg n'est pas complet
  public static function updateAdherent(Adherent $adherent): bool {

    $db = self::connexion();
    $isUpdated = true;

    // formate les colonnes à insérer pour la requête et les ?
    $columnsFormated = implode('= ?,  ', self::$columns) . "= ? ";

    try {
      $query = $db->prepare("UPDATE " . self::$table . " SET " . $columnsFormated . " WHERE id=" . $adherent->id);

      $newValues = array_map(fn($propertiy) => $adherent->$propertiy, self::$columns);

      $isUpdated = $query->execute($newValues);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $isUpdated = false;
    }

    $db = null;
    return $isUpdated;
  }
}
