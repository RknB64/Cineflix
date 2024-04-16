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

    // @Override
    // ajoute les valeurs par défaut avant de faire la requête
    public function add(object $ad): bool
    {
        $ad->compte = "ad";
        $ad->date_creation = date('Y-m-d H:i:s');
        $ad->points = 0;

        // appelle la fonction add de MyPdo
        return parent::add($ad);
    }

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
