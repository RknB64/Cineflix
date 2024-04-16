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


    public function isValidUser(string $email, string $candidateMdp): array
    {
        $validMdp = false;
        $validMail = self::isEmailInBD($email);

        if ($validMail) {
            $userHash = self::getHash($email);
            $validMdp = password_verify($candidateMdp, $userHash);
        }
        return [$validMail, $validMdp];
    }

    private function isEmailInBD(string $email): bool
    {
        $ad = new Adherent();

        $ad->mail = $email;
        $ad = $this->selectWhere($ad);

        $validMail = $ad === null ? false : true;

        return $validMail;
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
