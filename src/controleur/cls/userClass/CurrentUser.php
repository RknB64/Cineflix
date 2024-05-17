<?php

class CurrentUser
{

    private const SESSION_ADHERENT = 'current_adherent';
    private const SESSION_LOGGED_IN = 'logged_in';

    public static function isLoggedIn(): bool
    {
        return self::getAdherent() && self::getSessionLoggedIn();
    }

    public static function getAdherent(): ?Adherent
    {
        return $_SESSION[self::SESSION_ADHERENT] ?? null;
    }

    private static function getSessionLoggedIn(): bool
    {
        return $_SESSION[self::SESSION_LOGGED_IN] ?? false;
    }

    public static function updateAdherent(Adherent $adherent): void
    {
        $_SESSION[self::SESSION_LOGGED_IN] = $adherent;
    }

    public static function logout()
    {
    }




    /*
    * Accès aux infos de l'user, suppose que le caller vérifie que la personne est logIn (sinon erreur)
    */
    
    public static function isAdmin(): bool
    {
        return self::getAdherent()->estAdmin;
    }
    public static function estAdmin(): bool
    {
        return self::getAdherent()->estAdmin;
    }

    public static function getId(): int
    {
        return self::getAdherent()->id;
    }

    public static function getNom(): string
    {
        return self::getAdherent()->nom;
    }

    public static function getPrenom(): string
    {
        return self::getAdherent()->prenom;
    }

    public static function getMail(): string
    {
        return self::getAdherent()->mail;
    }

    public static function getPoints(): int
    {
        return self::getAdherent()->points;
    }

    public static function getIdVille(): int
    {
        return self::getAdherent()->id_ville;
    }

    public static function getDateCreation(): string
    {
        return self::getAdherent()->date_creation;
    }
}
