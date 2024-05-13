<?php

// provide function to manage user
class UserManager
{

    // return true/false if a user mail and password are valid
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

    public static function getUserFromEMail(string $email): ?object
    {
        $ad = new Adherent();
        $adBD = new AdherentBD();

        $ad->mail = $email;

        $ad = $adBD->selectWhere($ad);

        $ad = $ad === null ? null :  $ad[0];
        // $validMail = $ad === null ? false : true;

        return $ad;
    }

    // return a user hash password from the bd
    public static function getHash(string $email): string
    {
        $hash   = "";
        $ad     = new Adherent();
        $adBD   = new AdherentBD();

        $ad->mail = $email;
        $ad = $adBD->selectWhere($ad);

        if ($ad && isset($ad[0]->password)) {
            $hash = $ad[0]->password;
        }

        return $hash;
    }
}
