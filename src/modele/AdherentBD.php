<?php

class AdherentBD extends MyPdo
{

  public const TABLE        = "adherent";
  public const ID           = "id";
  public const CLASS_OBJ    = "Adherent";

  private static array $columns = array(
    "nom",
    "prenom",
    "mail",
    "id_ville",
    "password",
    "points",
    "date_creation",
    "compte",
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
