<?php

class Cinema
{
    public int    $id;
    public string $nom;
    public int    $id_ville;
}

class CinemaBD extends MyPdo
{

    public const TABLE        = "cinema";
    public const ID           = "id";
    public const CLASS_OBJ    = "Cinema";

    private static array $columns = array(
        "nom",
        "id_ville",
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
