<?php

// class pour manipuler les adherents, les noms des variables doivent etre les memes que dans la bd
class Adherent
{
  public int    $id;
  public string $nom;
  public string $prenom;
  public string $mail;
  public int    $id_ville;
  public string $password;
  public int    $points;
  public string $date_creation; // format "yyyy-mm-dd"
  public string $compte; // a retirer de la bd je pense
}
