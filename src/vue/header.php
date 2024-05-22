<?php

/* Ce bloc de code vérifie si le paramètre 'action' est défini dans l'URL (['action']) et
    s'il n'est pas égal à 'connexion'. Si ces conditions sont remplies, il stocke la valeur de « action »
    dans la variable de session 'current_action'. De plus, il stocke éventuellement l'URL complète du
    page actuelle dans la variable de session 'current_url' à des fins de redirection plus précises. C'est
    couramment utilisé pour garder une trace de l'action en cours ou de la page consultée pour une utilisation ultérieure, telle que
    rediriger l'utilisateur vers la même page après qu'une certaine action soit effectuée. */

if (isset($_GET['action']) && $_GET['action'] !== 'connexion') {
    // $_SESSION['current_action'] = $_GET['action'];
    $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $titre ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="static/css/style.css" type="text/css" media="screen" />

    <?php if (isset($stylesheet)) : ?>
        <link rel="stylesheet" href="static/css/<?= $stylesheet ?>.css" type="text/css" media="screen" />
    <?php endif; ?>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI library -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="static/js/film.js"></script>
    <script src="static/js/ajaxAutocompleteVille.js"></script>
    <script src="static/js/SearchFilm_SelonCinema.js"></script>
    <script src="static/js/confirm.js" defer></script>

</head>

<script>
    // set up l'autocomplete de la ville via ajax
    autocompleteVille("nav-search-ville");
</script>


<body class="body bg-black">
    <nav class="navbar navbar-expand-lg bg-dark position-sticky top-0 start-0 z-3" data-bs-theme="dark" style="--bs-bg-opacity: .7;">
        <div class="container-fluid">
            <a class="navbar-brand" href="?">
                <img src="static/img/logo.png" alt="CINEFLIX" width="30" height="24" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="?action=accueil">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?action=catalogueCinema">CINEMA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?action=streaming">STREAMING</a>
                    </li>
                </ul>
                <form class="d-flex" role="recherche" id="search-box" method="GET">
                    <div>

                        <!-- input qui sert à ajouter le action=recherche -->
                        <input type="hidden" name="action" value="recherche">

                        <input id="nav-search-ville" class="form-control me-2" type="text" name="ville" placeholder="Rechercher un cinéma" aria-label="Search" autocomplete='off'>

                        <!-- input qui sert à pouvoir submit en appuyant sur 'entrer' -->
                        <input type="submit" style="position: absolute; left: -9999px" />

                    </div>

                </form>
                <?php if (!CurrentUser::isLoggedIn()) { ?>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <?php } else { ?>
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php } ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>
                        </button>
                        <?php if (CurrentUser::isLoggedIn()) { ?>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="?action=compte">Mon Compte</a></li>
                                <?php if (CurrentUser::isAdmin()) { ?>
                                    <li><a class="dropdown-item" href="#">Administration</a></li>
                                <?php } else { ?>
                                    <li><a class="dropdown-item" href="?action=mes-streams">Mes films</a></li>
                                <?php } ?>
                                <li><a class="dropdown-item" href="?action=logout">Se déconnecter</a></li>
                            </ul>
                        <?php } ?>
            </div>
        </div>
        <!-- session qui a le bom de utilsateur -->
        <!-- si la session exist  -->
        <?php if (CurrentUser::isLoggedIn()) : ?>
            <?php if (CurrentUser::isAdmin()) : ?>
                <p style="color: white;">Bienvenue, Admin <?php echo CurrentUser::getNom(); ?></p>
            <?php else : ?>
                <p style="color: white;">Bienvenue, <?php echo CurrentUser::getNom(); ?></p>
            <?php endif; ?>
        <?php else : ?>
            <p style="color: white;">Bienvenue, Guest!</p>
        <?php endif; ?>

    </nav>
    <!-- Modal -->
    <?php
    echo file_get_contents(RACINE . '/vue/component/loginModal.html', true);
    ?>
    <div id="corps">