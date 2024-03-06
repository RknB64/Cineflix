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
  private static string $id     = "id";

  private static string $class  = "Seance";

  private static array $columns = array(
    "id_film",
    "id_salle",
    "horaire_date"
  );

  protected function ClassName()
  {
    return self::$class;
  }

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
