<?php

class VilleBD extends MyPdo
{
  public const TABLE        = "ville";
  public const ID           = "id";
  public const CLASS_OBJ    = "Ville";

  private static array $columns = array(
    "nom",
    "region",
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
