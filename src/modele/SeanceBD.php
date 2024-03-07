<?php

class Seance
{
  public int    $id;
  public int    $id_film;
  public int    $id_salle;
  public string $horaire_date;
}

class SeanceBD extends MyPdo
{
  public const TABLE        = "seance";
  public const ID           = "id";
  public const CLASS_OBJ    = "Seance";

  private static array $columns = array(
    "id_film",
    "id_salle",
    "horaire_date"
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
