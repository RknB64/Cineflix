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

    public static function toggleAdmin(int $idAdherent): bool
    {
        $adherentBD = new AdherentBD();
        $adherent = $adherentBD->selectById($idAdherent);

        $adherent->estAdmin = $adherent->estAdmin ? 0 : 1;

        return $adherentBD->update($adherent);
    }

    public static function deleteAdherent(int $idAdherent): bool
    {
        if ($idAdherent !== CurrentUser::getId()) {
            $adherentBD = new AdherentBD();
            return $adherentBD->delete($idAdherent);
        } else {
            return false;
        }
    }

    public static function deleteFilm(int $idFilm): bool
    {
        $filmBD = new FilmBD();
        return $filmBD->delete($idFilm);
    }

    public static function addFilm($post, $files): ?object
    {
        $film = new Film();

        $film->titre            = Utilities::sanitaze($post['titre']);
        $film->description      = Utilities::sanitaze($post['description']);
        $film->duree            = Utilities::sanitaze($post['duree']);
        $film->etat             = Utilities::sanitaze($post['etat']);
        $film->date_sortie      = Utilities::sanitaze($post['date_sortie']);
        $film->date_expiration  = Utilities::sanitaze($post['date_expiration']);

        $film->id_affiche       = Utilities::addFilmImage($files["image"]);

        $filmBd = new FilmBD();

        if ($filmBd->add($film)) {
            // format les dates avant de les renvoyer à la vue
            $film->date_sortie = Utilities::formatDate($film->date_sortie);
            $film->date_expiration = Utilities::formatDate($film->date_expiration);
            return $film;
        } else {
            return null;
        }
    }
}
