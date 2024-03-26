<?php

class UserManager
{

    public static function isValidUser(string $email, string $candidateMdp): array
    {
        $validMdp = false;
        $validMail = self::isEmailInBD($email);

        if ($validMail) {
            $userHash = self::getHash($email);
            $validMdp = password_verify($candidateMdp, $userHash);
        }
        return [$validMail, $validMdp];
    }

    public static function isEmailInBD(string $email): bool
    {
        $ad = new Adherent();
        $adBD = new AdherentBD();

        $ad->mail = $email;
        $ad = $adBD->selectWhere($ad);

        $validMail = $ad === null ? false : true;

        return $validMail;
    }

    public static function handleRegisterPost(array $post): bool
    {
        $isAdded = false;

        $adBD = new AdherentBD();
        $ad = new Adherent();

        $ad = self::handleRegisterInput($post);

        $mdp = isset($post['password']) ? $post['password'] : "";
        $mdp_check = isset($post['password_check']) ? $post['password_check'] : "";

        $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
        $valid_mdp = password_verify($mdp_check, $hash_mdp);

        // TODO check que email pas in bd
        if ($valid_mdp) {
            $ad->password = $hash_mdp;
            $isAdded = $adBD->add($ad);
        } else {
            echo "no";
        }

        return $isAdded;
    }

    private static function handleRegisterInput(array $post): Adherent
    {
        $ad = new Adherent();

        $nom    = isset($post['nom'])      ? $post['nom'] : "";
        $prenom = isset($post['prenom'])   ? $post['prenom'] : "";
        $mail   = isset($post['mail'])     ? $post['mail'] : "";
        $ville  = isset($post['ville'])    ? $post['ville'] : "";

        $ad->nom        = Utilities::sanitaze($nom);
        $ad->prenom     = Utilities::sanitaze($prenom);
        $ad->mail       = Utilities::sanitaze($mail);
        $ad->id_ville   = Utilities::sanitaze($ville);

        return $ad;
    }
}
