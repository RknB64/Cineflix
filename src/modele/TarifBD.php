<?php

class TarifBD extends MyPdo
{   
    public const TABLE        = "tarif";
    public const ID           = "id";
    public const CLASS_OBJ    = "Tarif";

    private static array $columns = array(
        "id_cinema",
        "id_film",
        "prix_semaine",
        "prix_weekend",
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
