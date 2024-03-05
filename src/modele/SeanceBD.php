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
  private static string $table  = "seance";
  private static int     $id     = "id";

  private static array $columns = array(
    "id_film",
    "id_salle",
    "horaire_date"
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
