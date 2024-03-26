<?php

require

class UserManager {

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

    private static function isEmailInBD(string $email): bool
    {
        $ad = new Adherent();
        $adBD = new AdherentBD();

        $ad->mail = $email;
        $ad = $adBD->selectWhere($ad);

        $validMail = $ad === null ? false : true;

        return $validMail;
    }

    
}
