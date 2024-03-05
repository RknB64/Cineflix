<?php


class Salle
{
  public int $id;
  public int $id_cinema;
  public int $nb_place;
}

class SalleBD extends Pdo
{
  private static string $table = "salle";

  public const ID           = "id";
  public const ID_CINEMA    = "id_cinema";
  public const NB_PLACE     = "nb_place";

  private static array $columns = array(
    self::ID,
    self::ID_CINEMA,
    self::NB_PLACE,
  );

}

