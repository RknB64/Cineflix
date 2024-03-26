<?php

// provide functions to manage user registration
class UserRegister extends UserManager
{

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
