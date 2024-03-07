<?php


class Salle
{
  public int $id;
  public int $id_cinema;
  public int $nb_place;
}

class SalleBD extends MyPdo
{
  public const TABLE        = "salle";
  public const ID           = "id";
  public const CLASS_OBJ    = "Salle";

  private static array $columns = array(
    "id_cinema",
    "nb_place"
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
