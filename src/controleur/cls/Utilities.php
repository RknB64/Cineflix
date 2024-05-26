<?php

class Utilities
{
    public static function sanitaze(String $input): String
    {

        $input = trim($input);
        $input = addslashes($input);
        $input = filter_var($input);

        return $input;
    }

    public static function alerte(String $message): void
    {
        echo '<script>alert("'.$message.'")</script>';
    }


    public static function formatDate(string $date): string
    {
        return (new DateTime($date))->format('d/m/y');
    }

    /**
     * Ajoute une image sur le serveur à partir d'un <input type="file">
     * Prend en argument une sous array de $_FILES, par exemple $_FILES["image"]
     * Renvoi l'id de l'image ajoutée ou null en cas d'erreur
     *
     * @param array $imageFile
     * @return int || null
     **/
    public static function addFilmImage(array $imageFile): ?int
    {
        $filmBD = new FilmBD();
        $maxId = $filmBD->getMaxValue('id_affiche');
        $nextId = $maxId+1;

        $newFile = RACINE . '/static/img/' . $nextId . '.jpg';

        // vérifie que l'image est bien au format jpg (ou jpeg c'est pareil)
        if ($imageFile['type'] !== 'image/jpeg') {
            return null;
        }

        // ajoute l'image sur le serveur
        if (move_uploaded_file($imageFile["tmp_name"], $newFile)) {
            return $nextId;
        } else {
            return null;
        }

    }
}
