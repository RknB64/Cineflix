<?php
class FilmBD extends MyPdo
{
  public const TABLE        = "film";
  public const ID           = "Id";
  public const CLASS_OBJ    = "Film";

  private static array $columns = array(
    "titre",
    "description",
    "duree",
    "etat",
    "id_affiche",
    "date_sortie",
    "date_expiration"
  );

  protected function className(): string
  {
    return self::CLASS_OBJ;
  }

  protected function table(): string
  {
    return self::TABLE;
  }

  protected function columns(): array
  {
    return self::$columns;
  }

  protected function id(): string
  {
    return self::ID;
  }
}
