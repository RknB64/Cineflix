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
