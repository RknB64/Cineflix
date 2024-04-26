<?php

abstract class Controller
{

  protected string  $titre;
  protected string  $view;
  protected array   $data;

  protected function __construct()
  {
  }

  // prend en arg le nom d'un vue, et les variables nécessaires pour l'affichage dans une array
  static protected function render($view, $data = [])
  {
    extract($data);

    include RACINE . "/vue/header.php";
    include RACINE . "/vue/$view.php";
    include RACINE . "/vue/footer.php";
  }
}
