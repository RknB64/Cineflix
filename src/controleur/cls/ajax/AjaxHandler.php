<?php

class AjaxHandler
{

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

    public static function deleteAdherent(int $idAdherent): bool {

        if ($idAdherent !== CurrentUser::getId()) {
            $adherentBD = new AdherentBD();
            return $adherentBD->delete($idAdherent);
        } else {
            return false;
        }
    }
}
