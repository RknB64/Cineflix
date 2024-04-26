<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CineFlix</title>
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

    <style>
        /* styles pour search resulte */

        .search-results {
            position: absolute;
            top: 100%;
            /* Position below the search box */
            left: 0;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-top: none;
            z-index: 1000;
            /* Ensure it's above other content */
            /* Style for selected item */
        }

        .search-results li.selected {
            background-color: #ffa200;
            color: #fff;
            cursor: pointer;
        }
    </style>
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
                        <a class="nav-link text-white" aria-current="page" href="?">ACCUEIL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?action=catalogue">CINEMA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?action=streaming">STREAMING</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" id="search-box" method="GET">
                    <div>
                      <input type="hidden" name="action" value="search">
                      <input id="nav-search-ville" class="form-control me-2" type="text" name="ville" placeholder="Rechercher un cinéma" aria-label="Search" autocomplete='off'>

                      <input type="submit" style="position: absolute; left: -9999px"/>

                    </div>

                </form>
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#loginModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                        </svg>

                    </button>


            </div>
        </div>
    </nav>
    <!-- Modal -->
    <?php
    echo file_get_contents(RACINE . '/vue/component/loginModal.html', true);
    ?>

    <div id="corps">
