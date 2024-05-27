<?php

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
  public int    $estAdmin;


  public function getVilleName(): ?string
  {
    $villeBD = new VilleBD();
    $ville = $villeBD->selectById($this->id);

    return $ville ? $ville->nom : null;
  }
}
