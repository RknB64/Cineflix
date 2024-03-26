<?php

class SalleBD extends MyPdo
{
  public const TABLE        = "salle";
  public const ID           = "id";
  public const CLASS_OBJ    = "Salle";

  private static array $columns = array(
    "id_cinema",
    "nb_place"
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
