<?php

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

class AdherentBD extends MyPdo
{

  public const TABLE        = "adherent";
  public const ID           = "id";
  public const CLASS_OBJ    = "Adherent";

  private static array $columns = array(
    "nom",
    "prenom",
    "mail",
    "id_ville",
    "password",
    "points",
    "date_creation",
    "compte",
  );

  protected function ClassName()
  {
    return self::CLASS_OBJ;
  }

  protected function table()
  {
    return self::TABLE;
  }

  protected function columns()
  {
    return self::$columns;
  }

  protected function id()
  {
    return self::ID;
  }
}
