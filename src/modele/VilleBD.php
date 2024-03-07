<?php

class Ville
{
  public int    $id;
  public string $nom;
  public int    $region; // voir comment gerer l'enum qui est dans la table
}

class VilleBD extends MyPdo
{
  public const TABLE        = "ville";
  public const ID           = "id";
  public const CLASS_OBJ    = "region";

  private static array $columns = array(
    "nom",
    "region",
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
