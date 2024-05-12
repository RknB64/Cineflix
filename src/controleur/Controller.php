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
    static protected function render(string $view, array $data = [], bool $withHeaderFooter = true): void
    {
        extract($data);

        $withHeaderFooter ? include RACINE . "/vue/header.php" : "";

        include RACINE . "/vue/$view.php";

        $withHeaderFooter ? include RACINE . "/vue/footer.php" : "";
    }
}
