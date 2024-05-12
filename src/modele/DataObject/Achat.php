<?php

class Achat
{
    public int      $id_billet;
    public string   $horaire_date;
    public string   $date_d’achat; // format "yyyy-mm-dd"
    public int      $nb_places_achetees;
    public int      $id_adherent;
    public int      $id_seance;
}
