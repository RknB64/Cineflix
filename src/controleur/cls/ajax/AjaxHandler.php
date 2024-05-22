<?php

class AjaxHandler
{

    // constante pour orienter les requêtes
    public const AUTOCOMPLETE_VILLE = "autocomplete-ville";
    public const TOGGLE_ADMIN = "toggle-admin";

    public static function autocomplete(string $userInput, object $objectBD, string $colName): ?array
    {
        $result = null;

        if ($userInput != "") {
            $result = $objectBD->selectLike($userInput, $colName, $colName, 6);
        }

        return $result;
    }

    public static function toggleAdmin(int $idAdherent): bool {
        $adherentBD = new AdherentBD();
        $adherent = $adherentBD->selectById($idAdherent);

        $adherent->estAdmin = $adherent->estAdmin ? 0 : 1;

        return $adherentBD->update($adherent);
    }
}
