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

  protected function ClassName() : string
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
