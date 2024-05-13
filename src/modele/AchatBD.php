<?php

class AchatBD extends MyPdo
{
    public const TABLE        = "achat";
    public const ID           = "id";
    public const CLASS_OBJ    = "Achat";

    private static array $columns = array(
        "id_billet",
        "horaire_date",
        "date_achat",
        "nb_places_achetees",
        "id_adherent",
        "id_seance",
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
