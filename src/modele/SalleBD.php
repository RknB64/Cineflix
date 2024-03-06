<?php


class Salle
{
  public int $id;
  public int $id_cinema;
  public int $nb_place;
}

class SalleBD extends MyPdo
{
  private static string $table  = "salle";
  private static string $id     = "id";

  private static array $columns = array(
    "id_cinema",
    "nb_place"
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
