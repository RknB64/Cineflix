<?php

class Ville
{
  public int    $id;
  public string $nom;
  public int    $region; // voir comment gerer l'enum qui est dans la table
}

class VilleBD extends MyPdo
{
  private static string $table  = "ville";
  private static string $id     = "id";

  private static array $columns = array(
    "nom",
    "region",
  );

  protected function table()
  {
    return self::$table;
  }

  protected function columns()
  {
    return self::$columns;
  }

  protected function id()
  {
    return self::$id;
  }
}
