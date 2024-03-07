<?php

abstract class MyPdo extends DbConnect
{

  abstract protected function table(): string;   // return child table name

  abstract protected function id(): string;   // return child table id name

  abstract protected function columns(): array;    // return child columns names

  abstract protected function className(): string;   // return child associated object class (ex: for AdherentBD it's "Adherent")


  public function selectAll(): array
  {

    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table());
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



  public function selectById(int $id): object
  {

    $db = self::connexion();
    $resultat = null;

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE " . $this->id() . " = ?");
      $query->execute([$id]);

      while ($ligne = $query->fetch(PDO::FETCH_ASSOC)) {
        $resultat = $this->createObject($ligne);
      }

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());

    } finally {
      $db = null;

    }

    return $resultat;
  }




  public function delete(int $id): bool
  {

    $db = self::connexion();
    $res = true;

    try {
      $query = $db->prepare("DELETE FROM " . $this->table() .
                           " WHERE " . $this->id() . " = ?");

      $res = $query->execute([$id]);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $res = false;

    } finally {
      $db = null;
    }

    return $res;
  }




  public function add(object $object): bool
  {

    $db         = self::connexion();
    $isAdded    = true;

    $columns = $this->columns();

    // formate les colones à insérer pour la requête et les ?
    $columnsFormated    = implode(', ', $columns);
    $placeholders       = implode(', ', array_fill(0, count($columns), '?'));

    try {
      $query = $db->prepare("INSERT INTO " . $this->table() .
                           " (" . $columnsFormated . ") 
                             VALUES (" . $placeholders . ") ");

      // crée une array avec les valeurs à ajouter 
      // en s'assurant que ce soit dans le même ordre que les colonnes
      $newValues = array_map(fn ($property) => $object->$property, $columns);

      $isAdded = $query->execute($newValues);

    } catch (PDOException $e) {

      die("Erreur !: " . $e->getMessage()); // TODO enlever les die()
      $isAdded = false;

    } finally {
      $db = null;
    }

    return $isAdded;
  }




  public function update(object $object): bool
  {

    $db = self::connexion();
    $isUpdated = true;

    $columns = $this->columns();

    // formate les colonnes à insérer pour la requête et les ?
    $columnsFormated = implode('= ?,  ', $columns) . "= ? ";

    try {
      $query = $db->prepare("UPDATE " . $this->table() .
                           " SET " . $columnsFormated .
                           " WHERE id=" . $this->id());

      $newValues = array_map(fn ($property) => $object->$property, $columns);

      $isUpdated = $query->execute($newValues);

    } catch (PDOException $e) {
      die("Erreur !: " . $e->getMessage());
      $isUpdated = false;

    } finally {
      $db = null;
    }

    return $isUpdated;
  }


  // prend en paramètre un objet et fait un where sur les propriétés set up
  // par exemple $Adherent->nom = "Bob"; selectWhere($Adherent) : retourne une array avec les adhérents qui ont pour nom bob
  // les autres propriétés doivent être laissée vide
  public function selectWhere(object $object): array
  {
    $db = self::connexion();
    $resultat = null;
    
    $where = "";

    foreach ($this->columns() as $property) {

      if (isset($object->$property)) {

        $stm = $property . " = '" . $object->$property . "'";

        if (!empty($where)) $where .= " AND ";

        $where .= $stm;
      }
    } 

    try {
      $query = $db->prepare("SELECT * FROM " . $this->table() . " WHERE " . $where);
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



  // retourne à partir d'une ligne de query, l'objet associé.
  // repose sur le fait que le nom des variables des objets sont les mêmes que le nom des colonnes sql
  // par exemple Adherent->nom marche car dans sql la colonnes s'appelle aussi 'nom'
  protected function createObject(array $line): object
  {

    $class = $this->className();
    $obj = new $class();

    foreach ($line as $key => $value) {
      $obj->$key = $value;
    }

    return $obj;
  }
}
