<?php

// provide functions to manage user registration
class UserRegister extends UserManager
{

  private static array $formFields = [
    //  label                       type            name                properties                          classes
    ["Nom",                         "text",         "nom",              "required",                         ""],
    ["Prénom",                      "text",         "prenom",           "required",                         ""],
    ["Email",                       "email",        "mail",             "required",                         ""],
    ["Ville",                       "text",         "ville_name",       "required autocomplete='off'",      "suggestion_ville_name"],
    /* ["VilleId",                     "hidden",       "ville_id",         "required",                         "suggestion_ville_id"], */
    ["Mot de passe",                "password",     "password",         "required",                         ""],
    ["Retaper le mot de passe",     "password",     "password_check",   "required",                         ""]
  ];

  // défini des constantes pour simplifier l'acces aux fields, par exemple: $fields[0][LABEL]
  const LABEL       = 0;
  const TYPE        = 1;
  const NAME        = 2;
  const PROPERTIES  = 3;
  const CLASSES     = 4;

  public static function getFormFields(): array
  {

    return self::$formFields;
  }

  public static function handleRegisterPost(array $post): bool
  {
    $isAdded = false;

    $adBD = new AdherentBD();
    $ad = new Adherent();

    $ad = self::handleRegisterInputs($post);

    $mdp = isset($post['password']) ? $post['password'] : "";
    $mdp_check = isset($post['password_check']) ? $post['password_check'] : "";

    $hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $valid_mdp = password_verify($mdp_check, $hash_mdp);

    $valid_mail = !self::isEmailInBD($ad->mail);

    if ($valid_mail && $valid_mdp) {
      $ad->password = $hash_mdp;
      $isAdded = $adBD->add($ad);
    } else {
      echo "no";
    }

    return $isAdded;
  }

  private static function handleRegisterInputs(array $post): Adherent
  {
    $ad = new Adherent();

    $nom    = isset($post['nom'])      ? $post['nom']       : "";
    $prenom = isset($post['prenom'])   ? $post['prenom']    : "";
    $mail   = isset($post['mail'])     ? $post['mail']      : "";
    $ville  = isset($post['ville_id']) ? $post['ville_id']  : "0";

    $ad->nom        = Utilities::sanitaze($nom);
    $ad->prenom     = Utilities::sanitaze($prenom);
    $ad->mail       = Utilities::sanitaze($mail);
    $ad->id_ville   = intval($ville);

    return $ad;
  }
}
